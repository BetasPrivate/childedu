<?php
App::uses('PointLog', 'Model');
App::uses('Point', 'Model');
App::uses('Activity', 'Model');
class ActivityController extends AppController {
	public $uses = [
		'RegInfo',
		'PointLog',
		'Point',
		'Activity',
		'ActivityInfo',
	];

	public function welfare()
	{
		
	}

	public function view($activityId)
	{
		$activity = $this->Activity->find('first', [
			'conditions' => [
				'Activity.id' => $activityId,
			],
		])['Activity'];

		$activity['start_time'] = date('Y/m/d', strtotime($activity['start_time']));
		$activity['end_time'] = date('Y/m/d', strtotime($activity['end_time']));

		if ($activity['fields'] != '') {
			$activity['fields'] = \Activity::getFieldArr($activity['fields']);
		}

		$this->set(compact('activity'));
	}

	public function createActivity()
	{
		$data = $this->request->data;
		$fields = implode(',', $data['fields']);
		$data['fields'] = $fields;

		$this->Activity->create();
		$saveResult = $this->Activity->save($data);

		if ($saveResult) {
			$activityId = $saveResult['Activity']['id'];

			//save img
			$baseCode = $data['img'];
			if (strlen($baseCode) > 100) {
				$baseArr = explode(',', $baseCode);
				$extend = explode(';', explode('/', $baseArr[0])[1])[0];
				$content = base64_decode($baseArr[1]);

				$imgUrl = 'tmp'. DS .md5($data['title']).time().$activityId.'.'.$extend;
				//Store in the filesystem.
				$fp = fopen($imgUrl, "w");
				fwrite($fp, $content);
				fclose($fp);
				$this->Activity->save(['id' => $activityId, 'thumbnail_url' => $imgUrl]);
			}

			$result = [
				'status' => 1,
				'id' => $activityId,
			];
		} else {
			$result = [
				'status' => 0,
				'msg' => '系统错误，请重试',
			];
		}
		echo json_encode($result);
		exit();
	}

	public function submitActivityRegInfo()
	{
		$data = $this->request->data;

		$data['activity_id'] = $data['id'];
		$activityId = $data['id'];
		unset($data['id']);
		$data['user_id'] = AuthComponent::user('id');

		$this->ActivityInfo->create();
		$saveResult = $this->ActivityInfo->save($data);

		if ($saveResult) {
			$this->Activity->saveActivityPointRecord(AuthComponent::user('id'), $activityId, \Activity::POINT_ON_SUBMIT);

			$this->redirect('/activity/submitSuccess/'.$activityId);

		} else {
			$result = [
				'status' => 0,
				'msg' => '服务器忙，请稍后重试',
			];
		}
		echo json_encode($result);
		exit();
	}

	public function submitSuccess($activityId)
	{
		$activity = $this->Activity->find('first', [
			'conditions' => [
				'Activity.id' => $activityId,
			],
		]);

		$point = $activity['Activity']['point_onsubmit'];

		$this->set(compact('point'));
	}

	public function respondToWelfareReg()
	{
		$data = $this->request->data;
		$activityId = 2;

		$saveData = [
			'activity_id' => $activityId,
			'data' => json_encode($data),
		];
		$this->RegInfo->create();
		$saveResult = $this->RegInfo->save($saveData);

		if ($saveResult) {
			$this->Activity->saveActivityPointRecord(AuthComponent::user('id'), $activityId, \Activity::POINT_ON_SUBMIT);

			$this->redirect('/registration/regSuccess/'.$activityId);

		} else {
			$result = [
				'status' => 0,
				'msg' => '服务器忙，请稍后重试',
			];
		}
		echo json_encode($result);
		exit();
	}

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('welfare');
	}
}