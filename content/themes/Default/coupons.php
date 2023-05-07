
<div role="main">
    
<div class="page-offers-index js-page-offers-index" data-offers-url="/gutscheine" data-component-ready="">
    <div class="container">
        <div class="page-header">
            <div class="page-header__layout-breadcrumb">
                <ol class="layout-breadcrumb ">
                <li class="layout-breadcrumb__item layout-breadcrumb__item_is-previous">
                    <a href="/">Home</a>            </li>
                    <li class="layout-breadcrumb__item active">
                    Coupons</li>
                </ol>
            </div>
            <h1 class="page-header__headline">
            All Coupons           </h1>
        </div>
        <div class="page-offers-index__offers">
            <div class="row">
                <div class="col-lg-3">
                    <div class="page-offers-index__filters-aside">
                        <div class="offers-filters-panel js-offers-filters-panel">
                           <div class="offers-filters-panel__menus-container-scrollable">
                              <div class="offers-filters-panel__menus-container-inner">
                                 <div class="offers-filters-panel__back js-offers-filters-panel__back"><i class="offers-filters-panel__back-icon"></i><span class="offers-filters-panel__back-text">FILTER</span></div>
                                 <div class="offers-filters-panel__menu js-offers-filters-panel__menu offers-filters-panel__menu_for_applied-filters">
                                    <div class="offers-filters-panel__button js-offers-filters-panel__button">
                                       <i class="offers-filters-panel__button-icon"></i>
                                       <div class="offers-filters-panel__button-text">Filter</div>
                                       <div class="offers-filters-panel__button-clear js-offers-filters-panel__button-clear"><a href="coupons">Clear All</a></div>
                                       <i class="offers-filters-panel__button-state"></i>
                                    </div>
                                    <div class="offers-filters-panel__filters js-offers-filters-panel__filters">
                                       <div class="offers-filters-panel__filters-inner js-offers-filters-panel__filters-inner js-offers-filters-panel__applied-filters" data-type="applied-filters" data-header="Filter" data-component-ready="" style=""></div>
                                       <div class="offers-filters-panel__controls"><button class="btn btn_size_lg offers-filters-panel__controls-button js-offers-filters-panel__controls-button">Anwenden</button></div>
                                    </div>
                                 </div>
                                 <div class="offers-filters-panel__menu js-offers-filters-panel__menu offers-filters-panel__menu_for_categories">
                                    <div class="offers-filters-panel__button js-offers-filters-panel__button">
                                       <i class="offers-filters-panel__button-icon"></i>
                                       <div class="offers-filters-panel__button-text">CATEGORY</div>
                                       <div class="offers-filters-panel__button-clear js-offers-filters-panel__button-clear"><a href="coupons">Clear All</a></div>
                                       <i class="offers-filters-panel__button-state"></i>
                                    </div>
                                    <div class="offers-filters-panel__filters js-offers-filters-panel__filters">
                                       <div class="offers-filters-panel__filters-inner js-offers-filters-panel__filters-inner js-offers-filters-panel__categories" data-type="categories" data-header="Kategorie" data-component-ready="">
                                          <div class="offers-filters-panel__back js-offers-filters-panel__back"><i class="offers-filters-panel__back-icon"></i><span class="offers-filters-panel__back-text">CATEGORY</span></div>
                                          <div class="offers-filters-panel__filters-list">
                                             <?php 
                                               require 'includes/site/db.php';
                                               $query1 = "SELECT * FROM categories ";
                                                  $query_run1 = mysqli_query($db, $query1);
                                                  $ifExist1 = mysqli_num_rows($query_run1) > 0;
                                               if ($ifExist1) 
                                               {
                                                  while($row1 = mysqli_fetch_array($query_run1))
                                                  {
                                            ?>
                                            <div class="offers-filters-panel__filter js-offers-filters-panel__filter">
                                                 <label class="offers-filters-panel__filter-label"><?= $row1['name'] ?></label>
                                                 <span><input type="checkbox" <?= (isset($_GET['category']) && $row1['id'] == $_GET['category']) ? 'checked' : ''  ?> name="filter" onclick="window.location.href = '/coupons?category=<?= $row1['id'] ?>';" class="offers-filters-panel__filter-checkbox"><i class="offers-filters-panel__filter-checkbox-check fa fa-ok"></i></span>
                                            </div>
                                            <?php } } ?>
                                          </div>
                                       </div>
                                       <div class="offers-filters-panel__controls"><button class="btn btn_size_lg offers-filters-panel__controls-button js-offers-filters-panel__controls-button disabled">Use</button></div>
                                    </div>
                                 </div>
                              </div>
                              <div class="offers-filters-panel__controls"><button class="btn btn_size_lg offers-filters-panel__controls-button js-offers-filters-panel__controls-button offers-filters-panel__controls-button_type_main-apply">Use</button><button class="btn btn_size_lg offers-filters-panel__controls-button js-offers-filters-panel__controls-button offers-filters-panel__controls-button_type_main-reset">Reset filter</button></div>
                           </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-9">
                    <div class="page-offers-index__filters-headline js-page-offers-index__filters-headline">
                        <div class="offers-filters-headline js-offers-filters-headline" data-component-ready="">
                            <div class="offers-filters-headline__mobile js-offers-filters-headline__mobile">
                                <div class="offers-filters-headline__mobile-fixed js-offers-filters-headline__mobile-fixed">
                                    <div class="offers-filters-headline__mobile-menu-button js-offers-filters-headline__mobile-menu-button">
                                    Filter            </div>
                                    <?php $filter = $_GET['sorting'] ?? ''; ?>
                                    <div class="offers-filters-headline__mobile-select-wrapper">
                                        <select class="offers-filters-headline__select js-offers-filters-headline__select offers-filters-headline__select_for_mobile" aria-labelledby="offers-filters-headline-sort-by-label" onchange="window.location.href = '/coupons?sorting='+$(this).val();">
                                            <option value="popular" selected="selected" data-default="true">Most popular</option>
                                            <option value="latest" <?= ($filter=='latest') ? 'selected' : '' ?> >Latest</option>
                                            <option value="expiring" <?= ($filter=='expiring') ? 'selected' : '' ?> >Expiring</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="offers-filters-headline__desktop">
                                <span id="offers-filters-headline-sort-by-label">Sorting: </span>
                                <span class="offers-filters-headline__desktop-sort-by js-offers-filters-headline__desktop-sort-by">Most popular</span>
                                <select class="offers-filters-headline__select js-offers-filters-headline__select offers-filters-headline__select_for_desktop" aria-labelledby="offers-filters-headline-sort-by-label" onchange="window.location.href = '/coupons?sorting='+$(this).val();">
                                    <option value="popular" selected="selected" data-default="true">Most popular</option>
                                    <option value="latest" <?= ($filter=='latest') ? 'selected' : '' ?> >Latest</option>
                                    <option value="expiring" <?= ($filter=='expiring') ? 'selected' : '' ?> >Expiring</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="page-offers-index__offers-list js-page-offers-index__offers-list"><div class="load-more-page load-more-page_preload_next js-load-more-page" data-load-more-page="1" data-load-more-param="page" data-load-more-url="/gutscheine" data-component-ready="">
                        <div class="offers-list-tertiary ">
                            <div class="row">
                            <?php 
                              require 'includes/site/db.php';
                                $id = $_GET["category"] ?? 0;   
                                $cond = (isset($_GET['category'])) ? "WHERE category = $id" : '';
                                if($filter == 'latest'){
                                    $cond .= 'ORDER BY id DESC';
                                }
                                if($filter == 'expiring'){
                                    $cond .= (isset($_GET['category'])) ? "AND " : 'WHERE ' . " expiration>=DATE_SUB(expiration,INTERVAL 3 DAY)";
                                }
                                if($filter != 'latest'){
                                    $cond .= "ORDER BY store, order_id ASC";
                                }
                                // exit($cond);
                              $query = "SELECT * FROM coupons $cond";
                              $query_run = mysqli_query($db, $query);
                                // exit($query);

                              $ifExist = mysqli_num_rows($query_run) > 0;
                           if ($ifExist) 
                           {
                              while($row = mysqli_fetch_array($query_run))
                              {
                                 ?>
                                    <div class="col-12 col-sm-6 col-lg-4">
                                        <a href="?couponId=<?= $row['id'] ?>" class="offers-list-item-tertiary clickout js-clickout offers-list-tertiary__item" title="<?= $row['title'] ?>"  data-shop-name="XING" data-offer-name="60% Rabatt auf die Premium-Mitgliedschaft" data-offer-id="498333" >
                                            <div class="offers-list-item-tertiary__wrapper">
                                                <div class="offers-list-item-tertiary__content-wrapper">
                                                    <div  class="offers-list-item-tertiary__logo">
                                                    <img class="img-fluid offers-list-item-tertiary__logo-img ls-is-cached lazyloaded"  alt="<?php echo $row['title']; ?>"  data-src="<?php echo $row['image']; ?>" src="<?php echo $row['image']; ?>"><noscript><img src="<?php echo $row['image']; ?>" class="img-fluid offers-list-item-tertiary__logo-img" alt="<?php echo $row['title']; ?>"/></noscript>            </div>
                                                    <div class="offers-list-item-tertiary__details">
                                                        <div class="offers-list-item-tertiary__type">
                                                        <?php echo $row['title']; ?>                </div>
                                                        <div class="offers-list-item-tertiary__title">
                                                         <?php echo $row['description']; ?>               </div>
                                                    </div>
                                                </div>
                                                <div class="offers-list-item-tertiary__hits">
                                                5538 Times Redeemed        </div>
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
                        </div>
                    </div>
                 </div>

</div>
</div>   
</div>
</div>
</div>
