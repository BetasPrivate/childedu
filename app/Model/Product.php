<?php
class Product extends AppModel {

	public $belongsTo = [
		'ProductType',
	];

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
			$product['Product']['pic_urls'] = 'img/eleven_header_pic1.jpg';
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
}