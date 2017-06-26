<?php
App::uses('PointLog', 'Model');
App::uses('Point', 'Model');
App::uses('ChildActivity', 'Model');
class ActivityController extends AppController {
	public $uses = [
		'RegInfo',
		'PointLog',
		'Point',
		'ChildActivity',
	];

	public function welfare()
	{
		
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
			$this->ChildActivity->saveActivityPointRecord(AuthComponent::user('id'), $activityId, \ChildActivity::POINT_ON_SUBMIT);

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
}