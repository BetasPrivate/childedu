<?php
class PunchController extends AppController {
	public $uses = [
		'PunchRecord',
		'Point',
		'PonitLog',
	];

	public function index()
	{

	}

	public function submitPunchRequest()
	{
		$data = $this->request->data;

		$result = [
			'status' => 1,
		];
		echo json_encode($result);
		exit();
	}

	public function punchImg()
	{
		$urlData = $this->request->data;

		$this->set(compact('urlData'));
	}
}