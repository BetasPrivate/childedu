<?php
App::uses('PointLog', 'Model');
App::uses('PunchType', 'Model');
App::uses('Activity', 'Model');
class SuController extends AppController
{
    public $uses = [
        'RegInfo',
        'Token',
        'PunchType',
        'PointLog',
        'Activity',
        'ActivityInfo',
        'PunchRecord',
        'ProductType',
        'ProductType',
        'Product',
    ];

    public function index()
    {
        $this->set('title_for_layout', '后台管理');

        $punchTypes = $this->PunchType->find('all', [
            'conditions' => [
                'PunchType.is_deleted' => 0,
            ],
        ]);

        $productTypes = $this->ProductType->find('all', [
            'conditions' => [
                'ProductType.is_deleted' => 0,
            ],
        ]);

        $result['punch_types'] = $punchTypes;

        $result['product_types'] = $productTypes;

        $result['activity_fields'] = \Activity::$fieldTexts;

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
                    $pointLog['origin_action'] = $pointLog['Activity']['title'];
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

    public function activityManager()
    {
        $this->set('title_for_layout', '活动一览');

        $activities = $this->Activity->find('all', [
            'conditions' => [
                'Activity.is_deleted' => 0,
            ],
        ]);

        foreach($activities as &$activity) {
            $fieldStr = $activity['Activity']['fields'];
            if ($fieldStr == '') {
                continue;
            }
            $fieldTexts = implode(',', \Activity::getFieldArr($fieldStr));
            $activity['Activity']['fields'] = $fieldTexts;
        }

        $this->set(compact('activities'));
    }

    public function activityInfoManager()
    {
        $this->set('title_for_layout', '活动报名信息');

        $infos = $this->ActivityInfo->find('all', [
            'conditions' => [
                'ActivityInfo.is_deleted' => 0,
            ],
            'order' => [
                'ActivityInfo.created DESC',
            ],
        ]);

        $this->set(compact('infos'));
    }

    public function punchRecordManager()
    {
        $this->set('title_for_layout', '打卡记录');

        $punchRecords = $this->PunchRecord->find('all', [
            'conditions' => [
                'PunchRecord.is_deleted' => 0,
            ],
            'order' => [
                'PunchRecord.created DESC',
            ],
        ]);

        $this->set(compact('punchRecords'));
    }

    public function productManager()
    {
        $this->set('title_for_layout', '产品管理');

        $products = $this->Product->find('all', [
            'conditions' => [
                'Product.is_deleted' => 0,
                'ProductType.is_deleted' => 0,
            ],
        ]);

        foreach ($products as &$product) {
            $picUrls = [];
            for ($i=1;$i<=3;$i++) {
                array_push($picUrls, $product['Product']['pic_url'.$i]);
            }
            $product['pic_urls'] = $picUrls;
        }

        $this->set(compact('products'));
    }

    public function refreshMenu()
    {
        $util = new Utility();
        $util->editMenu($this->Token->getToken());
        exit;
    }
}