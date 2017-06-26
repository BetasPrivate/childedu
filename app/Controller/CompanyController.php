<?php
class CompanyController extends AppController {

	public function index($companyId = 1)
	{

	}

	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index');
    }
}