<?php
App::uses('PunchRecord', 'Model');
App::uses('PunchType', 'Model');
class CallbackController extends AppController
{
    public $uses = [
        'User',
        'WxLog',
        'PunchRecord',
        'Point',
        'Activity',
    ];

    function entrance()
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
        $eventKey = trim((string)$postObj->EventKey);
        $event = trim((string)$postObj->Event);
        echo 'success';

        $this->WxLog->create();
        $this->WxLog->save(['data' => $postStr]);
        if ($eventKey == '1'){
            $msg = '报名地址：http://childwelfare.zhanshen1.com/registration';
            $this->sendTextMsg($postObj, $msg);
        } else if ($event == 'CLICK') {
            $this->dealWithClickEvents($postObj);
        } elseif ($event == 'SCAN') {
            $this->dealWithScanEvents($postObj);
        }
        
        $signature = isset($this->request->query['signature']) ? $this->request->query['signature'] : null;
        if ($signature) {
            $this->checkSignature();
        }
    }

    function sendTextMsg($obj, $msg)
    {
        $toUserName = (string)$obj->ToUserName;
        $fromUsername = (string)$obj->FromUserName;
        $createTime = time();
        $textTpl = "<xml>
            <ToUserName><![CDATA[%s]]></ToUserName>
            <FromUserName><![CDATA[%s]]></FromUserName>
            <CreateTime>$createTime</CreateTime>
            <MsgType><![CDATA[text]]></MsgType>
            <Content><![CDATA[%s]]></Content>
            <FuncFlag>0</FuncFlag>
            </xml>";
        echo sprintf($textTpl, $fromUsername, $toUserName, $msg);
        exit();
    }

    function checkSignature()
    {
        $echoStr = isset($this->request->query['echostr']) ? $this->request->query['echostr'] : null;
        $timeStamp = isset($this->request->query['timestamp']) ? $this->request->query['timestamp'] : null;
        $nonce = isset($this->request->query['nonce']) ? $this->request->query['nonce'] : null;
        $token = 'zhanshenkeji';
        $tmpArr = array($token, $timeStamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        if ($tmpStr == $signature) {
            echo $echoStr;
            exit();
        }
    }

    function dealWithClickEvents($obj)
    {
        $eventKey = trim((string)$postObj->EventKey);
        switch ($eventKey) {
            case 'WX_PLAYER_REG':
                $this->sendPicMsg($obj, $mediaId);
                break;
            case 'WX_PLAYER_INTRO':
                $this->sendPicMsg($obj, $mediaId);
                break;
            case 'WX_COMPANY_INTRO':
                $this->sendPicMsg($obj, $mediaId);
                break;
            case 'WX_CONTACT_US':
                $this->sendPicMsg($obj, $mediaId);
                break;
        }
    }

    function dealWithScanEvents($obj)
    {
        $ticket = trim((string)$obj->Ticket);
        $eventKey = trim((string)$obj->EventKey);
        $fromUsername = trim((string)$obj->FromUserName);

        $isPunch = $this->PunchRecord->find('first', [
            'contain' => [
                'PointRecord',
            ],
            'conditions' => [
                'qr_scene_ticket' => $ticket,
            ]
        ]);

        if ($isPunch) {
            if ($isPunch['PunchRecord']['id'] == $eventKey) {
                if ($this->PunchRecord->canContinueScan($isPunch)) {
                    $this->PunchRecord->addPunchPointsScan($isPunch);
                    $msg = '助力成功！对方会增加 '.\PunchType::getPunchTypeDetail($isPunch['PunchRecord']['type_id'])['assistant_point'].' 积分';
                } else {
                    $msg = '抱歉，该用户助力加油得积分次数已达上限';
                }
                $this->sendTextMsg($obj, $msg);
            }
        } else {
            $isActivity = $this->Activity->find('first', [
                'conditions' => [
                    'Activity.offline_ticket' => $ticket,
                    'Activity.is_deleted' => 0,
                ],
            ]);
            if ($isActivity) {
                $msg = $this->Activity->addPointByActivityScan($isActivity, $fromUsername);
                $this->sendTextMsg($obj, $msg);
            }
        }
        echo 'success';
        exit;
    }

    function sendPicMsg($obj, $mediaId)
    {
        $toUserName = (string)$obj->ToUserName;
        $fromUsername = (string)$obj->FromUserName;
        $createTime = time();
        $textTpl = "<xml>
            <ToUserName><![CDATA[%s]]></ToUserName>
            <FromUserName><![CDATA[%s]]></FromUserName>
            <CreateTime>$createTime</CreateTime>
            <MsgType><![CDATA[image]]></MsgType>
            <Image>
            <MediaId><![CDATA[%s]]></MediaId>
            </Image>
            </xml>";
        echo sprintf($textTpl, $fromUsername, $toUserName, $mediaId);
        exit();
    }

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('entrance');
    }
}