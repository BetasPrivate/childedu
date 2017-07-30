<?php
class PunchBgImg extends AppModel {
	const BG = 'bg';
	const LOGO = 'logo';

	public static $text = [
		self::BG => '背景图片',
		self::LOGO => '商家logo',
	];

	public static function text($index) {
		$result = '未知';
		if (isset(self::$text[$index])) {
			$result = self::$text[$index];
		}

		return $result;
	}

	public function getBgImg($type)
	{
		return $this->find('all', [
			'conditions' => [
				'type' => $type,
			],
		]);
	}
}