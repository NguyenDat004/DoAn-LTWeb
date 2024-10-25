
<?php
require_once './core/config.php';
require_once './layout/header.php';
?>

<!--Slide--->
<section id="Slide">
    <div class="aspect-ratio-169">
        <img src="img/slide1.jpg">
        <img src="img/slide2.jpg">  
        <img src="img/slide2.jpg">  
        <img src="img/slide2.jpg">  
        <img src="img/slide2.jpg">  
    </div>
    <div class="dot-container">
        <div class="dot active"></div>
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
    </div>
    <div class="product-views">
        <h1 class="title-products">CÁC SẢN PHẨM NƯỚC HOA</h1>
        <div class="cartegory-right-content row">  
            <?php
            $query = mysqli_query($conn,"SELECT * FROM `product`");
                while($row = mysqli_fetch_array($query)){?>
                <div class="cartegory-right-content-item text-center">
                    <img loading="lazy" src="<?= $row['images']; ?>" alt="product-image">
                    <h1><?= $row['name']; ?></h1>
                    <br>
                    <p><?= number_format($row['price']); ?><sup>đ</sup></p>
                    <br>
                    <a href="/htdocts/product/thong-tin.php?sanpham=<?= $row['ckcode']; ?>"><button style="cursor:pointer" type="button" class="button_product">Mua ngay</button></a>
                </div>
            <?php } ?>
        </div> 
    </div> 
</section>


<?php
require_once './layout/footer.php';
?>