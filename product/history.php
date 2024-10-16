<?php
require_once '../core/config.php';
if(empty($_SESSION['username'])){
    header('Location: /');
    exit;
}else{
require_once '../layout/header.php';
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
            <h1>Lịch sử đơn hàng</h1>
                <div class="cart-top">
            
                </div>
            </div>
        </div>
        <div class="container">
        <form method="post" action="">
            <div class="cart-content row">
                <div class="cart-content-left">
                    <table>
                        <tr>
                            <th>Đơn hàng</th>
                            <th>Thời gian</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                        <!--Sản phẩm 1-->
                        <?php
                    $query = mysqli_query($conn,"SELECT * FROM `orders` WHERE `username` = '{$username}' ORDER BY id  ASC");
                    $total_money = 0;
                                while($row = mysqli_fetch_array($query)){
                                ?>
                        <tr>
                            <td>Đơn hàng #<?= $row['id']; ?></td>
                            <td><?= $row['create_time']; ?></td>
                            <td><?php
                        if($row['status'] == "pending") { echo "Chờ xác nhận";}
                        elseif($row['status'] == "delivery") { echo "Đang vận chuyển";}
                        elseif($row['status'] == "fail") { echo "Giao hàng thất bại";}
                        elseif($row['status'] == "success") { echo "Giao hàng thành công";}
                        elseif($row['status'] == "cancelled") { echo "Đã hủy";}; ?></td>
                        <td> <a href="chi-tiet.php?id=<?php echo $row['id']; ?>">Chi tiết</a></td>
                            
                        </tr>
                        <?php }
                       ?>
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