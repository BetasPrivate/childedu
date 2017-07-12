<?php
class ProductController extends AppController {

	public function index()
	{

	}

	public function detail()
	{
		
	}

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('index', 'detail');
	}
}