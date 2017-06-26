<?php
App::uses('PointLog', 'Model');
class ChildActivity extends AppModel {

	const POINT_ON_SUBMIT = 0;
	const POINT_ON_SCAN = 1;

	public static $key = [
		self::POINT_ON_SUBMIT => 'point_onsubmit',
		self::POINT_ON_SCAN => 'point_onscan',
	];

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
				'ChildActivity.id' => $activityId,
			],
		])['ChildActivity'];
	}
}