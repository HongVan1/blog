<?php
ob_start();
session_start();
class Login
{
    public function __construct()
    {
        /**
        * Nếu tồn tại $_SESSION['useradmin'] chuyển hướng vào trang admin
        * Ngược lại hiển thị giao diện đăng nhập
        * @var array
        */
        if (!empty($_SESSION['useradmin'])) {
            header('Location: View/admin');
        } else {
            $userModel = new UserModel();
            $error = $this->loginAdmin($userModel);

            require('View/client/pages/login_admin.php');
        }
    }

    public function loginAdmin($userModel)
    {
        $username = $password = $fullName = NULL;
        $error = array();
        $error['username_admin'] = $error['password_admin'] = NULL;

        if (!empty($_POST['login_admin'])) {
            if (empty($_POST['username_admin'])) {
                $error['username_admin'] = '* Cần điền tên đăng nhập';
            } else {
                $username = $_POST['username_admin'];
            }
            if (empty($_POST['password_admin'])) {
                $error['password_admin'] = '* Cần điền mật khẩu';
            } else {
                $password = $_POST['password_admin'];
            }

            if (!empty($username) && !empty($password)) {
                $result = $userModel->loginAdminn($username, $password);
                $check = $result->num_rows; /*đếm số dòng trong database*/
                /**
                 * Nếu số dòng trong database > 0 => lưu session + lấy dữ liệu + chuyển hướng
                 * Ngược lại thông báo alert bằng script
                 * @var array
        
                 */
                if ($check == 1) {
                    $data = $result->fetch_array(); /*lấy dữ liệu tương ứng với username và password nhập*/
                    $_SESSION['admin'] = $data[("full_name")]; /*lưu session*/
                    header('Location: View/admin');
                    
                } else {
                    echo "<script>alert('Sai mật khẩu hoặc tên đăng nhập')</script>";
                }
            }
        }

        return $error;
    }
}
ob_end_flush();