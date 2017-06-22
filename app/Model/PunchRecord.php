<?php
class PunchRecord extends AppModel {
	const ACCOMPANY_READ_PUNCH = 1;
	const ACTIVITY_PUNCH = 2;
	const CLZ_PUNCH = 3;
	const ASSISTANT_PUNCH = 4;

	public static $texts = [
		self::ACCOMPANY_READ_PUNCH  => '陪伴阅读打卡',
		self::ACTIVITY_PUNCH => '活动打卡',
		self::CLZ_PUNCH => '课堂打卡',
		self::ASSISTANT_PUNCH => '助教打卡',
	];
}