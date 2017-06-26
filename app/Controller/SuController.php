<?php
App::uses('PointLog', 'Model');
App::uses('PunchType', 'Model');
class SuController extends AppController
{
    public $uses = [
        'RegInfo',
        'Token',
        'PunchType',
        'PointLog',
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

    public function pointManager()
    {
        $this->set('title_for_layout', '积分记录');

        $pointLogs = $this->PointLog->find('all', [
            'conditions' => [
                'PointLog.is_deleted' => 0,
            ],
        ]);

        foreach ($pointLogs as &$pointLog) {

            if (in_array($pointLog['PointLog']['reason_type_id'], [\PointLog::PUNCH, \PointLog::ACTIVITY])) {
                if (\PointLog::judgeLogIsPunch($pointLog)) {
                    $pointLog['origin_action'] = \PunchType::getPunchTypeDetail($pointLog['PunchRecord']['type_id'])['name'];
                } elseif (\PointLog::judgeLogIsActivity($pointLog)) {
                    $pointLog['origin_action'] = $pointLog['Activity']['name'];
                }
            } else {
                $pointLog['origin_action'] = \PointLog::$reasonTypes[$pointLog['PointLog']['reason_type_id']];
            }

            $pointLog['class_name'] = \PointLog::$classes[$pointLog['PointLog']['reason_type_id']];
        }

        $this->set(compact('pointLogs'));

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