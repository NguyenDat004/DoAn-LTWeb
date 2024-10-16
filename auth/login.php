<?php
require_once '../core/config.php';
if(isset($_SESSION['username'])){
    header('Location: /');
    exit;
}else{
require_once '../layout/header.php';
    if(isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $check = $DB->fetch_assoc("SELECT * FROM `account` WHERE `username` = '{$username}'",1);
        if(strlen($username) < 6 || strlen($username) > 32 || strlen($password) < 6 || strlen($password) > 32) {
            die('<script>alert("Độ dài tài khoản hoặc mật khẩu không hợp lệ "); window.location.href="/htdocts/auth/login.php";</script>');
        } else if(!$check) {
            die('<script>alert("Tài khoản không tồn tại, vui lòng đăng ký tài khoản"); window.location.href="/htdocts/auth/login.php";</script>');
        } else if($check['id'] && $password != $check['password']) {
            die('<script>alert("Mật khẩu không chính xác, vui lòng thử lại"); window.location.href="/htdocts/auth/login.php";</script>');
        } else {
            $_SESSION['username'] = $username;
            die('<script>alert("Đăng nhập thành công"); window.location.href="/htdocts/index.php";</script>');
        }
    }
    
?>

    <section class="delivery">

        <div class="container">
        <form method="post" action="">
            <div class="delivery-content row">
                <div class="delivery-content-left">
                    <p>Vui lòng đăng nhập</p>
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
                    </div>

                    <div class="delivery-content-left-button row">
                        <button type="submit" name="login"> <p style="font-weight: bold;">Đăng nhập</p> </button>
                        <a href="/htdocts/auth/register.php">Đăng ký ngay   </a>
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