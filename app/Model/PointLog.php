<?php
App::uses('AppModel', 'Model');
class PointLog extends AppModel {

	public $belongsTo = [
		'PointCollect' => [
			'className' => 'Point',
			'foreignKey' => 'point_collect_id',
		],
		'PunchRecord',
	];

	const PUNCH = 1;
	const SHARE_TO_FRIENDS = 2;
	const SCAN_ASSISTANT = 3;

	const ADD = 1;
	const MINUS = 0;

	public static $reasonTypes = [
		self::PUNCH => '一般打卡',
		self::SCAN_ASSISTANT => '助力加油',
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


}