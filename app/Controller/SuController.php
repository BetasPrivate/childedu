<?php
require_once('../Lib/Utility.php');
class SuController extends AppController
{
	public $uses = [
		'RegInfo',
	];

	public function index()
	{
		$this->set('title_for_layout', '后台管理');
		// $url = sprintf("https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=%s", 'gQrPRENT7MtBjMetpTDVMC4iWj8iF6x3dUcfHHp5leueq8Del-umLPMvmjAahu_DBPYDCoug2TZuRg5NVJ2tpRdqZanRZ9AULl-wIxR4uhgAWdf8fSSFMlm1Obsj_GC6NMMeAHAYXX');
		// $data = [
		// 	'expire_seconds' => '604800',
		// 	'action_name' => 'QR_SCENE',
		// 	'action_info' => [
		// 		'scene' => [
		// 			'scene_id' => '123',
		// 		],
		// 	],
		// ];
		// $a = new Utility();
		// $result = $a->customizeCurl($url, 1, $data);
		// var_dump($result);
		$url = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=gQH08DwAAAAAAAAAAS5odHRwOi8vd2VpeGluLnFxLmNvbS9xLzAyTUpxamtLVDljZTIxMHNXVk5wMTAAAgSc-y9ZAwSAOgkA';
	}

	public function regInfoManage()
	{
	}
}