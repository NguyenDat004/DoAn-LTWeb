<?php
require_once '../core/config.php';
require_once '../layout/header.php';
$sanpham = $_GET['sanpham'];
$check = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `product` WHERE `ckcode` = '$sanpham '"));
if(isset($_POST['addcart'])) {
    $amount = $_POST['amount'];
    if(isset($_SESSION['username'])) {
    $DB->query("INSERT INTO `cart` (`name`, `price`, `amount`, `loai`, `images`, `username`) VALUES ('{$check['name']}', '{$check['price']}', '{$amount}', '{$check['type']}', '{$check['images']}','{$username}') ");
    die('<script>alert("Thêm vào giỏ hàng thành công"); window.location.href="";</script>');
    } else {
        die('<script>alert("Vui lòng đăng nhập để mua sản phẩm "); window.location.href="/htdocts/auth/login.php";</script>');
    }
}
?>
<section class="product">
            <div class="container">
                <div class="product-top row">
                   <a href="../index.php"><p>Trang chủ</p></a>
                    <span>&#10230; </span> 
                    <p style="color:#800000;"><?= $check['name']; ?></p>
                </div>
                <div class="product-content row">
                    <div class="product-content-left">
                        <div class="product-content-left-big-img">
                            <img src="<?= $check['images']; ?>" alt="">
                        </div>
                    </div>
                    <!--right text-->
                   
                    <div class="product-content-right ">
                        <div class="product-content-right-product-name">
                            <h1><?= $check['name']; ?></h1>
                        </div>
                        <div class="product-content-right-product-price">
                            <p style="color:red;"><?= number_format($check['price']); ?><sup>đ</sup></p>
                        </div>
                      
                        <form method="POST" action="">
                        <div class="quantity">
                            <p style="font-weight: bold;">Số lượng: &nbsp;</p>
                            <input type="number" name="amount" min="0" value="1">
                        </div>

                 
                        <div class="product-content-right-product-button">
                            <button type="submit" name="addcart"><i class="fas fa-shopping-cart"></i> <p>Thêm vào giỏ hàng</p></button>
                        </div>
                        </form> 
   <br>
                        <div class="product-content-right-product-icon">
                            <div class="product-content-right-product-icon-item">
                                <i class="fas fa-phone-alt"></i> <p style="margin-left: 5px;"> Hotline</p> 
                            </div>

                            <div class="product-content-right-product-icon-item">
                                <i class="fas fa-comments"></i> <p style="margin-left: 5px;"> Chat</p>
                            </div>

                            <div class="product-content-right-product-icon-item">
                                <i class="fas fa-envelope"></i> <p style="margin-left: 5px;"> Mail</p>
                            </div>
                        </div>
                        <div class="product-content-right-buttom">
                            <div class="product-content-right-buttom-top">
                                &#8744;
                            </div>
                            <!--Chú ý chỗ này-->
                            <div class="product-content-right-buttom-content-big">
                                <div class="product-content-right-buttom-content-title row">
                                    <div class="product-content-right-buttom-content-title-item chitiet">
                                        <p style="font-weight: bold;">Chi tiết</p>
                                    </div>

                                    <div class="product-content-right-buttom-content-title-item baoquan">
                                        <p style="font-weight: bold;">Bảo quản</p>
                                    </div>

                                </div>
                                <div class="product-content-right-buttom-content">
                                    <div class="product-content-right-buttom-content-chitiet">
                                       Nước hoa, nói chung, là một phương tiện tinh tế để thể hiện cá tính, cảm xúc và phong cách của mỗi người<br/>

                                        Mỗi loại nước hoa đều có sự kết hợp khác nhau giữa hương đầu, hương giữa và hương cuối, tạo nên các tầng mùi phức tạp và độc đáo.
                                    </div>

                                    <div class="product-content-right-buttom-content-baoquan">
                                        Chi tiết bảo quản sản phẩm : 

                                        * Tránh ánh sáng trực tiếp, giữ nhiệt độ ổn định, tránh độ ẩm cao, đóng nắp kín sau khi sử dụng, bảo quản trong chai gốc, không lắc chai nước hoa.
                                    </div>

                                </div>

                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>      
        </section>

  
<!-----------------------app-------------------->
<?php
require_once '../layout/footer.php';
?>