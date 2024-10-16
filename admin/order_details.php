<?php
require_once '../core/config.php';
if(isset($_SESSION['username'])){
  if($users['rule'] == 'admin') {
require_once '../layout/adheader.php';
// Lấy ID đơn hàng từ query string
$order_id = $_GET['id'];

// Truy xuất thông tin đơn hàng
$query = "SELECT * FROM `orders` WHERE `id` = $order_id";
$order_result = mysqli_query($conn, $query);
$order = mysqli_fetch_assoc($order_result);
// Xử lý cập nhật trạng thái
if (isset($_POST['update_status'])) {
    $new_status = mysqli_real_escape_string($conn, $_POST['status']);
    $update_query = "UPDATE `orders` SET `status` = '$new_status' WHERE `id` = $order_id";
    mysqli_query($conn, $update_query);
    echo '<script>
    alert("Cập nhật trạng thái đơn hàng thành công");
    window.location.href = "/htdocts/admin/order_details.php?id=' .$order_id. '";
</script>';
}
if (!$order) {
    die('<script>alert("Đơn hàng không tồn tại"); window.location.href="/htdocts/admin/order.php";</script>');
}

// Truy xuất thông tin chi tiết đơn hàng

?>
<main class="main-content">
<div class="container">
    
  <h1>Chi Tiết Đơn Hàng</h1>
    <h2>Thông Tin Đơn Hàng</h2>
    <p><strong>ID Đơn Hàng:</strong> <?php echo $order['id']; ?></p>
    <p><strong>Người Dùng:</strong> <?php echo $order['username']; ?></p>
    <p><strong>Họ Tên:</strong> <?php echo $order['fullname']; ?></p>
    <p><strong>Điện Thoại:</strong> <?php echo $order['phone']; ?></p>
    <p><strong>Địa Chỉ:</strong> <?php echo $order['address']; ?></p>
    <p><strong>Thời Gian Tạo:</strong> <?php echo $order['create_time']; ?></p>
    <p><strong>Trạng Thái:</strong> <?php
                        if($order['status'] == "pending") { echo "Chờ xác nhận";}
                        elseif($order['status'] == "delivery") { echo "Đang vận chuyển";}
                        elseif($order['status'] == "fail") { echo "Giao hàng thất bại";}
                        elseif($order['status'] == "success") { echo "Giao hàng thành công";}
                        elseif($order['status'] == "cancelled") { echo "Đã hủy";}; ?></p>

    <h2>Chi Tiết Sản Phẩm</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Tên Sản Phẩm</th>
                <th>Giá</th>
                <th>Số Lượng</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $items_query = "SELECT * FROM `order_items` WHERE `order_id` = $order_id";
            $items_result = mysqli_query($conn, $items_query); while ($item = mysqli_fetch_assoc($items_result)) { ?>
                <tr>
                    <td><?php echo $item['name']; ?></td>
                    <td><?php echo number_format($item['price']); ?> VNĐ</td>
                    <td><?php echo $item['amount']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <div class="form-group">
    <h2>Cập Nhật Trạng Thái Đơn Hàng</h2>
    <h3>Thông Tin Đơn Hàng</h3>
    <form action="/htdocts/admin/order_details.php?id=<?php echo $order['id']; ?>" method="post">
        <p><strong>ID Đơn Hàng:</strong> <?php echo $order['id']; ?></p>
        <p><strong>Trạng Thái Hiện Tại:</strong> <?php
                        if($order['status'] == "pending") { echo "Chờ xác nhận";}
                        elseif($order['status'] == "delivery") { echo "Đang vận chuyển";}
                        elseif($order['status'] == "fail") { echo "Giao hàng thất bại";}
                        elseif($order['status'] == "success") { echo "Giao hàng thành công";}
                        elseif($order['status'] == "cancelled") { echo "Đã hủy";}; ?></p>
        <label for="status">Chọn Trạng Thái Mới:</label>
        <select name="status" id="status">
            <option value="pending">Chờ xác nhận</option>
            <option value="delivery">Đang vận chuyển</option>
            <option value="success">Giao hàng thành công</option>
            <option value="fail">Giao hàng thất bại</option>
            <option value="cancelled">Đã Hủy</option>
        </select>
        <button type="submit" name="update_status">Cập Nhật</button>
    </form>
            </div>
    </div>
    </main>
</body>
</html>

<?php
}else{
    die("Lỗi"); exit;
}
}else{
    echo href('/'); exit;
}
?>