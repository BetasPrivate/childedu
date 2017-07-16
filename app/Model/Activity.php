<?php
App::uses('PointLog', 'Model');
class Activity extends AppModel {

	const POINT_ON_SUBMIT = 0;
	const POINT_ON_SCAN = 1;

	public static $key = [
		self::POINT_ON_SUBMIT => 'point_onsubmit',
		self::POINT_ON_SCAN => 'point_onscan',
	];

	//与activiy_infos中的字段相对应
	const USER_NAME = 'user_name';
	const MOBILE_PHONE = 'mobile_phone';
	const ADDRESS = 'address';
	const VENUE_ID = 'venue_id';
	const CHILD_NAME = 'child_name';
	const CHILD_BIRTH = 'child_birth';

	public static $fieldTexts = [
		self::USER_NAME => '姓名',
		self::MOBILE_PHONE => '手机号',
		self::ADDRESS => '地址',
		self::VENUE_ID => '场馆号',
		self::CHILD_NAME => '子女姓名',
		self::CHILD_BIRTH => '子女生日',
	];

	public static function getFieldArr($fields)
	{
		$fieldsArr = explode(',', $fields);

		$fields = [];
		foreach($fieldsArr as $v) {
			$fields[$v] = self::$fieldTexts[$v];
		}

		return $fields;
	}

	public function saveActivityPointRecord($userId, $activityId, $typeId)
	{
		$pointId = ClassRegistry::init('Point')->getPointByUserId($userId)['Point']['id'];

		$point = $this->getActivityDetail($activityId)[self::$key[$typeId]];
		
		$saveData = [
			'action_type' => \PointLog::ADD,
			'user_id' => $userId,
			'record_id' => $activityId,
			'point' => $point,
			'reason_type_id' => \PointLog::ACTIVITY,
			'point_collect_id' => $pointId,
		];

		ClassRegistry::init('PointLog')->create();
		ClassRegistry::init('PointLog')->save($saveData);
	}

	public function getActivityDetail($activityId)
	{
		return $this->find('first', [
			'conditions' => [
				'Activity.id' => $activityId,
			],
		])['Activity'];
	}
}