<?php
class PointLog extends AppModel {
	public $belongsTo = [
		'PointCollect' => [
			'className' => 'Point',
			'foreignKey' => 'point_collect_id',
		],
	];

	const ADD = 1;
	const MINUS = 0;

	public static $text = [
		self::ADD => '增加积分',
		self::MINUS => '减少积分',
	];

	function afterSave($created, $options=[])
	{
		parent::afterSave($created);

		if ($created) {
			$pointCollect = $this->PointCollect->find('first', [
				'conditions' => [
					'user_id' => $this->data['PointLog']['user_id'],
				],
			]);

			if (!$pointCollect) {
				$this->PointCollect->create();
				$rec = $this->PointCollect->save(['user_id' => $this->data['PointLog']['user_id']]);
				$pointId = $rec['PointCollect']['id'];
				$total = $rec['PointCollect']['total'];
			} else {
				$pointId = $pointCollect['PointCollect']['id'];
				$total = $pointCollect['PointCollect']['total'];
			}
			$this->save(['id' => $this->data['PointLog']['id'], 'point_collect_id' => $pointId]);

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