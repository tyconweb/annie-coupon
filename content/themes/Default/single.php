<?php
    require 'includes/site/db.php';
    $id = $_GET['store_name'];
    $query = "SELECT * FROM stores WHERE name = '$id'";
    $query_run = mysqli_query($db, $query);
    $storeRow = mysqli_fetch_array($query_run);
    $cid = $storeRow['category'];
    $query1 = "SELECT * FROM categories WHERE id = '$cid'";
    $query_run1 = mysqli_query($db, $query1);
    $categoryRow = mysqli_fetch_array($query_run1);
    // print_r($categoryRow);die;
?>
<style>
    
    .btn:active, .btn:focus, .btn:hover  {
        background-color: #d67800 !important;
    }
    .btn_color_yellow{
        background: #fb991c;
    }
    .btn_type_clickout .btn__angle {
        background: #fb991c
            url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='25' height='43' viewBox='-8.965 186.332 25 43'%3E%3Cpath d='M15.442 209.259l-19.77 19.48a2.013 2.013 0 01-2.854 0l-1.192-1.192a2.017 2.017 0 010-2.853l17.17-16.862-17.151-16.862a2.016 2.016 0 010-2.855l1.189-1.191c.79-.79 2.065-.79 2.854 0l19.771 19.48a2.035 2.035 0 01-.017 2.855z' fill='%23fff'/%3E%3C/svg%3E")
            50% no-repeat;
        background-size: 9px 16px !important;
    }
