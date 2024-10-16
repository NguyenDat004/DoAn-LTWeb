<?php
require_once '../core/config.php';
if(empty($_SESSION['username'])){
    header('Location: /');
    exit;
}else{
require_once '../layout/header.php';

if (isset($_POST['pay'])) {
    // Lấy thông tin đơn hàng từ form
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Lấy thông tin giỏ hàng
    $query = mysqli_query($conn, "SELECT * FROM `cart` ORDER BY id ASC");
    
    // Khởi tạo biến lưu thông tin sản phẩm cho đơn hàng
    $order_items = [];
    
    while ($row = mysqli_fetch_array($query)) {
        $name = mysqli_real_escape_string($conn, $row['name']);
        $price = $row['price'];
        $amount = $row['amount'];
        $type = mysqli_real_escape_string($conn, $row['type']);
        
        // Thêm thông tin sản phẩm vào mảng
        $order_items[] = [
            'name' => $name,
            'price' => $price,
            'amount' => $amount
        ];
    }
    
    // Lưu thông tin đơn hàng vào bảng orders
    $username = mysqli_real_escape_string($conn, $username);
    $query = "INSERT INTO `orders` (`username`, `fullname`, `phone`, `address`, `create_time`, `status`) VALUES ('$username', '$fullname', '$phone', '$address', '$time', 'pending')";
    mysqli_query($conn, $query);
    
    // Lấy ID của đơn hàng mới được tạo
    $order_id = mysqli_insert_id($conn);
    
    // Lưu thông tin chi tiết đơn hàng vào bảng order_items
    foreach ($order_items as $item) {
        $name = mysqli_real_escape_string($conn, $item['name']);
        $price = $item['price'];
        $amount = $item['amount'];
        $query = "INSERT INTO `order_items` (`order_id`, `name`, `price`, `amount`) VALUES ('$order_id', '$name', '$price', '$amount')";
        mysqli_query($conn, $query);
    }
    
    // Xóa sản phẩm khỏi giỏ hàng
    mysqli_query($conn, "DELETE FROM `cart` WHERE `username` = '{$username}'");
    
    // Thông báo và chuyển hướng
    die('<script>alert("Thanh toán thành công!"); window.location.href="";</script>');
}
?>


    <section class="delivery">
        <div class="container">
            <div class="delivery-top-wrap">
                <div class="delivery-top">
                    <div class="delivery-top-delivery delivery-top-item">
                        <i class="fas fa-shopping-cart "></i>
                    </div>
                    <div class="delivery-top-adress delivery-top-item">
                        <i class="fas fa-map-marker-alt "></i>
                    </div>
                    <div class="delivery-top-payment delivery-top-item">
                        <i class="fas fa-money-check-alt "></i>
                    </div>

                </div>
            </div>
        </div>
        <div class="container">
        <form method="post" action="">
            <div class="delivery-content row">
                <div class="delivery-content-left">
                    <p>Vui lòng chọn địa chỉ giao hàng</p>
                    <br>
                    <div class="delivery-content-left-input-top  ">
                        <div class="delivery-content-left-input-top-item">
                            <label for="">Họ tên <span style="color: red;">*</span></label>
                            <input type="text" name="fullname" required>
                        </div>

                        <div class="delivery-content-left-input-top-item">
                            <label for="">Điện thoại <span style="color: red;">*</span></label>
                            <input type="text" name="phone" required>
                        </div>
                    </div>

                    <div class="delivery-content-left-input-bottom">
                        <label for="">Địa chỉ <span style="color: red;">*</span></label>
                        <input type="text" name="address" required>
                    </div>

                    <div class="delivery-content-left-button row">
                        <a href=""> <span>&#171;</span> <p>Quay lại giỏ hàng</p> </a>
                        <button type="submit" name="pay"> <p style="font-weight: bold;">THANH TOÁN VÀ GIAO HÀNG</p> </button>
                    </div>
                </div>
                <div class="delivery-content-right">
                    <table>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                        <?php
                    $query = mysqli_query($conn,"SELECT * FROM `cart` WHERE `username` = '{$username}' ORDER BY id  ASC");
                    $total_money = 0;
                                while($row = mysqli_fetch_array($query)){
                            $totalpr = $row['price'] * $row['amount'];
                            $total_money += $totalpr;
                                ?>
                        <tr>
                            <td><?= $row['name']; ?></td>
                            <td><?= $row['amount']; ?></td>
                            <td> <p><?= number_format($totalpr); ?> <sub>đ</sub></p> </td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td style="font-weight: bold;" colspan="3">Tổng tiền hàng</td>
                            <td style="font-weight: bold;"> <p><?= number_format($total_money); ?> <sub>đ</sub></p> </td>
                        </tr>
                    </table>
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