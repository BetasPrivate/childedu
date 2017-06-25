<?php
App::uses('PunchRecord', 'Model');
class TestShell extends AppShell {
	public $uses = [
		'PunchRecord',
		'PunchType',
	];

	function main()
	{
		$this->PunchType->createPunchType();
	}
}