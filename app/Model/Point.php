<?php
class Point extends AppModel {

	public function getPointByUserId($userId){

		$point = $this->find('first', [
			'conditions' => [
				'user_id' => $userId,
			],
		]);

		if ($point) {
			return $point;
		}

		$this->create();

		return $this->save(['user_id' => $userId]);
	}
}