</style>
<div role="main">
   <div class="page-shops-view js-page-shops-view" >
      <div class="teaser teaser_for_shop page-shops-view__teaser">
         <div class="teaser__image-wrapper">
            <picture class="teaser__image-picture">
               <source data-srcset="https://img-01.gutscheinpony.de/img/3b/b5/d0/1_und_1_gp_banner.jpg?fit=crop&amp;w=1920&amp;h=194&amp;q=70&amp;auto=compress%2Cformat" media="(min-width: 1200px)" srcset="https://img-01.gutscheinpony.de/img/3b/b5/d0/1_und_1_gp_banner.jpg?fit=crop&amp;w=1920&amp;h=194&amp;q=70&amp;auto=compress%2Cformat">
               <source data-srcset="https://img-01.gutscheinpony.de/img/3b/b5/d0/1_und_1_gp_banner.jpg?fit=crop&amp;w=1499&amp;h=194&amp;q=70&amp;auto=compress%2Cformat" media="(min-width: 992px)" srcset="https://img-01.gutscheinpony.de/img/3b/b5/d0/1_und_1_gp_banner.jpg?fit=crop&amp;w=1499&amp;h=194&amp;q=70&amp;auto=compress%2Cformat">
               <source data-srcset="https://img-01.gutscheinpony.de/img/3b/b5/d0/1_und_1_gp_banner.jpg?fit=crop&amp;w=991&amp;h=165&amp;q=70&amp;auto=compress%2Cformat" media="(min-width: 768px)" srcset="https://img-01.gutscheinpony.de/img/3b/b5/d0/1_und_1_gp_banner.jpg?fit=crop&amp;w=991&amp;h=165&amp;q=70&amp;auto=compress%2Cformat">
               <source data-srcset="https://img-01.gutscheinpony.de/img/3b/b5/d0/1_und_1_gp_banner.jpg?fit=crop&amp;w=767&amp;h=165&amp;q=70&amp;auto=compress%2Cformat" media="(min-width: 576px)" srcset="https://img-01.gutscheinpony.de/img/3b/b5/d0/1_und_1_gp_banner.jpg?fit=crop&amp;w=767&amp;h=165&amp;q=70&amp;auto=compress%2Cformat">
               <img class="teaser__image lazyloaded" alt="1&amp;1" data-src="https://img-01.gutscheinpony.de/img/3b/b5/d0/1_und_1_gp_banner.jpg?fit=crop&amp;w=575&amp;h=165&amp;q=70&amp;auto=compress%2Cformat" src="https://img-01.gutscheinpony.de/img/3b/b5/d0/1_und_1_gp_banner.jpg?fit=crop&amp;w=575&amp;h=165&amp;q=70&amp;auto=compress%2Cformat">
               <noscript><img src="https://img-01.gutscheinpony.de/img/3b/b5/d0/1_und_1_gp_banner.jpg?fit=crop&amp;w=575&amp;h=165&amp;q=70&amp;auto=compress%2Cformat" class="teaser__image" alt="1&amp;1"/></noscript>
            </picture>
            <div class="teaser__overlay"></div>
         </div>
         <div class="teaser__layout-breadcrumb">
            <div class="container">
                <ol class="layout-breadcrumb layout-breadcrumb_is-teaser">
                    <li class="layout-breadcrumb__item">
                        <a href="/">Home</a>
                    </li>
                    <li class="layout-breadcrumb__item layout-breadcrumb__item_is-previous">
                        <a href="/coupons?category=<?= $storeRow['category'] ?? '' ?>"><?= $categoryRow['name'] ?? ' ' ?></a>            
                    </li>
                    <li class="layout-breadcrumb__item active"><?= $storeRow['name'] ?? 'No Shop Selected' ?></li>
                </ol>
            </div>
         </div>
      </div>
      <div class="container">
         <div class="page-shops-view__content">
            <div class="page-shops-view__shops-card">
               <div class="shops-card">
                  <div class="shops-card__logo">
                     <div class="shops-card__logo-inner">
                        <img class="shops-card__logo-img img-fluid lazyloaded" alt="<?= $storeRow['name'] ?? 'No Shop Selected' ?>" title="<?= $storeRow['name'] ?? 'No Shop Selected' ?>" data-src="<?= $storeRow['image'] ?? 'No Shop Selected' ?>" src="<?= $storeRow['image'] ?? 'No Shop Selected' ?>">
                        <noscript><img src="<?= $storeRow['name'] ?? 'No Shop Selected' ?>" class="shops-card__logo-img img-fluid" alt="<?= $storeRow['name'] ?? 'No Shop Selected' ?>" title="<?= $storeRow['name'] ?? 'No Shop Selected' ?>"/></noscript>
                     </div>
                  </div>
                  <div class="rating js-rating rating_is_5 rating_can-modify shops-card__rating">
                     <div class="rating__stars">
                        <div class="rating__stars-inner">
                           <i class="fa fa-star rating__star js-rating__star" data-rating-value="1"></i>
                           <i class="fa fa-star rating__star js-rating__star" data-rating-value="2"></i>
                           <i class="fa fa-star rating__star js-rating__star" data-rating-value="3"></i>
                           <i class="fa fa-star rating__star js-rating__star" data-rating-value="4"></i>
                           <i class="fa fa-star rating__star js-rating__star" data-rating-value="5"></i>
                        </div>
                     </div>
                     <div class="rating__info">
                        <span class="rating__count js-rating__count"><?= $storeRow['id'] ?? 'No Shop Selected' ?></span> Reviews        
                     </div>
                  </div>
               </div>           
            </div>
            <div class="page-shops-view__heading">
               <h1 class="page-shops-view__heading-title">
                    <?= $storeRow['name']; ?>
               </h1>
               <h2 class="page-shops-view__heading-subscription">
                  All coupon codes and discounts in <?= date('F Y') ?>                
               </h2>
            </div>
            <div class="page-shops-view__offers">
               <div class="page-shops-view__offers-list shops-offers-list js-page-shops-view__offers-list">
                  <div class="shops-offers-list__list js-shops-offers-list__list">
                     <?php
                          $id = $_GET['id'];
                          $query = "SELECT * FROM coupons WHERE `store` = '$id' ORDER BY order_id ASC";
                          $query_run = mysqli_query($db, $query);
                          $checkIfExists = mysqli_num_rows($query_run) > 0;
                          if ($checkIfExists)
                             {
                             while($row = mysqli_fetch_array($query_run))
                                {
                       ?>
                     <div class="offers-list-item-primary clickout js-clickout shops-offers-list__offer js-shops-offers-list__offer">
                        <div class="offers-list-item-primary__label">
                           <div class="offers-label offers-label_type_primary  ">
                              <span class="offers-label__line letters-6"><?= $row['title'] ?></span>
                           </div>
                           <div class="offers-list-item-primary__label-arrow">
                              <img data-src="<?= THEME_LOCATION ?>/assets/arrow.svg" class=" lazyloaded" alt="" src="<?= THEME_LOCATION ?>/assets/arrow.svg">        
                           </div>
                        </div>
                        <div class="offers-list-item-primary__body">
                           <div class="offers-list-item-primary__details">
                              <div class="offers-list-item-primary__details-meta">
                                 <div class="offers-list-item-primary__details-meta-item offers-list-item-primary__badges-wrapper">
                                 </div>
                              </div>
                              <div class="offers-list-item-primary__title">
                                 <strong class="offers-list-item-primary__title-in"><?= $row['description'] ?></strong>
                              </div>
                           </div>
                           <div class="offers-list-item-primary__controls">
                              <button class="offers-list-item-primary__clickout-button btn btn_type_clickout btn_color_yellow">
                              <i class="btn__icon fa fa-shopping-cart"></i>
                              <span class="btn__label">
                                  <?php 
                                        if($row['code'] == ''){
                                            echo 'Show Offer';
                                        }else{
                                            echo 'Show Coupon Code';
                                        }
                                  ?>
                                </span>
                              <a href="javascript:;" onclick="
                              <?php
                                    if($row['code'] == ''){ ?>
                                        window.location.href = addParameterToURL('couponId=<?= $row['id'] ?>');
                                    <?php }else{ 
                                        $link = ($row['link'] != '') ? $row['link'] : 'url'; 
                                    ?>
                                        
                                    <?php } ?>
                                  ">
                                 <i class="btn__angle"></i>
                              </a>
                              </button>
                           </div>
                        </div>
                     </div>
                  <?php } } ?>
                  </div>
               </div>
               <div class="page-shops-view__deals">
               </div>
            </div>
            <div class="page-shops-view__versus-widget">
            </div>
            <div class="page-shops-view__offers-similar">
               <div class="page-header">
                  <h2 class="page-header__headline">Similar Voucher Codes</h2>
               </div>
               <div class="offers-list-tertiary offers-list-tertiary_for_shops-similar">
                  <div class="row">
                     <?php
                          $query = "SELECT * FROM coupons WHERE `category` = '$cid' ORDER BY order_id ASC";
                          $query_run = mysqli_query($db, $query);
                          $checkIfExists = mysqli_num_rows($query_run) > 0;
                          if ($checkIfExists)
                             {
                             while($row = mysqli_fetch_array($query_run))
                                {
                     ?>
                        <div class="col-12 col-sm-6 col-lg-4">
                           <a  href="javascript:;" onclick="window.location.href = addParameterToURL('couponId=<?= $row['id'] ?>');" class="offers-list-item-tertiary clickout js-clickout offers-list-tertiary__item">
                              <div class="offers-list-item-tertiary__wrapper">
                                 <div class="offers-list-item-tertiary__content-wrapper">
                                    <div class="offers-list-item-tertiary__logo">
                                       <img class="img-fluid offers-list-item-tertiary__logo-img lazyloaded" alt="M-net" data-src="<?= $row['image'] ?>" src="<?= $row['image'] ?>">
                                       <noscript><img src="<?= $row['image'] ?>" class="img-fluid offers-list-item-tertiary__logo-img" alt="M-net"/></noscript>
                                    </div>
                                    <div class="offers-list-item-tertiary__details">
                                       <div class="offers-list-item-tertiary__type">
                                          <?= $row['tags'] ?>
                                       </div>
                                       <div class="offers-list-item-tertiary__title">
                                          <?= $row['title'] ?>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="offers-list-item-tertiary__hits">
                                    Redeemed <?= $row['id'] ?> times
                                 </div>
                                 <div class="offers-list-item-tertiary__badges-wrapper">
                                 </div>
                              </div>
                           </a>
                        </div>
                     <?php }  }?>
                  </div>
               </div>
            </div>
            <div class="page-shops-view__top-offers">
               <div class="shops-top-offers-table">
                  <div class="page-header">
                     <h2 class="page-header__headline">
                        Popular <?= $storeRow['name'] ?> coupons in <?= date('F Y') ?>
                     </h2>
                  </div>
                  <div class="shops-top-offers-table__list">
                     <table>
                        <thead>
                           <tr>
                              <th>Discount</th>
                              <th>Details</th>
                              <th>Expiry</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                             $id = $_GET['id'];
                             $query = "SELECT * FROM coupons WHERE `store` = '$id' ORDER BY order_id ASC";
                             $query_run = mysqli_query($db, $query);
                             $checkIfExists = mysqli_num_rows($query_run) > 0;
                             if ($checkIfExists)
                                {
                                while($row = mysqli_fetch_array($query_run))
                                   {
                          ?>
                           <tr>
                              <td><?= $row['title'] ?></td>
                              <td>
                                 <a href="javascript:;" onclick="window.location.href = addParameterToURL('couponId=<?= $row['id'] ?>');"><?= $row['description'] ?></a>                            
                              </td>
                              <td><?= date('d F Y',strtotime($row['expiration'])) ?></td>
                           </tr>
                        <?php } } ?>
                        </tbody>
                        <tfoot>
                            <td>
                                <h5>Extra Description:</h5>
                                <?= $storeRow['description'] ?></td>
                        </tfoot>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="page-dashboard-home__newsletter-primary">
            <div class="newsletter-primary js-newsletter-primary gtm-newsletter newsletter-primary_shown" data-component-ready="" style="margin-bottom: -43px;">
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
</div>