<?php
class RegistrationController extends AppController
{
	public $uses = [
		'Center',
		'RegInfo',
		'ChildActivity',
	];

	function index()
	{
		$this->set('title_for_layout', '报名入口');

		// $ticket = $this->Token->getJsApiTicket();
		$timeStamp = time();
		$noncestr = 'zhanshenkeji';
	}

	function submitReg()
	{
		$this->set('title_for_layout', '报名结果');

		$data = $this->request->data;
		$activityId = 1;

		$saveData = [
			'activity_id' => $activityId,
			'data' => json_encode($data),
		];
		$this->RegInfo->create();
		$saveResult = $this->RegInfo->save($saveData);

		if ($saveResult) {
			$result = [
				'status' => 1,
				'data' => $data,
			];
		} else {
			$result = [
				'status' => 0,
				'msg' => '服务器忙，请稍后重试',
			];
		}

		$this->set(compact('result'));
	}

	public function regSuccess($activityId)
	{
		$activity = $this->ChildActivity->find('first', [
			'conditions' => [
				'ChildActivity.id' => $activityId,
			],
		]);

		$point = $activity['ChildActivity']['point_onsubmit'];

		$this->set(compact('point'));
	}

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('index');
	}
}