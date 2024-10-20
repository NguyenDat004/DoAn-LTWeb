<?php
require_once '../core/config.php'; //liên kết sql
if(isset($_SESSION['username'])){ // check đăng nhập hay chưa
  if($users['rule'] == 'admin') { 
 require_once '../layout/adheader.php';
?>

    <main class="main-content">
        <div class="container">
            <h2>Welcome to the Admin Dashboard</h2>
          
             <br>
             <br>  
            <h2>Danh sách thành viên</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tài khoản </th>
                        <th>Mật khẩu</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $stt = 1;
                    $query = mysqli_query($conn,"SELECT * FROM `account` ORDER BY id  ASC");
                                while($row = mysqli_fetch_array($query)){
                                ?>
                    <tr>
                        <td><?= $stt++; ?></td>
                        <td><?= $row['username']; ?></td>
                        <td><?= $row['password']; ?></td>
                        <td><?php
                        if($row['rule'] == "admin") { echo "Quản trị viên";}
                        elseif($row['rule'] == "user") { echo "Thành viên";}
                        elseif($row['rule'] == "moderate") { echo "Kiểm duyệt viên";} ?></td>
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
    die("Lỗi"); exit;
}
}else{
    echo href('/'); exit;
}
?>

