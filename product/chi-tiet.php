<?php
require_once '../core/config.php';
if(empty($_SESSION['username'])){
    header('Location: /');
    exit;
}else{
require_once '../layout/header.php';

$order_id = $_GET['id'];
$username = $_SESSION['username'];
// Truy xuất thông tin đơn hàng
$query = "SELECT * FROM `orders` WHERE `id` = '{$order_id}' AND `username` = '{$username}'";
$order_result = mysqli_query($conn, $query);
$order = mysqli_fetch_assoc($order_result);
// Truy xuất thông tin chi tiết đơn hàng
$items_query = "SELECT * FROM `order_items` WHERE `order_id` = $order_id";
$items_result = mysqli_query($conn, $items_query);
?>


    <section class="cart">
    <div class="container">
           <div class="cart-top-wrap">
            <h1>Chi tiết đơn hàng #<?= $order_id; ?></h1>
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
                            <th>Tên Sản Phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            
                        </tr>
                        <!--Sản phẩm 1-->
                        <?php while ($item = mysqli_fetch_assoc($items_result)) { ?>
                        <tr>
                       
                            <td><?php echo $item['name']; ?></td>
                            <td><?php echo number_format($item['price']); ?> VNĐ</td>
                            <td><?php echo number_format($item['amount']); ?></td>
                            
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