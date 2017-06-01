<?php
class Utility {

	public function customizeCurl($url, $opt=0, $data=[])
    {
        $ch = curl_init();
        if ($opt == 1) {
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 300);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        } else {
            $curlDefault = [
                CURLOPT_URL => $url,
                CURLOPT_TIMEOUT => 300,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_HTTPAUTH => CURLAUTH_ANY,
                CURLOPT_FOLLOWLOCATION => TRUE,
            ];
            curl_setopt_array($ch, $curlDefault);
        }
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function getSceneTicket($token, $expireSeconds, $scendId, $isTemp = true)
    {
        $url = sprintf("https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=%s", $token);
        $data = [
            'expire_seconds' => 604800,
            'action_info' => [
                'scene' => [
                    'scene_id' => 1,
                ],
            ],
        ];
        if ($isTemp) {
            $data['action_name'] = 'QR_SCENE';
        } else {
            $data['action_name'] = 'QR_LIMIT_SCENE';
        }
        $resultStr = $this->customizeCurl($url, 1, $data);

        $result = json_decode($resultStr, true);
        $ticket = isset($result['ticket']) ? $result['ticket'] : '';

        return $ticket;
    }

    public function editMenu($token = '')
    {
        $token = 'GPyLUiLXLJOVfU8p3U7RD9IYaxUb5kecVCg9lAsjVzdGp-EGSSKJZwn9Za5TKElQV2_HWrPIslGjZ72k6U6zAcro9PuR8qZw0c5-6y_a5vHtn5ldk6kP9Q_xdu9ZZhxhJQScADATAC';
        $url = sprintf("https://api.weixin.qq.com/cgi-bin/menu/create?access_token=%s", $token);
          $data = [
            'button' => [
                0 => [
                    "name" => urlencode('陪玩师'),
                    'type' => 'click',
                    'key' => 'DO_NOTHING',
                    'sub_button' => [
                        0 => [
                            'name' => urlencode('陪玩师报名'),
                            'type' => 'view',
                            // 'key' => 'WX_PLAYER_REG',
                            'url' => 'http://childwelfare.zhanshen1.com/pic1.jpg',
                        ],
                        1 => [
                            'name' => urlencode('陪玩师简介'),
                            'type' => 'view',
                            // 'key' => 'WX_PLAYER_INTRO',
                            'url' => 'http://childwelfare.zhanshen1.com/pic2.jpg',
                        ],
                    ],
                ],
                1 => [
                    "name" => urlencode('小玩子'),
                    'type' => 'click',
                    'key' => 'DO_NOTHING',
                    'sub_button' => [
                        0 => [
                            'name' => urlencode('小玩子简介'),
                            'type' => 'view',
                            'url' => 'http://mp.weixin.qq.com/s?__biz=MzIwODY1NDI0MQ==&mid=2247483757&idx=1&sn=d2803d29a64ea920ae4e19edf397ba27&chksm=977e9ba3a00912b539a0cafc23d33b50845ab4c55e38d89705ed38b31f5bd3997bf3d0a74d83&scene=18#wechat_redirect',
                        ],
                        1 => [
                            'name' => urlencode('小玩子报名'),
                            'type' => 'view',
                            'url' => 'https://wj.qq.com/s/993617/73e1/',
                        ],
                        2 => [
                            'name' => urlencode('活动报名'),
                            'type' => 'view',
                            'url' => 'http://childwelfare.zhanshen1.com/registration',
                        ],
                    ],
                ],
                2 => [
                    "name" => urlencode('玩趣童年'),
                    'type' => 'click',
                    'key' => 'DO_NOTHING',
                    'sub_button' => [
                        0 => [
                            'name' => urlencode('公司简介'),
                            'type' => 'view',
                            'url' => 'http://childwelfare.zhanshen1.com/pic3.jpg',
                            // 'key' => 'WX_COMPANY_INTRO',
                        ],
                        1 => [
                            'name' => urlencode('联系我们'),
                            'type' => 'view',
                            'url' => 'http://childwelfare.zhanshen1.com/pic4.jpg',
                            // 'key' => 'WX_CONTACT_US',
                        ],
                    ],
                ],
            ],
        ];
        $data = json_encode($data);
        $data = urldecode($data);

        var_dump($this->customizeCurl($url, 1, $data));
    }

    public function addMedia($token = '')
    {
        $postUrl = sprintf("https://api.weixin.qq.com/cgi-bin/material/add_news?access_token=%s", '_gl-huotDRouGUtWzO8xKEB3xGuFHgOmJ6QgA2Eli0n6HHQTW8e8XTCWos8CAFmu47qB0lhOCwcIgC9MSCKE5JOQA1bXpivfN9rLfhZhHkyrEtrMXSQ3u7aHQcYJiw2DPVPaAHAAGA');
        $url = 'http://childwelfare.zhanshen1.com/pic1.jpg';
        $data = [
            'articles' => [
                0 => [
                    "title" => 'pic1',
                    "thumb_media_id" => 'pic1',
                    "author" => 'cary',
                    "digest" => 'empty',
                    "show_cover_pic" => 0,
                    "content" => 'empty',
                    "content_source_url" => $url,
                ],
            ],
        ];
        $data = json_encode($data);

        var_dump($this->customizeCurl($postUrl, 1, $data));
    }
}