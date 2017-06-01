<?php
class CallbackController extends AppController
{
    public $uses = [
        'User',
        'WxLog',
    ];

    function entrance()
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
        $eventKey = trim((string)$postObj->EventKey);
        if ($eventKey == '123'){
            $msg = '报名地址：http://childwelfare.zhanshen1.com/registration';
            $this->sendMsg($postObj, $msg);
        }
        
        $signature = isset($this->request->query['signature']) ? $this->request->query['signature'] : null;
        if ($signature) {
            $this->checkSignature();
        }
    }

    function sendMsg($obj, $msg)
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
}