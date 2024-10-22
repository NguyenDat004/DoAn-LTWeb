<?php
require_once '../core/config.php';
require_once '../layout/header.php';
$tukhoa = $_GET['tukhoa'];
$nuochoa = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `sub_category` WHERE `code` = '$tukhoa'"));
?>

  <!------------Cartegory--------------->
  <section class="cartegory">
        <div class="container_c">
            <div class="cartegory-top row">
                <a href="../index.php"><p>Trang chủ</p></a>
                <span>&#10230; </span> <!--&#10230 dấu suy ra nè -->
                <p>Sản phẩm tìm kiếm: <span style="color: red;"><?= $nuochoa['name']; ?></span> </p>
                 <!-- <p>Tìm Kiếm</p> -->
            </div>
        </div>
        <div >
            <div class="row">        
                    <div class="cartegory-right-content row">  
                    <?php
                    
                    $query = mysqli_query($conn,"SELECT * FROM `product` WHERE `type` = '$tukhoa' ");
                                while($row = mysqli_fetch_array($query)){
                                ?>
                            <div class="cartegory-right-content-item text-center">
                                    <!-- hình ảnh sản phẩm -->
                            <img src="<?= $row['images']; ?>" alt="">
                            <!-- tên sản phẩm -->
                            <h1><?= $row['name']; ?></h1>
                            
                            <br>
                            <!-- định dạng giá -->
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