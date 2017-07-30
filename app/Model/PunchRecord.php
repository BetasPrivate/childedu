<?php
App::uses('PointLog', 'Model');
App::uses('PunchType', 'Model');
class PunchRecord extends AppModel {
	public $hasMany = [
		'PointLog' => [
			'className' => 'PointLog',
			'foreignKey' => 'record_id',
		],
	];

	public $belongsTo = [
		'PunchType' => [
			'className' => 'PunchType',
			'foreignKey' => 'type_id',
		],
		'User',
	];

	public $pointReasonType = null;

	public static function text($index)
	{
		$result = '未知打卡类型';
		if (isset(self::$texts[$index])) {
			$result = self::$texts[$index];
		}

		return $result;
	}

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
		$this->id = $punch['PunchRecord']['id'];
		
		$this->pointReasonType = \PointLog::SCAN_ASSISTANT;

		$this->save(['updated' => date('Y-m-d H:i:s')]);
	}

	public function saveResponseToShareInWeixin($punchId)
	{
		$saveData = [
			'id' => $punchId,
			'updated' => date('Y-m-d H:i:s'),
			//virtual
			'point_reason_type' => \PointLog::SHARE_TO_FRIENDS,
		];
		$this->save($saveData);
	}

	public function canContinueScan($punch)
	{
		$punchId = $punch['PunchRecord']['id'];
		$punchTypeId = $punch['PunchRecord']['type_id'];

		$pointLogsAll = $punch['PointLog'];
		$pointLogsAss = [];
		foreach($pointLogsAll as $pointLog) {
			if ($pointLog['reason_type_id'] == \PointLog::SCAN_ASSISTANT) {
				array_push($pointLogsAss, $pointLog);
			}
		}
		$total = $this->getTotalPointPerPunchRecord($pointLogsAss);
		if ($total < \PunchType::getPunchTypeDetail($punchTypeId)['assistant_point_total']) {
			return true;
		}

		return false;
	}

	public function getTotalPointPerPunchRecord($pointLogs)
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

	//新建打卡记录加积分（新增打卡、朋友助力扫码），分享到朋友圈加积分（更新打卡记录），
	function afterSave($created, $options=[])
	{
		if (empty($this->pointReasonType)) {
			if (isset($this->data['PunchRecord']['point_reason_type'])) {
				$this->pointReasonType = $this->data['PunchRecord']['point_reason_type'];
			} else {
				$this->pointReasonType = \PointLog::PUNCH;
			}
		}

		if ($created) {
			$this->savePointRecord();
		} else {
			//更新该二项时不需要统计分数
			if (!isset($this->data['PunchRecord']['qr_scene_ticket']) && !isset($this->data['PunchRecord']['img_url'])) {
				$this->data = $this->find('first', [
					'conditions' => [
						'PunchRecord.id' => $this->id,
					],
				]);
				$this->savePointRecord();
			}
		}
	}

	function savePointRecord()
	{
		$pointId = ClassRegistry::init('Point')->getPointByUserId($this->data['PunchRecord']['user_id'])['Point']['id'];

		$saveData = [
			'action_type' => \PointLog::ADD,
			'user_id' => $this->data['PunchRecord']['user_id'],
			'record_id' => $this->data['PunchRecord']['id'],
			'point' => \PunchType::getPunchTypeDetail($this->data['PunchRecord']['type_id'])['punch_point'],
			'reason_type_id' => $this->pointReasonType,
			'point_collect_id' => $pointId,
		];

		$this->PointLog->create();
		$this->PointLog->save($saveData);
	}

	public function getUrl($url)
	{
		return 'http://'.ROOT_URL.'/'.$url;
	}
}