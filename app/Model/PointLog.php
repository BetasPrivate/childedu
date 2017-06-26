<?php
App::uses('AppModel', 'Model');
class PointLog extends AppModel {

	public $belongsTo = [
		'PointCollect' => [
			'className' => 'Point',
			'foreignKey' => 'point_collect_id',
		],
		'PunchRecord' => [
			'className' => 'PunchRecord',
			'foreignKey' => 'record_id',
		],
		'Activity' => [
			'className' => 'ChildActivity',
			'foreignKey' => 'record_id',
		],
		'User',
	];

	const PUNCH = 1;
	const SHARE_TO_FRIENDS = 2;
	const SCAN_ASSISTANT = 3;
	const ACTIVITY = 4;

	const ADD = 1;
	const MINUS = 0;

	public static $reasonTypes = [
		self::PUNCH => '一般打卡',
		self::SHARE_TO_FRIENDS => '分享朋友圈',
		self::SCAN_ASSISTANT => '助力加油',
		self::ACTIVITY => '活动报名',
	];

	public static $classes = [
		self::PUNCH => 'info',
		self::SHARE_TO_FRIENDS => 'success',
		self::SCAN_ASSISTANT => 'primary',
		self::ACTIVITY => 'warning',
	];

	public static $text = [
		self::ADD => '增加积分',
		self::MINUS => '减少积分',
	];

	function afterSave($created, $options=[])
	{
		parent::afterSave($created);

		if ($created) {
			$point = $this->PointCollect->find('first', [
				'conditions' => [
					'id' => $this->data['PointLog']['point_collect_id'],
				],
			]);

			$pointId = $point['PointCollect']['id'];
			$total = $point['PointCollect']['total'];
			$pointPer = $this->data['PointLog']['point'];
			$actionType = $this->data['PointLog']['action_type'];

			if ($actionType == self::ADD) {
				$total += $pointPer;
			} elseif ($actionType == self::MINUS) {
				$total -= $pointPer;
			}

			$this->PointCollect->id = $pointId;
			$this->PointCollect->save(['total' => $total]);
		}
	}

	public function getTotalPointThroughPointLogs($pointLogs)
	{
		$total = 0;
		foreach ($pointLogs as $pointLog) {
			$actionType = $pointLog['action_type'];
			$point = $pointLog['point'];
			if ($actionType == \PointLog::ADD) {
				$total += $point;
			} elseif ($actionType == \PointLog::MINUS) {
				$total -= $point;
			}
		}

		return $total;
	}

	public static function judgeLogIsPunch($pointLog)
	{
		if (!empty($pointLog['PunchRecord']['id'])) {
			return true;
		}

		return false;
	}

	public static function judgeLogIsActivity($pointLog)
	{
		if (!empty($pointLog['Activity']['id'])) {
			return true;
		}

		return false;
	}

}