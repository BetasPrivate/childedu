<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
class User extends AppModel {

    public $hasOne = [
        'Point',
    ];

	public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'A username is required'
            )
        ),
        // 'role' => array(
        //     'valid' => array(
        //         'rule' => array('inList', array('admin', 'author')),
        //         'message' => 'Please enter a valid role',
        //         'allowEmpty' => false
        //     )
        // )
    );

    public $virtualFields = [
        "role_name" => 'if (role = 0, "普通用户", "管理员")',
    ];

    const IN_ACTIVATED = 0;
    const ACTIVATED = 1;
    
    public static $texts = [
        self::IN_ACTIVATED => "已被禁用",
        self::ACTIVATED => "正在启用",
    ];

    public static $classes = [
        self::IN_ACTIVATED => 'warning',
        self::ACTIVATED => 'success',
    ];

    public static function className($index)
    {
        $result = 'active';
        if (isset(self::$classes[$index])) {
            $result = self::$classes[$index];
        }

        return $result;
    }

	public function beforeSave($options = array()) {
	    if (isset($this->data[$this->alias]['password'])) {
	        $passwordHasher = new BlowfishPasswordHasher();
	        $this->data[$this->alias]['password'] = $passwordHasher->hash(
	            $this->data[$this->alias]['password']
	        );
	    }
	    return true;
	}

    public function getUserByName($username)
    {
        $user = $this->find('first', [
            'conditions' => [
                'username' => $username,
            ],
        ]);

        return $user;
    }

    public function getUserByOpenId($openId)
    {
        $user = $this->find('first', [
            'conditions' => [
                'open_id' => $openId,
            ],
        ]);

        return $user;
    }
}