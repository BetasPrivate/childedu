<?php
class PunchType extends AppModel {

	function createPunchType()
	{
		$this->create();

		$saveData = [
			'name' => '助教打卡',
			'punch_point' => 20,
			'share_point' => 10,
			'assistant_point' => 20,
			'assistant_point_total' => 100,
		];

		$this->save($saveData);
	}

	public static function getPunchTypeDetail($punchType)
	{
		$pt = new PunchType();

		return $pt->getPunchTypeDetail2($punchType);
	}

	public function getPunchTypeDetail2($punchType)
	{
		return $this->find('first', [
			'conditions' => [
				'id' => $punchType,
			],
		])['PunchType'];
	}
	
}