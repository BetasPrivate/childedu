<?php
App::uses('PointLog', 'Model');
class Product extends AppModel {

	public $belongsTo = [
		'ProductType',
	];

	public $hasMany = [
		'ProductLog',
	];

	const ADD_STOCK = 1;
	const REDUCE_STOCK = 0;

	public function analyseProducts($products)
	{
		$virtualProducts = [];
		$frontPageProducts = [];
		$realProducts = [];
		foreach ($products as $product) {
			$isFrontPage = $product['Product']['is_front_page'];
			$isVirtual = $product['Product']['is_virtual'];
			if ($isVirtual == 0) {
				array_push($realProducts, $product);
			} else {
				array_push($virtualProducts, $product);
			}
			if ($isFrontPage == 1) {
				array_push($frontPageProducts, $product);
			}
		}

		if (sizeof($frontPageProducts) == 0) {
			$product = [];
			$product['Product']['pic_url1'] = 'img/eleven_header_pic1.jpg';
			for ($i = 0; $i <3; $i ++) {
				array_push($frontPageProducts, $product);
			}
		}


		if (sizeof($frontPageProducts) < 3) {
			$product = $frontPageProducts[0];
			$len = sizeof($frontPageProducts);
			for ($i = 0; $i < 3-$len; $i++) {
				array_push($frontPageProducts, $product);
			}
		}

		$result = [
			'real_products' => $realProducts,
			'virtual_products' => $virtualProducts,
			'front_page_products' => $frontPageProducts,
		];

		return $result;
	}

	public function getPicUrlArrByPicUrls($picUrls)
	{
		$arr = explode(',', $picUrls);

		if (sizeof($arr) < 3) {
			$url = $arr[0];
			$len = sizeof($arr);
			for ($i = 0; $i < 3-$len; $i++) {
				array_push($arr, $url);
			}
		}

		return $arr;
	}

	public function getPicUrlArrByProduct($product)
	{
		$picUrls = [];
		for ($i=1;$i<=3;$i++) {
			if (!empty($product['Product']['pic_url'.$i])) {
				array_push($picUrls, $product['Product']['pic_url'.$i]);
			} else {
				array_push($picUrls, $product['Product']['pic_url1']);
			}
		}

		return $picUrls;
	}

	public function purchaseProduct($id, $quantity)
	{
		$product = $this->find('first', [
			'conditions' =>  [
				'Product.id' => $id,
				'Product.is_onsale' => 1,
			],
		]);

		$result = [
			'status' => 0,
			'msg' => '',
		];

		if (!$product) {
			$result['msg'] = '该产品已下架，请刷新后请重试';
		} else {
			//记录product log扣库存，随后扣积分
			$product = $this->find('first', [
				'conditions' => [
					'Product.id' => $id,
				],
			]);
			$stock = $product['Product']['stock'];
			$pointCost = $product['Product']['price'] * $quantity;
			$pointInfo = ClassRegistry::init('Point')->getPointByUserId(AuthComponent::user('id'));
			if (empty($pointInfo['Point']['total']) || $pointInfo['Point']['total'] < $pointCost) {
				$result['msg'] = '您的积分不足哦~';
				return $result;
			}
			if ($stock < $quantity) {
				$result['msg'] = '该产品库存已不足，请选择其他产品';
			} else {
				$saveData = [
					'id' => $id,
					'stock' => $stock - $quantity,
					'type' => self::REDUCE_STOCK,
					'quantity' => $quantity,
					'point' => $pointCost,
					'point_collect_id' => $pointInfo['Point']['id'],
				];

				$saveResult = $this->save($saveData);

				if ($saveResult) {
					$result['status'] = 1;
				} else {
					$result['msg'] = '系统异常，请重试';
				}
			}
		}

		return $result;
	}

	function afterSave($created, $options=[])
	{
		parent::afterSave($created);

		if (!$created) {
			if (isset($this->data['Product']['stock']) && isset($this->data['Product']['type'])) {
				//减少库存的操作写入productlogs,用于记录交易
				if ($this->data['Product']['type'] == self::REDUCE_STOCK) {
					$this->genNewProductLog();
					//pointlog
					$this->genNewPointLog();
				}
			}
		}
	}

	public function genNewProductLog()
	{
		$this->ProductLog->create();
		$saveData = [
			'user_id' => AuthComponent::user('id'),
			'product_id' => $this->data['Product']['id'],
			'quantity' => $this->data['Product']['quantity'],
			'points' => $this->data['Product']['point'],
		];
		$this->productLogId = $this->ProductLog->save($saveData)['ProductLog']['id'];
	}

	public function genNewPointLog()
	{
		ClassRegistry::init('PointLog')->create();
		$saveData = [
			'action_type' => \PointLog::MINUS,
			'reason_type_id' => \PointLog::PURCHASE_PRODUCT,
			'point_collect_id' => $this->data['Product']['point_collect_id'],
			'record_id' => $this->productLogId,
			'point' => $this->data['Product']['point'],
			'user_id' => AuthComponent::user('id'),
		];
		ClassRegistry::init('PointLog')->save($saveData);
	}
}