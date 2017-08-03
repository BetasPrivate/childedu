<?php
App::uses('PointLog', 'Model');
class PunchController extends AppController {
	public $uses = [
		'PunchRecord',
		'Point',
		'PointLog',
		'Token',
		'PunchType',
		'PunchBgImg',
	];

	public function index()
	{
		$punchTypes = $this->PunchType->find('all', [
			'conditions' => [
				'is_deleted' => 0,
			],
		]);

		$imgs = $this->PunchBgImg->find('all', [
        ]);

		foreach ($imgs as &$img) {
            $img['PunchBgImg']['url'] = $this->PunchRecord->getUrl($img['PunchBgImg']['url']);
            $img['PunchBgImg']['type_text'] = \PunchBgImg::text($img['PunchBgImg']['type']);
        }

        $bgImgUrl = $imgs[0]["PunchBgImg"]['url'];

        unset($imgs[0]);

        $util = new Utility();
		$noncestr = 'zhanshenkeji';

		$jsApiTicket = $this->Token->getToken(\Token::JS_API_TICKET);
		$timeStamp = time();
		$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

		$tmpArr = [
			'noncestr' => $noncestr,
			'jsapi_ticket' => $jsApiTicket,
			'timestamp' => $timeStamp,
			'url' => $url,
		];

		ksort($tmpArr);
		$tmpStr = $util->ToUrlParams($tmpArr);
		$signature = sha1($tmpStr);

		$result['nonceStr'] = $noncestr;
		$result['jsApiTicket'] = $jsApiTicket;
		$result['timeStamp'] = $timeStamp;
		$result['signature'] = $signature;
		$result['access_token'] = $this->Token->getToken(\Token::ACCESS_TOKEN);
		$result['appId'] = APP_ID;

        $result['imgs'] = $imgs;
        $result['bg_img_url'] = $bgImgUrl;

		$this->set(compact('punchTypes', 'result'));
	}

	public function view($punchId)
	{
		$punchRecord = $this->PunchRecord->find('first', [
			'conditions' => [
				'PunchRecord.id' => $punchId,
			],
		]);

		$this->set('title_for_layout', $punchRecord['User']['username'].'的打卡记录');

		$result['punch_img_url'] =  ROOT_URL.'/'.$punchRecord['PunchRecord']['img_url'];

		$this->set(compact('result'));
	}

	public function responseToShareInWeixin()
	{
		$data = $this->request->data;

		$punchId = $data['punchId'];
		$punchType = $data['punchType'];
		$imgUrl = $data['imgUrl'];

		$this->PunchRecord->saveResponseToShareInWeixin($punchId);

		exit();

	}

	public function submitPunchRequest()
	{
		$data = $this->request->data;

		$punchType = $data['punch_type'];
		$punchText = $data['punch_text'];
		$result = [
			'status' => 1,
			'msg' => '',
		];

		//需要检查是否当天已经有过该类打卡记录，若有则拒绝打卡。
		$userId = AuthComponent::user('id');
		if (!$this->PunchRecord->checkCanPunchToday($punchType, $userId)) {
			$result['status'] = 0;
			$result['msg'] = '今天已经操作该类打卡了，明天再来吧!';
			echo json_encode($result);
			exit();
		}

		$saveResult = $this->PunchRecord->createNewPunchRecord($punchType, $punchText, AuthComponent::user('id'));

		if (!$saveResult) {
			$result['status'] = 0;
			$result['msg'] = '系统繁忙，请稍后重试';
		} else {
			$punchId = $saveResult['PunchRecord']['id'];
			$qrSceneRes = \Utility::getSceneTicketUrl($this->Token->getToken(1), 604800, $punchId);
			$qrSceneUrlOnline = $qrSceneRes['url'];
			$ticket = $qrSceneRes['ticket'];

			//保存二维码图片，方便后续canvas
			$content = file_get_contents($qrSceneUrlOnline);
			$fileName = 'tmp/'.$ticket.'.jpg';
			$fp = fopen($fileName, 'w');
			fwrite($fp, $content);
			fclose($fp);

			$qrSceneUrlLocal = '/'.$fileName;

			$this->PunchRecord->save(['id' => $punchId, 'qr_scene_ticket' => $ticket]);

			$result['qr_scene_url'] = $qrSceneUrlLocal;
			$result['id'] = $saveResult['PunchRecord']['id'];
			$result['punch_type'] = $punchType;
			$result['punch_text'] = $punchText;
			$result['share_link'] = 'http://'.ROOT_URL.'/punch/view/'.$punchId;
		}

		echo json_encode($result);
		exit();
	}

