<?php
require_once '../core/config.php';
if(isset($_SESSION['username'])){
    header('Location: /');
    exit;
}else{
require_once '../layout/header.php';
    if(isset($_POST['register'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $repassword = $_POST['repassword'];
        $check = $DB->fetch_assoc("SELECT * FROM `account` WHERE `username` = '{$username}'",1);
        if(strlen($username) < 6 || strlen($username) > 32 || strlen($password) < 6 || strlen($password) > 32 || strlen($repassword) < 6 || strlen($repassword) > 32) {
            die('<script>alert("Độ dài tài khoản hoặc mật khẩu không hợp lệ "); window.location.href="/auth/register.php";</script>');
        } else if($check) {
            die('<script>alert("Tài khoản đã tồn tại, vui lòng chọn tài khoản khác"); window.location.href="/auth/register.php";</script>');
        } else if($repassword != $password) {
            die('<script>alert("Mật khẩu chưa trùng nhau, vui lòng thử lại..."); window.location.href="/auth/register.php";</script>');
        } else {
            $_SESSION['username'] = $username;
           
            $DB->query("INSERT INTO `account`(`username`, `password`, `rule`) VALUES ('{$username}','{$password}','user')");
            die('<script>alert("Đăng ký thành công"); window.location.href="/htdocts/index.php";</script>');
        }
    }
    
?>

    <section class="delivery">

        <div class="container">
        <form method="post" action="">
            <div class="delivery-content row">
                <div class="delivery-content-left">
                    <p>Vui lòng đăng ký tài khoản</p>
                    <br>
                    <div class="delivery-content">
                        <div class="delivery-content-left-input-top-item">
                            <label for="">Tài khoản <span style="color: red;">*</span></label>
                            <input type="text" name="username" required>
                        </div>

                        <div class="delivery-content-left-input-top-item">
                            <label for="">Mật khẩu <span style="color: red;">*</span></label>
                            <input type="password" name="password" required>
                        </div>
                        <div class="delivery-content-left-input-top-item">
                            <label for="">Nhập lại mật khẩu <span style="color: red;">*</span></label>
                            <input type="password" name="repassword" required>
                        </div>
                    </div>  

                    <div class="delivery-content-left-button row">
                        <button type="submit" name="register"> <p style="font-weight: bold;">Đăng ký</p> </button>
                        <a href="/htdocts/auth/login.php">Quay lại đăng nhập    </a>
                    </div>
                </div>
               
            </div>
</form>
        </div>

    </section>

<!--Slide--------------------------------------->
        <section id="Slide"></section>        
<!-----------------------app-------------------->
<?php
require_once '../layout/footer.php';
}
?>