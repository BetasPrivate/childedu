<?php
class SuController extends AppController
{
    public $uses = [
        'RegInfo',
        'Token',
        'PunchType',
    ];

    public function index()
    {
        $this->set('title_for_layout', '后台管理');

        $punchTypes = $this->PunchType->find('all', [
            'conditions' => [
                'PunchType.is_deleted' => 0,
            ],
        ]);

        $result['punch_types'] = $punchTypes;

        $this->set(compact('result'));
    }


    public function regInfoManage()
    {
    }

    public function refreshMenu()
    {
        $util = new Utility();
        $util->editMenu($this->Token->getToken());
        exit;
    }
}