	public function punchImg()
	{
		$urlData = $this->request->data;
		$urlData = json_decode($urlData['urlAndPunchIdAndText'], true);
		$urlToShow = $urlData['url'];
		$punchId = $urlData['punch_id'];
		$punchText = $urlData['punch_text'];
		$qrSceneUrl = $urlData['qr_scene_url'];
		$punchType = $urlData['punch_type'];

		$punchTypeName = $this->PunchType->find('first', [
			'conditions' => [
				'PunchType.id' => $punchType,
			],
		])['PunchType']['name'];

		$imgs = $this->PunchBgImg->find('all', [
        ]);

        foreach ($imgs as &$img) {
            $img['PunchBgImg']['url'] = $this->PunchRecord->getUrl($img['PunchBgImg']['url']);
            $img['PunchBgImg']['type_text'] = \PunchBgImg::text($img['PunchBgImg']['type']);
        }

        $bgImgUrl = $imgs[0]["PunchBgImg"]['url'];

        unset($imgs[0]);


		$util = new Utility();
		$noncestr = 'zhanshenkeji';

		$jsApiTicket = $this->Token->getToken(\Token::JS_API_TICKET);
		$timeStamp = time();
		$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

		$tmpArr = [
			'noncestr' => $noncestr,
			'jsapi_ticket' => $jsApiTicket,
			'timestamp' => $timeStamp,
			'url' => $url,
		];

		ksort($tmpArr);
		$tmpStr = $util->ToUrlParams($tmpArr);
		$signature = sha1($tmpStr);

		$result['nonceStr'] = $noncestr;
		$result['jsApiTicket'] = $jsApiTicket;
		$result['timeStamp'] = $timeStamp;
		$result['signature'] = $signature;
		$result['access_token'] = $this->Token->getToken(\Token::ACCESS_TOKEN);
		$result['appId'] = APP_ID;
		$result['url'] = $urlToShow;
		$result['punch_id'] = $punchId;
		$result['punch_text'] = $punchText;
		$result['qr_scene_url'] = $qrSceneUrl;
		$result['punch_type'] = $punchType;
		$result['share_link'] = ROOT_URL.'/punch/view/'.$punchId;
		$result['punch_type_name'] = $punchTypeName;
		$result['bg_img_url'] = $bgImgUrl;
		$result['imgs'] = $imgs;

		$this->set(compact('result'));
	}

	public function editPunchType()
	{
		$data = $this->request->data;

		$res = $this->PunchType->save($data);

		if ($res) {
			$result['status'] = 1;
		} else {
			$result['status'] = 0;
			$result['msg'] = '稍后再试';
		}

		echo json_encode($result);
		exit();
	}

	public function createNewPunchType()
	{
		$data = $this->request->data;

		$this->PunchType->create();
		$res = $this->PunchType->save($data);

		if ($res) {
			$result['status'] = 1;
		} else {
			$result['status'] = 0;
			$result['msg'] = '稍后再试';
		}
		echo json_encode($result);
		exit();
	}

	public function upLoadImage()
	{
		$data = $this->request->data;

		$baseCode = $data['base_code'];

		$baseArr = explode(',', $baseCode);
		$extend = explode(';', explode('/', $baseArr[0])[1])[0];
		$content = base64_decode($baseArr[1]);
		$punchId = $data['punch_id'];

		$imgUrl = 'tmp/'.time().$punchId.'.'.$extend;
		//Store in the filesystem.
		$fp = fopen($imgUrl, "w");
		fwrite($fp, $content);
		fclose($fp);

		//保存imgUrl
		$this->PunchRecord->id = $punchId;
		$this->PunchRecord->save(['img_url' => $imgUrl]);

		$result = [
			'status' => 1,
			'img_url' => 'http://'.ROOT_URL.'/'.$imgUrl,
		];
		echo json_encode($result);
		exit();
	}

	public function updateImg()
	{
		$data = $this->request->data;

		$baseCode = $data['file'];

		$baseArr = explode(',', $baseCode);
		$extend = explode(';', explode('/', $baseArr[0])[1])[0];
		$content = base64_decode($baseArr[1]);
		$punchBgImgId = $data['id'];

		$imgUrl = 'tmp/'.'bgImg'.time().$punchBgImgId.'.'.$extend;
		//Store in the filesystem.
		$fp = fopen($imgUrl, "w");
		fwrite($fp, $content);
		fclose($fp);

		//保存imgUrl
		$this->PunchBgImg->id = $punchBgImgId;
		$saveResult = $this->PunchBgImg->save(['url' => $imgUrl]);
		if ($saveResult) {
			$result = [
				'status' => 1,
				'url' => $this->PunchRecord->getUrl($imgUrl),
			];
		} else {
			$result = [
				'status' => 0,
				'msg' => '操作失败，请稍后重试',
			];
		}

		echo json_encode($result);
		exit();
	}

	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('view', 'index');
    }
}