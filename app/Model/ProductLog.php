<?php
class ProductLog extends AppModel {
	public $belongsTo = [
		'Product',
		'User',
	];

	public function getProductLogByUserId($userId)
	{
		$productLogs = $this->find('all', [
            'conditions' => [
                'ProductLog.is_deleted' => 0,
                'ProductLog.user_id' => $userId,
            ],
        ]);

        return $productLogs;
	}
}