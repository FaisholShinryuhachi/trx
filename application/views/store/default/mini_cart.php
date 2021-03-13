<?php if($products) { ?>
<ul style="max-height:250px; overflow-y:auto; overflow-x:hidden;">
<?php foreach ($products as $key => $product) { ?>

<li class="ph-2 w-100">
    <div class="row mx-0">
        <div class="col-3 p-0">
            <a class="thumbnail pull-left" href="<?= $product['link'] ?>"> 
                <img class="media-object" src="<?= $product['product_featured_image'] ?>" width='100%'> 
            </a>
        </div>        
        <div class="col-8 p-0 pl-2 text-left">
            <?php
                if(isset($product['variation']) && !empty($product['variation'])) {
                    $variation = json_decode($product['variation']);
                    $combinationString = "";
                    foreach ($variation as $key => $value) {
                        if($key == 'colors') {
                            $combinationString .= ($combinationString == "") ? explode("-",$value)[1] : ",".explode("-",$value)[1];
                        } else {
                            $combinationString .= ($combinationString == "") ? $value : ", ".$value;
                        }
                    }
                }
            ?>
            <small class="item-name"><?= $product['product_name'] ?> <?= ($combinationString != "") ? "(".$combinationString.")" : "" ?> </small><br>
            <small>Quantity : <?= $product['quantity'] ?></small><br>
            <small>Price : <?= c_format($product['product_price'] + $product['variation_price']) ?></small>
        </div>        
        <div class="col-1 text-center p-0">
            <button type="button" class="btn btn-xs btn-remove-cart text-danger" data-href="<?= $base_url."cart/?checkout_page=true&remove=".$product['cart_id'] ?>"><i class="far fa-times-circle"></i></button>
        </div>        
    </div>
    <hr class="my-1">
</li>

<?php } ?>
</ul>
<ul>
    <li class="text-left"><b>Subtotal:</b> <span class="float-right"><?= c_format($sub_total) ?></span></li>
    <li class="text-left"><b>Total:</b> <span class="float-right"><?= c_format($total) ?></span></li>
    <li><a class="btn bg-main2 text-white btn-block mt-2" href="<?php echo base_url('store/cart') ?>">View Cart</a></li>
</ul>
<?php } else { ?>
    <div class="cart-empty">
        <img src="<?= base_url('assets/store/default/'); ?>img/cart-icon-empty.png" alt="Icon">
        <p>Cart Is Blank</p>
    </div>
<?php } ?>