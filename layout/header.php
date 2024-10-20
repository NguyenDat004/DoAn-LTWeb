<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/1147679ae7.js" crossorigin="anonymous"></script>
        <link href="/htdocts/assets/caterory.css" rel="stylesheet">
        <link rel="icon" href="<?php echo $info['icon']; ?>" type="image/x-icon" />
        <title><?php echo $info['title']; ?></title>
    </head>
    <body>
        
        <section>
            <div class="container_header">
                <div class="row">
                    <div class="top-logo">
                       <a href="/htdocts/index.php"> <img src="" alt="" > </a>
                    </div>
                    <div class="top-menu-items">
                        <ul>
                            <li>Sản phẩm
                                <ul class="top-menu-item">
                                    <?php
                                        $query = mysqli_query($conn,"SELECT * FROM `sub_category` ORDER BY id ASC");
                                        $stt = 0;
                                        while($row = mysqli_fetch_array($query)){
                                        ?>
                                        <li>
                                        <a href="/htdocts/product/nuoc-hoa.php?type=<?= $row['code']; ?>"><?= $row['name']; ?></a>
                                        </li>          
                                    <?php
                                    }
                                    ?>
                                </ul>
                          
                            <li class="text-menu"><a href="//zalo.me/<?= $info['phone']; ?>" style="color: black;" target="_blank">Liên hệ</a></li>
                            <?php
                               if($users['rule'] == 'admin') {
                             ?>
                            <li class="text-menu"><a href="/htdocts/admin/index.php" style="color: black;">Admin Control</a></li>

                            <?php }  ?>
                        </ul>
                    </div>
                    <div class="top-menu-icons">
                        <ul>
                            <li>
                                <input placeholder="Tìm kiếm" type="text"> 
                                <i class="fas fa-search"></i>
                            </li>
                            <li>
                            <a href="/htdocts/auth/login.php"><i class="fas fa-user-secret" title="login"></i></a>
                            </li>
                            <li>
                                <a href="/htdocts/product/cart.php"><i class="fas fa-shopping-cart" title="shop cart"></i></a>
                            </li>
                            <li>
                                <a href="/htdocts/product/history.php"><i class="fas fa-inbox" title="order detail"></i></a>
                            </li>
                            <?php
                               if($username) {
                             ?>
                            <li>
                           <a href="/htdocts/auth/logout.php">Đăng xuất</a>
                            </li>
                            <?php } else { ?>
                                <li class="login">
                                <a href="/htdocts/auth/login.php">Đăng nhập</a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>