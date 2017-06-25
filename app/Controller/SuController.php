<?php
class SuController extends AppController
{
    public $uses = [
        'RegInfo',
        'Token',
    ];

    public function index()
    {
        // $this->set('title_for_layout', '后台管理');
        // $util = new Utility();
        // $util->editMenu($this->Token->getToken());

        // $url = sprintf("https://api.weixin.qq.com/cgi-bin/menu/create?access_token=%s", 'Ai7yKVcttXGJhZl2LSELOm9rh1Dlm1QuUNa4OHzjxW_3vckN1HpoY1RqYpHKgIGJOiAQPDtlQ4ZWiS0V0Sjien3GoZ77Tvwoo97WVpMMPW8fEhEILncv-f487sJsJ0XPJWGhAAAANX');
        // $data = [
        //     'button' => [
        //         0 => [
        //             "name" => "test",
        //             'type' => 'view',
        //             'url' => 'http://childwelfare.zhanshen1.com/registration',
        //         ],
        //     ],
        // ];
        // var_dump(json_encode($data));
        // var_dump($a->customizeCurl($url, 1, $data));
    }


    public function regInfoManage()
    {
    }
}