<?php
class Activity {
	const REGISTRATION = 1;

	public static $texts = [
		self::REGISTRATION => '报名',
	];

	public static function text($index)
	{
		$result = '未知';
		if (isset(self::$texts[$index])) {
			$result = self::$texts[$index];
		}
		
		return $result;
	}
}