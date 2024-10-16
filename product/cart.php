<?php
require_once '../core/config.php';
if(empty($_SESSION['username'])){
    header('Location: /');
    exit;
}else{
require_once '../layout/header.php';
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM `cart` WHERE `id` = $id";
    mysqli_query($conn, $query);

    // Thông báo và chuyển hướng
    echo '<script>
        alert("Sản phẩm đã được xóa");
        window.location.href = "/product/cart.php";
    </script>';
    exit();
}
    if(isset($_POST['pay'])) {
    //     $query = mysqli_query($conn, "SELECT * FROM `cart` ORDER BY id ASC");
    // while ($row = mysqli_fetch_array($query)) {
    //     $name = mysqli_real_escape_string($conn, $row['name']);
    //     $price = $row['price'];
    //     $amount = $row['amount'];
    //     $type = mysqli_real_escape_string($conn, $row['type']);
        
        // Chèn dữ liệu vào bảng orders
        // $DB->query("INSERT INTO `orders` (`name`, `price`, `amount`, `create_time`, `status`) VALUES ('$name', '$price', '$amount', '$time', 'pending')");
        // mysqli_query($conn, "DELETE FROM `cart` ");
    // }
    die('<script>alert("Thanh toán thành công!"); window.location.href="/htdocts/product/delivery.php";</script>');

    }
    
?>


    <section class="cart">
        <div class="container">
            <div class="cart-top-wrap">
                <div class="cart-top">
                    <div class="cart-top-cart cart-top-item">
                        <i class="fas fa-shopping-cart "></i>
                    </div>
                    <div class="cart-top-adress cart-top-item">
                        <i class="fas fa-map-marker-alt "></i>
                    </div>
                    <div class="cart-top-cart-payment cart-top-item">
                        <i class="fas fa-money-check-alt "></i>
                    </div>

                </div>
            </div>
        </div>
        <div class="container">
        <form method="post" action="">
            <div class="cart-content row">
                <div class="cart-content-left">
                    <table>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>SL</th>
                            <th>Thành tiền</th>
                            <th>Xóa</th>
                        </tr>
                        <!--Sản phẩm 1-->
                        <?php
                    $query = mysqli_query($conn,"SELECT * FROM `cart` WHERE `username` = '{$username}' ORDER BY id  ASC");
                    $total_money = 0;
                                while($row = mysqli_fetch_array($query)){
                            $totalpr = $row['price'] * $row['amount'];
                            $total_money += $totalpr;
                                ?>
                        <tr>
                            <td><img src="<?= $row['images']; ?>" alt=""></td>
                            <td><p><?= $row['name']; ?></p></td>
                            <td><input type="text" value="<?= $row['amount']; ?>" name="amount" disabled></td>
                            <td><p><?= number_format($row['price']); ?><sub>đ</sub></p></td>
                            <td><a href="?delete=<?=$row['id']; ?>">X</a></td>
                        </tr>
                        <?php }
                       ?>
                    </table>
                </div>
                <div class="cart-content-right">
                    <table>
                        <tr>
                            <th colspan="2">Tổng tiền giỏ hàng</th>
                        </tr>
                        <tr>
                            <td>TỔNG SẢN PHẨM:</td>
                            <td><?php
                            //Tính tổng só lượng của bảng
                            $result = mysqli_query($conn, "SELECT SUM(amount) AS total_amount FROM cart WHERE `username` = '{$username}'");
                            $amountotal = mysqli_fetch_assoc($result);
                            echo $amountotal['total_amount']; // Hiển thị tổng số lượng
                            ?></td>
                        </tr>
                        <tr>
                            <td>TỔNG TIỀN HÀNG:</td>
                            <td><p><?= number_format($total_money); ?><sub>đ</sub></p></td>
                        </tr>
                        <tr>
                            <td>TẠM TÍNH: </td>
                            <td><p style="color: black; font-weight: bold;"><?= number_format($total_money); ?><sub>đ</sub></p></td>
                        </tr>
                    </table>
                    <div class="cart-content-right-text">
                        <p>Bạn sẽ được miễn phí ship khi đơn hàng của bạn có tổng giá trị trên 2.000.000 đ</p>
                                    
                    </div>
                    <div class="cart-content-right-button">
                        <a href="/htdocts/index.php"><button>TIẾP TỤC MUA SẮM</button></a>
                        <button type="submit" name="pay">THANH TOÁN</button>
                    </div>
                    <div class="cart-content-right-dangnhap">
                        <p>TÀI KHOẢN IVY</p>
                        <p>Hãy <a href=" ">đăng nhập</a> tài khoản của bạn để tích điểm thành viên</p>
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