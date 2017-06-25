<?php
App::uses('PunchRecord', 'Model');
class TestShell extends AppShell {
	public $uses = [
		'PunchRecord',
	];

	function main()
	{
		$msg = '助力成功！对方会增加 '.\PunchRecord::$punchTypePointRelation[\PunchRecord::SCAN_ASSISTANT].' 积分';
        echo $msg;
	}
}