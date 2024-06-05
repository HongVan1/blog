<?php

class LogoutAdmin {
	public function __construct()
	{
		unset($_SESSION['admin']); // xóa session user đã tạo khi đăng nhập
		header('Location: ./'); // chuyển hướng về trang chủ
	}
}
$logoutAdmin = new LogoutAdmin();
