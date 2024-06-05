<?php

class DeleteCategory {
	public function __construct()
	{
		require_once('../../Model/admin/category.php');
		
		$categoryModel = new CategoryModel();
		
		if (isset($_GET['categoryId'])) {
			$categoryId = $_GET['categoryId'];
			$categoryModel->deleteCategory($categoryId);

			header('Location: ?controller=listCategory');
		}
		require('pages/category/add.php');
	}
}

