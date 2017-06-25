<?php
App::uses('PointLog', 'Model');
class PunchController extends AppController {
	public $uses = [
		'PunchRecord',
		'Point',
		'PointLog',
		'Token',
		'PunchType',
	];

	public function index()
	{

	}

	public function view($punchId)
	{
		$punchRecord = $this->PunchRecord->find('first', [
			'conditions' => [
				'PunchRecord.id' => $punchId,
			],
		]);

		$result['punch_img_url'] =  '/'.$punchRecord['PunchRecord']['img_url'];

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

	  public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('view');
    }
}