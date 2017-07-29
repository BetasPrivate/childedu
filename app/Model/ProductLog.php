<?php
class ProductLog extends AppModel {
	public $belongsTo = [
		'Product',
		'User',
	];
}