<?php
require_once '../core/config.php';
require_once '../layout/header.php';
$type = $_GET['type'];
$nuochoa = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `sub_category` WHERE `code` = '$type'"));
?>

  <!------------Cartegory--------------->
  <section class="cartegory">
        <div class="container">
            <div class="cartegory-top row">
                <p>Trang chủ</p> 
                <span>&#10230; </span> <!--&#10230 dấu suy ra nè -->
                <p><?= $nuochoa['name']; ?> </p>
            </div>
        </div>
        <div class="CONTAINER">
            <div class="row">        
                    <div class="cartegory-right-top-item">
                        <button><span>Bộ lọc</span> <i class="fas fa-sort-down"></i></button>
                    </div>
                    <div class="cartegory-right-content row">

                      
                    <?php
                    $query = mysqli_query($conn,"SELECT * FROM `product` WHERE `type` = '$type' ");
                                while($row = mysqli_fetch_array($query)){
                                ?>
                            <div class="cartegory-right-content-item text-center">
                            <img src="<?= $row['images']; ?>" alt="">
                            <h1><?= $row['name']; ?></h1>
                            <br>
                            <p><?= number_format($row['price']); ?><sup>đ</sup></p>
                            <br>
                            <a href="/htdocts/product/thong-tin.php?sanpham=<?= $row['ckcode']; ?>"><button style="cursor:pointer" type="button" class="button_product">Mua ngay</button></a>
                        </div>

                       <?php } ?>
                    </div>
                 
                   
                </div>
            </div>
        </div>
    </section>


<?php
require_once '../layout/footer.php';
?>