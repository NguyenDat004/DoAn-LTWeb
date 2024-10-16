<?php
require_once '../core/config.php';
if(isset($_SESSION['username'])){
  if($users['rule'] == 'admin') {
 require_once '../layout/adheader.php';
 if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $i_query = "DELETE FROM `order_items` WHERE `order_id` = $id";
    $query = "DELETE FROM `orders` WHERE `id` = $id";

    mysqli_query($conn, $i_query);
    mysqli_query($conn, $query);

    // Thông báo và chuyển hướng
    echo '<script>
        alert("Đơn hàng đã được xóa"); 
        window.location.href = "/htdocts/admin/order.php";
    </script>';// ấn ok để chuyển trang
    exit();
}
?>

    <main class="main-content">
        <div class="container">
            <h2>Welcome to the Admin Dashboard</h2>
            <h3>Quản lý đơn hàng</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tài khoản</th>
                        <th>Họ tên</th>
                        <th>Điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Thời gian</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $query = mysqli_query($conn,"SELECT * FROM `orders` ORDER BY id  ASC");
                    $stt = 1;
                                while($row = mysqli_fetch_array($query)){
                                ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= $row['username']; ?></td>
                        <td><?= $row['fullname']; ?></td>
                        <td><?= $row['phone']; ?></td>
                        <td><textarea><?= $row['address']; ?></textarea></td>
                        <td><?= $row['create_time']; ?></td>
                        <td><?php
                        if($row['status'] == "pending") { echo "Chờ xác nhận";}
                        elseif($row['status'] == "delivery") { echo "Đang vận chuyển";}
                        elseif($row['status'] == "fail") { echo "Giao hàng thất bại";}
                        elseif($row['status'] == "success") { echo "Giao hàng thành công";}
                        elseif($row['status'] == "cancelled") { echo "Đã hủy";}; ?></td>
                        <td>
                        <a href="order_details.php?id=<?php echo $row['id']; ?>">Edit</a> | <a href="?delete=<?= $row['id']; ?>">Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                   
                </tbody>
            </table>
       
        </div>
    </main>
</body>
</html>
<?php
}else{
    die(ERROR); exit;
}
}else{
    echo href('/'); exit;
}
?>

