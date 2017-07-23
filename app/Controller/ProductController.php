<?php
class ProductController extends AppController {

	public $uses = [
		'Product',
		'ProductType',
	];

	public function index()
	{
		$products = $this->Product->find('all', [
			'conditions' => [
				'Product.is_deleted' => 0,
				'ProductType.is_deleted' => 0,
				'Product.is_onsale' => 1,
			],
		]);

		$productCat = $this->Product->analyseProducts($products);

		$result = [
			'products' => $productCat,
		];

		$this->set(compact('result'));
	}

	public function detail($productId=1)
	{
		$product = $this->Product->find('first', [
			'conditions' => [
				'Product.id' => $productId,
			],
		]);

		$product['Product']['pic_url_arr'] = $this->Product->getPicUrlArrByPicUrls($product['Product']['pic_urls']);

		$this->set(compact('product'));
	}

	public function addProductType()
	{
		$data = $this->request->data;
		$name = $data['name'];
		$this->ProductType->create();
		$saveRes = $this->ProductType->save(['name' => $name]);
		$result = [
			'status' => 0,
		];
		if ($saveRes) {
			$result['status'] = 1;
		} else {
			$result['msg'] = '保存失败，请稍后重试';
		}
		echo json_encode($result);
		exit();
	}

	public function editProductType()
	{
		$data = $this->request->data;
		$saveRes = $this->ProductType->save($data);

		$result = [
			'status' => 0,
		];
		if ($saveRes) {
			$result['status'] = 1;
		} else {
			$result['msg'] = '保存失败，请稍后重试';
		}
		echo json_encode($result);

		exit();
	}

	public function addProduct()
	{
		$data = $this->request->data;

		$baseCode = $data['file'];

		$baseArr = explode(',', $baseCode);
		$extend = explode(';', explode('/', $baseArr[0])[1])[0];
		$content = base64_decode($baseArr[1]);
		$productName = $data['name'];

		$imgUrl = 'tmp/'.time().$productName.'.'.$extend;
		//Store in the filesystem.
		$fp = fopen($imgUrl, "w");
		fwrite($fp, $content);
		fclose($fp);

		unset($data['file']);
		$data['pic_urls'] = $imgUrl;

		$this->Product->create();
		$saveRes = $this->Product->save($data);

		$result = [
			'status' => 0,
		];
		if ($saveRes) {
			$result['status'] = 1;
		} else {
			$result['msg'] = '保存失败，请稍后重试';
		}
		echo json_encode($result);
		exit();
	}

	public function purchaseProduct()
	{
		$data = $this->request->data;
	}

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('index', 'detail');
	}
}