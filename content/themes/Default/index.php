<?php
  // Program to display complete URL
  $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']
              === 'on' ? "https" : "http") . "://" . 
              $_SERVER['HTTP_HOST'];
?>
<div role="main">
   <div class="page-dashboard-home">
     <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
       <div class="carousel-inner">
            <?php
            require 'includes/site/db.php';
            $queryslider = "SELECT * FROM sliders WHERE visible = 1  LIMIT 3";
            //   exit($querysearch);
            $query_runslider = mysqli_query($db, $queryslider);
            $checkIfExists = mysqli_num_rows($query_runslider) > 0;
            $counter = 0;
            if ($checkIfExists){
                while($row = mysqli_fetch_array($query_runslider)){
                    $counter++;
         ?>
         <div class="carousel-item <?= $counter==1 ? 'active' : '' ?>">
           <img src="<?php echo $row['image']; ?>" width="100%" height="356" alt="<?= $row['title'] ?>" title="<?= $row['title'] ?>">
         </div>
         <?php } }?>
       </div>
       <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
         <span class="carousel-control-prev-icon" aria-hidden="true"></span>
         <span class="sr-only">Prev</span>
       </a>
       <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
         <span class="carousel-control-next-icon" aria-hidden="true"></span>
         <span class="sr-only">Next</span>
       </a>
     </div>
     <?php 
        if(isset($_GET['search'])){
        $search = $_GET['search'];
     ?>
     <div class="container">
         <div class="page-dashboard-home__section">
            <div class="page-header">
               <h1 class="page-header__headline page-dashboard-home__main-title">
               Search Result of <?= $search ?>
               </h1>
            </div>
         </div>
         <div class="offers-list-tertiary">
            <div class="row">
               <?php
               require 'includes/site/db.php';
               $querysearch = "SELECT * FROM coupons WHERE title LIKE '%$search%' or description LIKE '%$search%' ORDER BY store, order_id ASC";
            //   exit($querysearch);
               $query_runsearch = mysqli_query($db, $querysearch);
               $checkIfExistssearch = mysqli_num_rows($query_runsearch) > 0;
               if ($checkIfExistssearch)
               {
               while($row = mysqli_fetch_array($query_runsearch))
               {
               ?>
               <div class="col-12 col-sm-6 col-lg-3">
                  <a href="<?= $link ?>?couponId=<?php echo $row['id']; ?>" class="show-modal  offers-list-item-tertiary offers-list-tertiary__item" title="Besuche design-bestseller">
                     <div class="offers-list-item-tertiary__wrapper">
                        <div class="offers-list-item-tertiary__content-wrapper">
                           <div class="offers-list-item-tertiary__logo">
                              <img class="img-fluid offers-list-item-tertiary__logo-img lazyloaded" alt="Fun Sport Vision"
                              data-src="<?php echo $row['image']; ?>"
                              src="<?php echo $row['image']; ?>"
                              >
                              <noscript><img src="<?php echo $row['image']; ?>" class="img-fluid offers-list-item-tertiary__logo-img" alt="Fun Sport Vision"/></noscript>
                           </div>
                           <div class="offers-list-item-tertiary__details">
                              <div class="offers-list-item-tertiary__type">
                                 <?php echo $row['title']; ?>
                              </div>
                              <div class="offers-list-item-tertiary__title">
                                 <?php echo $row['description']; ?>
                              </div>
                           </div>
                        </div>
                        <div class="offers-list-item-tertiary__hits">
                           Redeemed 224 times
                        </div>
                        <div class="offers-list-item-tertiary__badges-wrapper">
                           <div class="badge badge_type_exclusive offers-list-item-tertiary__badge">Exclusive</div>
                        </div>
                     </div>
                  </a>
               </div>
               <?php
               
               }
               }
               else
               {
               echo "No Record Found";
               }
               ?>
            </div>
         </div>
      </div>
      <?php } ?>
     <div class="container">
         <div class="page-dashboard-home__section">
            <div class="page-dashboard-home__shops-logo-carousel">
               <div class="page-header">
                  <h2 class="page-header__headline">
                 Popular Stores
                  </h2>
               </div>
               <div class="shops-logo-carousel js-shops-logo-carousel">
                  <div class="shops-logo-carousel__list js-shops-logo-carousel__list">
                     <?php
                     require 'includes/site/db.php';
                     $query = "SELECT * FROM stores LIMIT 7";
                     $query_run = mysqli_query($db, $query);
                     $checkIfExists = mysqli_num_rows($query_run) > 0;
                     if ($checkIfExists)
                     {
                     while($row = mysqli_fetch_array($query_run))
                     {
                     ?>
                     <div class="shops-logo-carousel__item js-shops-logo-carousel__item" data-horizontal-scroll-slide-id="item_1">
                        <div class="shops-list-item-primary ">
                           <a href="store/<?php echo $row['name']; ?>" class="show-modal  shops-list-item-primary__link " title="<?php echo $row['name']; ?>">
                              <div class="shops-list-item-primary__logo-wrapper">
                                 <div class="shops-list-item-primary__logo">
                                    <img width="100" height="100" class="img-fluid image-grayscale lazyload" alt="<?php echo $row['name']; ?>" data-src="<?php echo $row['image']; ?>" src="<?php echo $row['image']; ?>">
                                    <noscript><img src="<?php echo $row['image']; ?>" class="img-fluid image-grayscale" alt="<?php echo $row['name']; ?>"/></noscript>
                                 </div>
                              </div>
                              <div class="shops-list-item-primary__text">
                                 <?php echo $row['name']; ?>
                              </div>
                           </a>
                        </div>
                     </div>
                     <?php
                     
                     }
                     }
                     else
                     {
                     echo "No Record Found";
                     }
                     ?>
                  </div>
               </div>
            </div>
            <div class="show-all-link">
               <a href="javascript:;" class="show-all-link__link">Show all</a>
            </div>
         </div>
     </div>
    <div class="container">
         <div class="page-dashboard-home__section">
            <div class="page-header">
               <h1 class="page-header__headline page-dashboard-home__main-title">
               Best Voucher Codes & Deals
               </h1>
            </div>
         </div>
         <div class="offers-list-tertiary">
            <div class="row">
               <?php
               require 'includes/site/db.php';
               $query = "SELECT * FROM coupons ORDER BY store, order_id ASC LIMIT 8 ";
               $query_run = mysqli_query($db, $query);
               $checkIfExists = mysqli_num_rows($query_run) > 0;
               if ($checkIfExists)
               {
               while($row = mysqli_fetch_array($query_run))
               {
               ?>
               <div class="col-12 col-sm-6 col-lg-3">
                  <a href="<?= $link ?>?couponId=<?php echo $row['id']; ?>" class="show-modal  offers-list-item-tertiary offers-list-tertiary__item" title="Besuche design-bestseller">
                     <div class="offers-list-item-tertiary__wrapper">
                        <div class="offers-list-item-tertiary__content-wrapper">
                           <div class="offers-list-item-tertiary__logo">
                              <img class="img-fluid offers-list-item-tertiary__logo-img lazyloaded" alt="Fun Sport Vision"
                              data-src="<?php echo $row['image']; ?>"
                              src="<?php echo $row['image']; ?>"
                              >
                              <noscript><img src="<?php echo $row['image']; ?>" class="img-fluid offers-list-item-tertiary__logo-img" alt="Fun Sport Vision"/></noscript>
                           </div>
                           <div class="offers-list-item-tertiary__details">
                              <div class="offers-list-item-tertiary__type">
                                 <?php echo $row['title']; ?>
                              </div>
                              <div class="offers-list-item-tertiary__title">
                                 <?php echo $row['description']; ?>
                              </div>
                           </div>
                        </div>
                        <div class="offers-list-item-tertiary__hits">
                           Redeemed <?= rand($row['id'],$row['id']) ?> times
                        </div>
                     </div>
                  </a>
               </div>
               <?php
               
               }
               }
               else
               {
               echo "No Record Found";
               }
               ?>
            </div>
         </div>
      </div>
      <div class="container">
         <div class="page-header">
            <h2 class="page-header__headline">
            Exclusive Discount Codes
            </h2>
         </div>
         <div class="offers-list-tertiary">
            <div class="row">
               <?php
               require 'includes/site/db.php';
               $query = "SELECT * FROM coupons ORDER BY store, order_id ASC LIMIT 8";
               $query_run = mysqli_query($db, $query);
               $checkIfExists = mysqli_num_rows($query_run) > 0;
               if ($checkIfExists)
               {
               while($row = mysqli_fetch_array($query_run))
               {
               ?>
               <div class="col-12 col-sm-6 col-lg-3">
                  <a href="<?= $link ?>?couponId=<?php echo $row['id']; ?>" class="show-modal  offers-list-item-tertiary offers-list-tertiary__item" title="Besuche design-bestseller">
                     <div class="offers-list-item-tertiary__wrapper">
                        <div class="offers-list-item-tertiary__content-wrapper">
                           <div class="offers-list-item-tertiary__logo">
                              <img class="img-fluid offers-list-item-tertiary__logo-img lazyloaded" alt="Fun Sport Vision"
                              data-src="<?php echo $row['image']; ?>"
                              src="<?php echo $row['image']; ?>">
                              <noscript><img src="<?php echo $row['image']; ?>" class="img-fluid offers-list-item-tertiary__logo-img" alt="Fun Sport Vision"/></noscript>
                           </div>
                           <div class="offers-list-item-tertiary__details">
                              <div class="offers-list-item-tertiary__type">
                                 <?php echo $row['title']; ?>
                              </div>
                              <div class="offers-list-item-tertiary__title">
                                 <?php echo $row['description']; ?>
                              </div>
                           </div>
                        </div>
                        <div class="offers-list-item-tertiary__badges-wrapper">
                           <div class="badge badge_type_exclusive offers-list-item-tertiary__badge">Exclusive</div>
                        </div>
                     </div>
                  </a>
               </div>
               <?php
               }
               }
               else
               {
               echo "No Record Found";
               }
               ?>
            </div>
         </div>
         <div class="show-all-link">
            <a href="/shops" class="show-all-link__link">Show all</a>
         </div>
         <div class="offers-columns page-dashboard-home__offers-columns">
            <div class="row">
               <div class="col-12 col-xl-4">
                  <h2 class="offers-columns__title">
                  Free Items
                  </h2>
                  <div class="offers-list-quinary">
                     <div class="row">
                        <?php
                        require 'includes/site/db.php';
                        $query = "SELECT * FROM products LIMIT 6";
                        $query_run = mysqli_query($db, $query);
                        $checkIfExists = mysqli_num_rows($query_run) > 0;
                        if ($checkIfExists)
                        {
                        while($row = mysqli_fetch_array($query_run))
                        {
                        ?>
                        <div class="col-12 col-md-6 col-xl-12">
                           <a href="<?= $link ?>?couponId=<?php echo $row['id']; ?>" class="show-modal  offers-list-item-quinary offers-list-quinary__item" title="<?php echo $row['title']; ?>">
                              <div class="offers-list-item-quinary__body">
                                 <div class="offers-list-item-quinary__logo-wrapper">
                                    <img class="img-fluid lazyload" alt="Adler" data-src="<?php echo $row['image']; ?>">
                                    <noscript><img src="<?php echo $row['image']; ?>" class="img-fluid" alt="Adler"/></noscript>
                                 </div>
                                 <div class="offers-list-item-quinary__content">
                                    <div class="offers-list-item-quinary__title">
                                       <?php echo $row['description']; ?>
                                    </div>
                                    <div class="offers-list-item-quinary__meta">
                                       <?php echo $row['title']; ?>
                                    </div>
                                 </div>
                                 <div class="offers-list-item-quinary__badges-wrapper">
                                 </div>
                              </div>
                           </a>
                        </div>
                        <?php
                        
                        }
                        }
                        else
                        {
                        echo "No Record Found";
                        }
                        ?>
                     </div>
                  </div>
                  <div class="show-all-link offers-columns__show-all">
                     <a href="/shops" class="show-all-link__link">Show all</a>
                  </div>
               </div>
               <div class="col-12 col-xl-4">
                  <h2 class="offers-columns__title">
                  Latest Vouchers
                  </h2>
                  <div class="offers-list-quinary">
                     <div class="row">
                        <?php
                        require 'includes/site/db.php';
                        $query = "SELECT * FROM coupons ORDER BY id DESC LIMIT 6";
                        $query_run = mysqli_query($db, $query);
                        $checkIfExists = mysqli_num_rows($query_run) > 0;
                        if ($checkIfExists)
                        {
                        while($row = mysqli_fetch_array($query_run))
                        {
                        ?>
                        <div class="col-12 col-md-6 col-xl-12">
                           <a href="<?= $link ?>?couponId=<?php echo $row['id']; ?>" class="show-modal  offers-list-item-quinary offers-list-quinary__item" title="Besuche Adler">
                              <div class="offers-list-item-quinary__body">
                                 <div class="offers-list-item-quinary__logo-wrapper">
                                    <img class="img-fluid lazyload" alt="Adler" data-src="<?php echo $row['image']; ?>">
                                    <noscript><img src="<?php echo $row['image']; ?>" class="img-fluid" alt="Adler"/></noscript>
                                 </div>
                                 <div class="offers-list-item-quinary__content">
                                    <div class="offers-list-item-quinary__title">
                                       <?php echo $row['description']; ?>
                                    </div>
                                    <div class="offers-list-item-quinary__meta">
                                       <?php echo $row['title']; ?>
                                    </div>
                                 </div>
                                 <div class="offers-list-item-quinary__badges-wrapper">
                                 </div>
                              </div>
                           </a>
                        </div>
                        <?php
                        
                        }
                        }
                        else
                        {
                        echo "No Record Found";
                        }
                        ?>
                     </div>
                  </div>
                  <div class="show-all-link offers-columns__show-all">
                     <a href="/shops" class="show-all-link__link">Show all</a>
                  </div>
               </div>
               <div class="col-12 col-xl-4">
                  <h2 class="offers-columns__title">
                  Expiring Offers
                  </h2>
                  <div class="offers-list-quinary">
                     <div class="row">
                        <?php
                           require 'includes/site/db.php';
                           $query = "SELECT * FROM coupons WHERE expiration>=DATE_SUB(expiration,INTERVAL 3 DAY)  ORDER BY store, order_id ASC  LIMIT 6";
                           $query_run = mysqli_query($db, $query);
                           $checkIfExists = mysqli_num_rows($query_run) > 0;
                           if ($checkIfExists){
                              while($row = mysqli_fetch_array($query_run)){
                        ?>
                        <div class="col-12 col-md-6 col-xl-12">
                           <a href="<?= $link ?>?couponId=<?php echo $row['id']; ?>" class="show-modal  offers-list-item-quinary offers-list-quinary__item" title="<?= $row['title'] ?>">
                              <div class="offers-list-item-quinary__body">
                                 <div class="offers-list-item-quinary__logo-wrapper">
                                    <img class="img-fluid lazyload" alt="shop4runners" data-src="<?php echo $row['image']; ?>">
                                    <noscript><img src="<?php echo $row['image']; ?>" alt="shop4runners"/></noscript>
                                 </div>
                                 <div class="offers-list-item-quinary__content">
                                    <div class="offers-list-item-quinary__title">
                                       <?php echo $row['description']; ?>
                                    </div>
                                    <div class="offers-list-item-quinary__meta">
                                       <?php echo $row['title']; ?>
                                    </div>
                                 </div>
                                 <div class="offers-list-item-quinary__badges-wrapper">
                                    <span class="badge badge_type_expires offers-list-item-quinary__badge"><?= $row['expiration'] ?></span>
                                 </div>
                              </div>
                           </a>
                        </div>
                        <?php
                           }
                        }else{
                           echo "No Record Found";
                        }
                        ?>
                     </div>
                  </div>
                  <div class="show-all-link offers-columns__show-all">
                     <a href="/shops" class="show-all-link__link">Show all</a>
                  </div>
               </div>
            </div>
         </div>
         <div class="page-dashboard-home__section">
            <?php
               require 'includes/site/db.php';
               $query = "SELECT * FROM categories LIMIT 4";
               $query_run = mysqli_query($db, $query);
               $checkIfExists = mysqli_num_rows($query_run) > 0;
               if ($checkIfExists)
               {
                  while($catrow = mysqli_fetch_array($query_run))
                  {
            ?>
            <div class="page-header">
               <h2 class="page-header__headline">
               <?= $catrow['name'] ?>
               </h2>
            </div>
            <div class="offers-list-tertiary">
               <div class="row">
                  <?php
                  // require 'includes/site/db.php';
                  $cid = $catrow['id'];
                  $query1 = "SELECT * FROM coupons WHERE `category`= '$cid'  ORDER BY store, order_id ASC LIMIT 4";
                  $query_run1 = mysqli_query($db, $query1);
                  $checkIfExists1 = mysqli_num_rows($query_run1) > 0;
                  if ($checkIfExists1)
                  {
                  while($row = mysqli_fetch_array($query_run1))
                  {
                  ?>
                  <div class="col-12 col-sm-6 col-lg-3">
                     <a href="<?= $link ?>?couponId=<?php echo $row['id']; ?>" class="show-modal  offers-list-item-tertiary offers-list-tertiary__item">
                        <div class="offers-list-item-tertiary__wrapper">
                           <div class="offers-list-item-tertiary__content-wrapper">
                              <div class="offers-list-item-tertiary__logo">
                                 <img class="img-fluid offers-list-item-tertiary__logo-img lazyload" alt="ltur" data-src="<?php echo $row['image']; ?>">
                                 <noscript><img src="<?php echo $row['image']; ?>" class="img-fluid offers-list-item-tertiary__logo-img" alt="<?php echo $row['name']; ?>"/></noscript>
                              </div>
                              <div class="offers-list-item-tertiary__details">
                                 <div class="offers-list-item-tertiary__type">
                                    <?php echo $row['title']; ?>
                                 </div>
                                 <div class="offers-list-item-tertiary__title">
                                    <?php echo $row['description']; ?>
                                 </div>
                              </div>
                           </div>
                           <div class="offers-list-item-tertiary__hits">
                              Neu
                           </div>
                           <div class="offers-list-item-tertiary__badges-wrapper">
                           </div>
                        </div>
                     </a>
                  </div>
                  <?php
                  
                  }
                  }
                  else
                  {
                  echo "No Record Found";
                  }
                  ?>
               </div>
               <div class="show-all-link">
                  <a href="javascript:;" class="show-all-link__link">Show all</a>
               </div>
            </div>
            <?php      
               }
            }else{
               echo "No Record Found";
            }
            ?>
         </div>
         <div class="page-dashboard-home__section-about">
            <div class="layout-description js-layout-description " data-component-ready="">
               <div class="layout-description__aside js-layout-description__aside">

               </div>
               <div class="layout-description__body">
                  <h2 class="layout-description__body-heading">About Us</h2>
                  <div class="wysiwyg-content">
                    <p>Annie Discount is offering the best vouchers, savings and discounts that you can redeem online when shopping in your favorite stores. Our platform offers a wide variety of discounts, promotions, and exclusive deals from some of the biggest brands and retailers around the world. Whether you're looking for discounts on fashion, electronics, home goods, or travel, we have a deal for you.</p>
                      <p>Our team works tirelessly to find the best deals and coupons, ensuring that you get the most savings possible. We pride ourselves on offering a simple, user-friendly platform that makes it easy for you to find the deals you're looking for. So, what are you waiting for? Start exploring our website today and start saving money with <strong>discount code</strong> on all your favorite products and services!</p>
                      <h2 id="how-do-i-get-a-discount-code">How do I get a discount code?</h2>
                      <p>You will find <strong>free vouchers</strong> from numerous online shops. Every day we check the validity of the latest offers and <strong>discount coupons</strong> for you.</p>
                      <p>What do you need to do to get your voucher?</p>
                      <ol>
                         <li>Simply enter a desired shop in the search field at the top right and you will get a brand-new overview of all current offers.</li>
                         <li>Find a discount code in the list that matches the products in your shopping cart.</li>
                         <li>Click on the button and display the voucher code.</li>
                         <li>Click the scissors icon to copy the code to the clipboard.</li>
                         <li>Enter the discount code in the appropriate field in your favorite shop and enjoy the discount granted.</li>
                      </ol>
                      <p>You will also receive additional savings tips and useful information for each online shop. You can also browse through our numerous categories or be inspired by our daily tips.</p>
                      <h2 id="which-savings-can-i-use">Which savings can I use?</h2>
                      <p>A discount code is by no means the only way you can save on your online purchase. Exploit the full potential of the bargain world and look forward to a large selection of savings:</p>
                      <ul>
                         <li><strong>Coupon Codes</strong></li>
                         <li>Discounts</li>
                         <li>Actions &amp; Offers</li>
                         <li>Free Shipping</li>
                         <li><span><strong>Free items</strong> &amp; Gifts</span></li>
                         <li>Competitions</li>
                         <li>Cashback Promotions</li>
                         <li>Financing options</li>
                         <li>Comparison calculator for electricity, telephone, travel, insurance and much more</li>
                      </ul>
                      <p>Our service is completely free for you. No windy subscriptions, no hidden costs: All our codes are completely non-binding for you and can be used without any obligations or providing your personal data. In principle, anyone can redeem a discount code. However, some vouchers are specifically aimed at new customers, others apply to repeat customers or to specific products.</p>
                      <p>If you want, you can subscribe to our newsletter. We will then keep you regularly informed about current offers by e-mail. You can unsubscribe from the newsletter at any time with one click.</p>
                      <h2 id="What-are-the-benefits-of-redeeming-vouchers">What are the benefits of redeeming vouchers?</h2>
                      <p>With a <strong>discount code</strong> you can not only get great percentages. Online shops can come up with many great promotions for you as a customer.</p>
                      <ul>
                         <li>For example, get exciting <strong>free items</strong> with your voucher code! <strong>Free items</strong> are free product rewards that you receive after activating the voucher. Look forward to the additional addition, such as a perfume or a trendy shopping bag.</li>
                         <li>In addition, a shop may simply give you one of the items you have selected in your shopping cart as a gift. These "2 for 1" promotions are rightly very popular.</li>
                         <li>Use other coupons to save on shipping costs.</li>
                      </ul>
                      <p>As you can see, the world of voucher codes is very extensive. Using an <strong>online voucher</strong> is not only clever, it's also a lot of fun! Watching prices tumble is always a joy for any online shopper. We hope you enjoy browsing through the tested offers.</p>
                  </div>
                  <div class="layout-description__button-holder js-layout-description__button-holder">
                     <div class="layout-description__button-fixed js-layout-description__button-fixed">
                        <div class="layout-description__button js-layout-description__button">
                           <i class="layout-description__button-icon layout-description__button-icon_direction_up fa fa-sort-up"></i>
                           <i class="layout-description__button-icon layout-description__button-icon_direction_down fa fa-sort-down"></i>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
        </div>
        <div class="page-dashboard-home__newsletter-primary">
            <div class="newsletter-primary js-newsletter-primary gtm-newsletter newsletter-primary_shown" data-component-ready="">
                <div class="newsletter-primary__background lazyloaded">
                    <i class="newsletter-primary__letter newsletter-primary__letter_num_1"></i>
                    <i class="newsletter-primary__letter newsletter-primary__letter_num_2"></i>
                    <i class="newsletter-primary__letter newsletter-primary__letter_num_3"></i>
                    <i class="newsletter-primary__letter newsletter-primary__letter_num_4"></i>
                    <i class="newsletter-primary__letter newsletter-primary__letter_num_5"></i>
                    <i class="newsletter-primary__letter newsletter-primary__letter_num_6"></i>
                    <i class="newsletter-primary__letter newsletter-primary__letter_num_7"></i>
                </div>
            
                <div class="container">
                    <div class="newsletter-primary__container">
                        <div class="newsletter-primary__logo newsletter-primary__logo_side_left">
                            <div class="newsletter-primary__logo-img lazyloaded"></div>
                        </div>
                        <div class="newsletter-primary__slogan">
                            <font style="vertical-align: inherit;">The Best Promo Codes By Email!</font></div>
                            <form method="post" accept-charset="utf-8" class="newsletter-primary__form js-newsletter-primary__form" action="/">
                                <div class="form-group">
                                    <label class="sr-only" for="email">
                                        <font style="vertical-align: inherit;">E-mail</font>
                                    </label>
                                    <input type="email" name="email" placeholder="Your e-mail address" class="newsletter-primary__input newsletter-primary__input_type_email js-newsletter-primary__input form-control" id="email">
                                </div>            
                                <button class="newsletter-primary__submit js-newsletter-primary__submit btn btn-primary" title="newsletter submit" type="submit">
                                    <font style="vertical-align: inherit;">Register</font>
                                </button>            
                            </form>            
                            <div class="newsletter-primary__disclaimer">
                                <font style="vertical-align: inherit;">
                                    You can unsubscribe from our newsletter at any time.
                                </font>
                                </div>
                        <div class="newsletter-primary__logo newsletter-primary__logo_side_right">
                            <div class="newsletter-primary__logo-img lazyloaded"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
        <div class="page-dashboard-home__section-posts">
            <div class="page-header">
               <h2 class="page-header__headline">
               Magazine
               </h2>
            </div>
            <div class="page-list">
               <div class="row">
                  <?php
                  require 'includes/site/db.php';
                  $query = "SELECT * FROM blogs ORDER BY title, image DESC LIMIT 3";
                  $query_run = mysqli_query($db, $query);
                  $checkIfExists = mysqli_num_rows($query_run) > 0;
                  if ($checkIfExists)
                  {
                  while($row = mysqli_fetch_array($query_run))
                  {
                  ?>
                  <div class="col-12 col-md-6 col-lg-4 ">
                     <div id="post-2901" class="posts-list-item-primary page-list__item">
                        <a href="/magazine-single?id=<?= $row['id'] ?>" class="show-modal  posts-list-item-primary__image-link">
                           <div class="posts-list-item-primary__image-wrapper">
                                 <img class="img-fluid posts-list-item-primary__image image-grayscale lazyload" title="<?= $row['title'] ?>" alt="<?= $row['title'] ?>" data-src="<?= $row['image'] ?>">
                                 <noscript><img src="<?= $row['image'] ?>" class="img-fluid posts-list-item-primary__image image-grayscale" title="<?= $row['title'] ?>" alt="<?= $row['title'] ?>"/></noscript>
                           </div>
                        </a>
                        <div class="posts-list-item-primary__content">
                           <div class="posts-meta posts-list-item-primary__meta">
                              <div class="posts-meta__published">
                                 <i class="posts-meta__published-icon fa fa-clock"></i>&nbsp;<span class="posts-meta__published-text"> <?php echo date('d-m-Y',strtotime($row['created'])); ?> </span>
                              </div>
                              <div class="posts-meta__details">
                                 <span class="posts-meta__details-author"><?= $row['display_name'] ?></span> in <a href="?category=<?= $row['section_name']; ?>" class="posts-meta__details-category"> <?php echo $row['section_name']; ?> </a>
                              </div>
                           </div>
                           <a href="/magazine-single?id=<?= $row['id'] ?>" class="posts-list-item-primary__title"> <?php echo $row['title']; ?> </a>
                           <div class="posts-list-item-primary__excerpt">
                              <p> <?php echo $row['short_description']; ?> </p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php
                  
                  }
                  }
                  else
                  {
                  echo "No Record Found";
                  }
                  ?>
                  
                  
                  
               </div>
            </div>
            <div class="load-more">
               <a href="/magazine" class="btn btn_outlined load-more__button">More articles</a>
            </div>
         </div>

   </div>
   <div class="scroll-up-button js-scroll-up-button"></div>
</div>