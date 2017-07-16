<?php
App::uses('PunchRecord', 'Model');
class TestShell extends AppShell {
	public $uses = [
		'PunchRecord',
		'PunchType',
		'RegInfo',
		'ActivityInfo',
	];

	function main()
	{
		$reginfos = $this->RegInfo->find('all', [
			'conditions' => [

			],
		]);

		foreach($reginfos as $reginfo) {
			$data = $reginfo['RegInfo']['data'];
			$dataArr = json_decode($data, true);
			$saveData = [
				'user_name' => $dataArr['adultName'],
				'mobile_phone' => $dataArr['adultPhone'],
				'child_name' => $dataArr['childName'],
				'child_birth' => $dataArr['childBirthday'],
				'created' => $reginfo['RegInfo']['created'],
				'activity_id' => 1,
			];

			$this->ActivityInfo->create();
			$this->ActivityInfo->save($saveData);

		}
	}
}