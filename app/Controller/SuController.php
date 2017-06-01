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
    }

    public function regInfoManage()
    {
    }
}