<?php include 'inc/header.php';?>

<?php 

    $ct = new Cart();


    //cart product delete

    if (isset($_GET['delpro'])) {

        $delId = preg_replace('/(?<!^)([A-Z][a-z]|(?<=[a-z])[^a-z]|(?<=[A-Z])[0-9_])/', '', $_GET['delpro']);

        $delProduct = $ct->delProductBycart($delId);
    }

    //cart page quantity update
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $cartId = $_POST['cartId'];
        $quantity = $_POST['quantity'];
        $updateCart = $ct->updateCartQuantity($cartId, $quantity);
        
        if ($quantity<=0) {
             $delProduct = $ct->delProductBycart($cartId);
        }
    }


    //Loading Cart Properly id nij iscchai

    if (!isset($_GET['id'])) {
        echo "<meta http-equiv='refresh' content='0; url=?id=live'/>";
    }


 ?>

        <!--====== App Content ======-->
        <div class="app-content">

            <!--====== Section 1 ======-->
            <div class="u-s-p-y-60">

                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">
                        <div class="breadcrumb">
                            <div class="breadcrumb__wrap">
                                <ul class="breadcrumb__list">
                                    <li class="has-separator">

                                        <a href="index.php">Home</a></li>
                                    <li class="is-marked">

                                        <a href="cart.php">Cart</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section 1 ======-->


            <!--====== Section 2 ======-->
            <div class="u-s-p-b-60">

                <!--====== Section Intro ======-->
                <div class="section__intro u-s-m-b-60">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section__text-wrap">
                                    <h1 class="section__heading u-c-secondary">SHOPPING CART</h1>
                                    <?php 
                                        if (isset($updateCart)) {
                                            echo $updateCart;
                                        }
                                        if (isset($delProduct)) {
                                            echo $delProduct;
                                        }
                                     ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--====== End - Section Intro ======-->


                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 u-s-m-b-30">
                                <div class="table-responsive">
                                    <table class="table-p">
                                        <tbody>
                                            <th>#No</th>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total Price</th>
                                            <th>Action</th>

                                            <!--====== Row ======-->
                                            <?php 
                                                $getpro = $ct->getCartProduct();
                                                if ($getpro) {
                                                    $sum =0;
                                                    $i = 0;
                                                    $qty = 0;
                                                    while ($result = $getpro->fetch_assoc()) {
                                                        $i++;
                                                        
                                                   

                                             ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td>
                                                    <div class="table-p__box">
                                                        <div class="table-p__img-wrap">

                                                            <img class="u-img-fluid" src="admin/<?php echo $result ['image']; ?>" alt=""></div>
                                                        <div class="table-p__info">

                                                            <span class="table-p__name">

                                                                <a href="product-detail.php"><?php echo $result['productName']; ?></a></span>

                                                            <span class="table-p__category">

                                                                <a href="products.php">Women Clothing</a></span>
                                                            <ul class="table-p__variant-list">
                                                                <li>

                                                                    <span>Size: 22</span></li>
                                                                <li>

                                                                    <span>Color: Red</span></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="table-p__price">$<?php echo $result['price']; ?></span>
                                                </td>
                                                <td>
                                                    <div class="">

                                                        <!--====== Input Counter ======-->
                                                        <form action="" method="post">
                                                            

                                                                

                                                                <input class="" type="hidden" name="cartId" value="<?php echo $result['cartId']; ?>">
                                                                
                                                                <input class="" type="number"  name="quantity" value="<?php echo $result['quantity']; ?>" >
                                                                <input class="btn btn-primary" name="submit" type="submit" value="Update">


                                                                
                                                            
                                                        </form>
                                                        <!--====== End - Input Counter ======-->
                                                    </div>
                                                </td>
                                                <td>

                                                    <span class="table-p__price">$
                                                        <?php 
                                                            $total = $result['price'] * $result['quantity']; 
                                                            echo $total;
                                                        ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="table-p__del-wrap">
                                                        <a class="far fa-trash-alt table-p__delete-link" onclick="return confirm('Are You Sure to delete.?');" href="?delpro=<?php echo $result['cartId']; ?>"></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php 
                                                $sum = $sum + $total; 
                                                $qty = $qty + $result['quantity'];
                                                Session::set("qty", $qty);
                                            ?>
                                        <?php  } } ?>
                                            <!--====== End - Row ======-->

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="route-box">
                                    <div class="route-box__g1">

                                        <a class="route-box__link" href="products.php"><i class="fas fa-long-arrow-alt-left"></i>

                                            <span>CONTINUE SHOPPING</span></a></div>
                                    <div class="route-box__g2">

                                        <a class="route-box__link" href="cart.php"><i class="fas fa-trash"></i>

                                            <span>CLEAR CART</span>
                                        </a>

                                        <a class="route-box__link" href="cart.php"><i class="fas fa-sync"></i>

                                            <span>UPDATE CART</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--====== End - Section Content ======-->
            </div>
            <!--====== End - Section 2 ======-->


            <!--====== Section 3 ======-->
            <div class="u-s-p-b-60">

                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 u-s-m-b-30">
                                <form class="f-cart">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6 u-s-m-b-30">
                                            <div class="f-cart__pad-box">
                                                <h1 class="gl-h1">ESTIMATE SHIPPING AND TAXES</h1>

                                                <span class="gl-text u-s-m-b-30">Enter your destination to get a shipping estimate.</span>
                                                <div class="u-s-m-b-30">

                                                    <!--====== Select Box ======-->

                                                    <label class="gl-label" for="shipping-country">COUNTRY *</label><select class="select-box select-box--primary-style" id="shipping-country">
                                                        <option selected value="">Choose Country</option>
                                                        <option value="uae">United Arab Emirate (UAE)</option>
                                                        <option value="uk">United Kingdom (UK)</option>
                                                        <option value="us">United States (US)</option>
                                                    </select>
                                                    <!--====== End - Select Box ======-->
                                                </div>
                                                <div class="u-s-m-b-30">

                                                    <!--====== Select Box ======-->

                                                    <label class="gl-label" for="shipping-state">STATE/PROVINCE *</label><select class="select-box select-box--primary-style" id="shipping-state">
                                                        <option selected value="">Choose State/Province</option>
                                                        <option value="al">Alabama</option>
                                                        <option value="al">Alaska</option>
                                                        <option value="ny">New York</option>
                                                    </select>
                                                    <!--====== End - Select Box ======-->
                                                </div>
                                                <div class="u-s-m-b-30">

                                                    <label class="gl-label" for="shipping-zip">ZIP/POSTAL CODE *</label>

                                                    <input class="input-text input-text--primary-style" type="text" id="shipping-zip" placeholder="Zip/Postal Code"></div>
                                                <div class="u-s-m-b-30">

                                                    <a class="f-cart__ship-link btn--e-transparent-brand-b-2" href="cart.php">CALCULATE SHIPPING</a></div>

                                                <span class="gl-text">Note: There are some countries where free shipping is available otherwise our flat rate charges or country delivery charges will be apply.</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 u-s-m-b-30">
                                            <div class="f-cart__pad-box">
                                                <h1 class="gl-h1">NOTE</h1>

                                                <span class="gl-text u-s-m-b-30">Add Special Note About Your Product</span>
                                                <div>

                                                    <label for="f-cart-note"></label><textarea class="text-area text-area--primary-style" id="f-cart-note"></textarea></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 u-s-m-b-30">
                                            <div class="f-cart__pad-box">
                                                <div class="u-s-m-b-30">
                                                    <?php 
                                                        $getData = $ct ->checkCartTable();
                                               
                                                        if ($getData) {
                                                     ?>
                                                    <table class="f-cart__table">
                                                        <tbody>
                                                            <!-- <tr>
                                                                <td>SHIPPING</td>
                                                                <td>$4.00</td>
                                                            </tr> -->
                                                            <tr>
                                                                <td>TAX</td>
                                                                <td>5.00%</td>
                                                            </tr>
                                                            <tr>
                                                                <td>SUBTOTAL</td>
                                                                <td>$<?php echo $sum; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>GRAND TOTAL</td>
                                                                <td>
                                                                    $<?php 
                                                                        $vat = $sum * 0.05;
                                                                        $gndTotal = $vat + $sum;
                                                                        echo $gndTotal;
                                                                     ?>     
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                <?php } else{
                                                    echo "Cart Empty";
                                                } ?>
                                                </div>
                                                <div>

                                                    <button class="btn btn--e-brand-b-2" type="submit"> PROCEED TO CHECKOUT</button></div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--====== End - Section Content ======-->
            </div>
            <!--====== End - Section 3 ======-->
        </div>
        <!--====== End - App Content ======-->


        <!--====== Main Footer ======-->
        <?php include 'inc/footer.php' ?>
        <!--====== End Main Footer ======-->
    </div>
    <!--====== End - Main App ======-->


    <!--====== Google Analytics: change UA-XXXXX-Y to be your site's ID ======-->
    <script>
        window.ga = function() {
            ga.q.push(arguments)
        };
        ga.q = [];
        ga.l = +new Date;
        ga('create', 'UA-XXXXX-Y', 'auto');
        ga('send', 'pageview')
    </script>
    <script src="https://www.google-analytics.com/analytics.js" async defer></script>

    <!--====== Vendor Js ======-->
    <script src="js/vendor.js"></script>

    <!--====== jQuery Shopnav plugin ======-->
    <script src="js/jquery.shopnav.js"></script>

    <!--====== App ======-->
    <script src="js/app.js"></script>

    <!--====== Noscript ======-->
    <noscript>
        <div class="app-setting">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="app-setting__wrap">
                            <h1 class="app-setting__h1">JavaScript is disabled in your browser.</h1>

                            <span class="app-setting__text">Please enable JavaScript in your browser or upgrade to a JavaScript-capable browser.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </noscript>
</body>
</html>