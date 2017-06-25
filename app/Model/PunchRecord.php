<?php
App::uses('PointLog', 'Model');
class PunchRecord extends AppModel {
	public $hasMany = [
		'PointLog',
	];
	const ACCOMPANY_READ_PUNCH = 1;
	const ACTIVITY_PUNCH = 2;
	const CLZ_PUNCH = 3;
	const ASSISTANT_PUNCH = 4;
	const SCAN_ASSISTANT = 5;

	public static $texts = [
		self::ACCOMPANY_READ_PUNCH  => '陪伴阅读打卡',
		self::ACTIVITY_PUNCH => '活动打卡',
		self::CLZ_PUNCH => '课堂打卡',
		self::ASSISTANT_PUNCH => '助教打卡',
		self::SCAN_ASSISTANT => '扫码助力',
	];

	public static $punchTypePointRelation = [
		self::ACCOMPANY_READ_PUNCH  => 20,
		self::ACTIVITY_PUNCH => 20,
		self::CLZ_PUNCH => 20,
		self::ASSISTANT_PUNCH => 20,
		self::SCAN_ASSISTANT => 10,
	];

	public function createNewPunchRecord($punchType, $punchText, $userId, $imgUrl = null)
	{
		$this->create();

		$saveData = [
			'type_id' => $punchType,
			'text' => $punchText,
			'user_id' => $userId,
			'img_url' => $imgUrl,
		];

		return $this->save($saveData);
	}

	public function addPunchPointsScan($punch)
	{
		$saveData = [];

		$saveData['user_id'] = $punch['PunchRecord']['user_id'];
		$saveData['type_id'] = self::SCAN_ASSISTANT;
		$saveData['text'] = self::$texts[self::SCAN_ASSISTANT];

		$this->create();
		$this->save($saveData);
	}

	//新建打卡记录加积分（新增打卡、朋友助力扫码），分享到朋友圈加积分（更新打卡记录），
	function afterSave($created, $options=[])
	{
		if ($created) {
			$this->savePointRecord();
		} else {
			if (!isset($this->data['PunchRecord']['qr_scene_ticket'])) {
				$this->data = $this->find('first', [
					'conditions' => [
						'id' => $this->id,
					],
				]);
				$this->savePointRecord();
			}
		}
	}

	function savePointRecord()
	{
		$this->PointLog->create();
		$saveData = [
			'action_type' => \PointLog::ADD,
			'user_id' => $this->data['PunchRecord']['user_id'],
			'punch_record_id' => $this->data['PunchRecord']['id'],
			'point' => self::$punchTypePointRelation[$this->data['PunchRecord']['type_id']],
		];

		$this->PointLog->save($saveData);
	}
}