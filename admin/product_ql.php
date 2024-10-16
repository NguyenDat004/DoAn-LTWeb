<?php
require_once '../core/config.php';
if(isset($_SESSION['username'])){
  if($users['rule'] == 'admin') {
 require_once '../layout/adheader.php';

 if (isset($_POST['addpro'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $picture = $_POST['picture'];
    $type = $_POST['type'];
    $ckcode = checkcode($name);
    $query = "INSERT INTO `product` (`name`, `ckcode`, `type`, `price`, `images`) VALUES ('$name', '$ckcode', '$type', '$price', '$picture')";
    mysqli_query($conn, $query);
    echo '<script>
    alert("Thêm sản phẩm thành công");
    window.location.href = "/htdocts/admin/product_ql.php";
</script>';
}
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM `product` WHERE `id` = $id";
    mysqli_query($conn, $query);

    // Thông báo và chuyển hướng
    echo '<script>
        alert("Sản phẩm đã được xóa");
        window.location.href = "/htdocts/admin/product_ql.php";
    </script>';
    exit();
}
if (isset($_GET['xoa'])) {
    $id = $_GET['xoa'];
    $query = "DELETE FROM `sub_category` WHERE `id` = $id";
    mysqli_query($conn, $query);

    // Thông báo và chuyển hướng
    echo '<script>
        alert("Loại sản phẩm đã được xóa");
        window.location.href = "/htdocts/admin/product_ql.php";
    </script>';
    exit();
}
if (isset($_POST['addprotype'])) {
    $name = $_POST['producttype'];
    $ckcode = checkcode($name); // chuyển ký tự sang chữ khôg dấu
    $query = "INSERT INTO `sub_category` (`name`, `code`) VALUES ('$name', '$ckcode')";
    mysqli_query($conn, $query);
    echo '<script>
    alert("Thêm loại sản phẩm thành công");
    window.location.href = "/htdocts/admin/product_ql.php";
</script>';
}
?>

    <main class="main-content">
    <form action="" method="POST">
        <div class="container">
            <h2>Quản lý loại sản phẩm</h2>
            <div class="form-group">
            <span>Loại sản phẩm cần thêm</span> <p>
            <input type="text" name="producttype">
            <button type="submit" name="addprotype">Thêm</button>
  </p>
  
             </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên loại sản phẩm</th>
                        <th>Mã code</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $query = mysqli_query($conn,"SELECT * FROM `sub_category` ORDER BY id  ASC");
                                while($row = mysqli_fetch_array($query)){
                                ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= $row['name']; ?></td>
                        <td><?= $row['code']; ?></td>
                        <td>
                        <a href="?xoa=<?= $row['id']; ?>">Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                   
                </tbody>
            </table>
       
        </div>
                                </form>
    </main>
    <main class="main-content">
        <form action="" method="POST">
        <div class="container">
            <h2>Quản lý sản phẩm</h2>
            <div class="form-group">
            <p>Tên sản phẩm</p>
            <input type="text" name="name" required>
            <p>Giá sản phẩm</p>
            <input type="number" name="price" required>
            <p>Link hình ảnh</p>
            <input type="text" name="picture" required>
            <p>Chọn thể loại</p>
            <select name="type" id="type" requied>
            <?php
                    $query = mysqli_query($conn,"SELECT * FROM `sub_category` ORDER BY id  ASC");
                                while($row = mysqli_fetch_array($query)){
                                ?>
            <option value="<?= $row['code']; ?>"><?= $row['name']; ?></option>
            <?php } ?>
        </select>
        <br>
        <br>
            <button type="submit" name="addpro">Thêm</button>
            
 
  
             </div>
             <br>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Mã code</th>
                        <th>Loại</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $query = mysqli_query($conn,"SELECT * FROM `product` ORDER BY id  ASC");
                                while($row = mysqli_fetch_array($query)){
                                ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><img style="height: 90px;" src="<?= $row['images']; ?>"></td>
                        <td><?= $row['name']; ?></td>
                        <td><?= number_format($row['price']); ?> VNĐ</td>
                        <td><?= $row['ckcode']; ?></td>
                        <td><?= $row['type']; ?></td>
                        <td>
                        <a href="?delete=<?= $row['id']; ?>">Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                   
                </tbody>
            </table>
       
        </div>
                                </form>
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

