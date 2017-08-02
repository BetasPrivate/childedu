<?php
App::uses('PointLog', 'Model');
App::uses('PunchType', 'Model');
App::uses('Activity', 'Model');
App::uses('User', 'Model');
App::uses('PunchBgImg', 'Model');
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
        'User',
        'ProductLog',
        'PunchBgImg',
    ];

    public function index()
    {
        $this->set('title_for_layout', '后台管理');

        $activity = [];

        $activityId = isset($this->request->query['activityId']) ? $this->request->query['activityId'] : null;

        if (!empty($activityId)) {
            $activity = $this->Activity->find('first', [
                'conditions' => [
                    'Activity.id' => $activityId,
                ],
            ]);
        }

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

        $result['activity'] = $activity;

        $result['activityId'] = $activityId;

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

    public function userManager()
    {
        $this->set('title_for_layout', '用户管理');

        $users = $this->User->find('all', [
            'order' => [
                'is_activated DESC',
            ],
        ]);

        foreach ($users as &$user) {
            $user['clz_name'] = \User::className($user['User']['is_activated']);
        }

        $this->set(compact('users'));
    }

    public function refreshMenu()
    {
        $util = new Utility();
        $util->editMenu($this->Token->getToken());
        exit;
    }

    public function editUserSu()
    {
        $data = $this->request->data;
        $data['password'] = $data['passwd'];
        $data['id'] = $data['user_id'];
        $saveRes = $this->User->save($data);
        $result = [
            'status' => 1,
            'msg' => '',
        ];
        if (!$saveRes) {
            $result['msg'] = '保存失败，请稍后重试';
        }
        echo json_encode($result);
        exit();

    }

    public function productLogs()
    {
        $conditions = [
            'ProductLog.is_deleted' => 0,
        ];

        $productLogs = $this->ProductLog->find('all', [
            'conditions' => $conditions,
        ]);

        $this->set(compact('productLogs'));
    }

    public function genQrCodeForActivity()
    {
        $data = $this->request->data;
        $activityId = $data['id'];
        $token = $this->Token->getToken();

        $util = new Utility();
        $ticketResult = $util->getSceneTicketUrl($token, 604800, $activityId, false);

        $result = [
            'status' => 0,
            'msg' => ''
        ];


        $url = isset($ticketResult['url']) ? $ticketResult['url'] : false;
        $ticket = isset($ticketResult['ticket']) ? $ticketResult['ticket'] : false;
        if ($url && $ticket) {
            $saveData = [
                'id' => $activityId,
                'offline_ticket' => $ticket,
                'offline_url' => $url,
            ];
            $saveRes = $this->Activity->save($saveData);
            if ($saveRes) {
                $result['url'] = $url;
                $result['status'] = 1;
            } else {
                $result['msg'] = '保存失败，请稍后重试';
            }
        } else {
            $result['msg'] = '获取二维码失败，请稍后重试';
        }

        echo json_encode($result);
        exit();

    }

    public function punchBgImgManager()
    {
        $imgs = $this->PunchBgImg->find('all', [
        ]);

        foreach ($imgs as &$img) {
            $img['PunchBgImg']['url'] = $this->PunchRecord->getUrl($img['PunchBgImg']['url']);
            $img['PunchBgImg']['type_text'] = \PunchBgImg::text($img['PunchBgImg']['type']);
            if ($img['PunchBgImg']['type'] == 'logo') {
                $img['PunchBgImg']['type_text'] .= $img['PunchBgImg']['id'] -1;
            }
        }

        $this->set(compact('imgs'));
    }

    function beforeFilter()
    {
        parent::beforeFilter();
    }

    function afterFilter()
    {
        parent::afterFilter();
        if (AuthComponent::user('role') == 0) {
            $this->redirect('/users/noAuthentication');
        }
    }
}