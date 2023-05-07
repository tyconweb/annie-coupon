<!DOCTYPE html>
<!-- saved from url=(0014)about:internet -->
<html lang="en">
   <head>
    <?php echo add_head(); ?>
    <?php 
        function checkPageUrl($url){
            $fullPageUrl = $_SERVER["REQUEST_URI"]; 
            // return $fullPageUrl;
            if($fullPageUrl == $url){
                return 'active';
            }else{
                return '';
            }
        }
    ?>
    <style type="text/css">@font-face {font-family: 'fontello';font-display: swap;font-style: normal;font-weight: normal;src: url('<?= THEME_LOCATION ?>/assets/fonts/fontello.b8f7d26b3abcb9e6d0c8c531843f5fdb.eot');src: url('<?= THEME_LOCATION ?>/assets/fonts/fontello.b8f7d26b3abcb9e6d0c8c531843f5fdb.eot#iefix') format('embedded-opentype'),url('<?= THEME_LOCATION ?>/assets/fonts/fontello.f9075df88dc30c4dbb7913e38fab2365.woff2') format('woff2'),url('<?= THEME_LOCATION ?>/assets/fonts/fontello.931b6c525207b34782021fa58be03af9.woff') format('woff'),url('<?= THEME_LOCATION ?>/assets/fonts/fontello.b907f4590eb1b65ad7196289da84e0f7.ttf') format('truetype'),url('<?= THEME_LOCATION ?>/assets/fonts/fontello.a630650964c435bf3679b6aca1602e69.svg#icon-font') format('svg');}
    </style>
   </head>
   <body <?php echo ( ( $body_classes = body_classes() ) ? ' class="' . $body_classes . '"' : ''); ?>>
      <header class="js-queries-promotion__queries js-layout-search__data">
         <div class="layout-header-desktop js-layout-header-desktop">
            <div class="container">
               <div class="layout-header-desktop__container">
                  <div class="layout-header-desktop__inner">
                     <a href="/" title="Annie Discount" class="layout-header-desktop__logo-link"><img data-src="<?php echo site_logo(); ?>" class="layout-header-desktop__logo-img lazyloaded" alt="tscheinpony" src="<?php echo site_logo(); ?>"></a>                
                     <div class="layout-header-desktop__search js-layout-header-desktop__search">
                        <div class="layout-search layout-search_placement_header-desktop">
                           <form class="layout-search__form" method="GET" action='/' id="searchFormDekstop" role="search">
                              <div class="layout-search__icon layout-search__icon_type_search"><i class="fa fa-search"></i></div>
                              <div class="layout-search__icon layout-search__icon_type_close"></div>
                              <input class="layout-search__input form-control" style="border: none;box-shadow: none;" type="text" autocomplete="off" name="search" placeholder="Search" aria-label="Search">
                              <div class="layout-search__icon layout-search__icon_type_right"><i class="fa fa-angle-right" onclick="$('#searchFormDekstop').submit();"></i></div>
                           </form>
                           <div class="layout-search__results layout-header-desktop__search-results"></div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
            <div class="layout-header-mobile js-layout-header-mobile mobile-custom-header">
               <div  class="layout-header-mobile__wrapper js-layout-header-mobile__wrapper">
                  <div class="container">
                   <div class="layout-header-mobile__landing">
                     <div data-opened="slideUp" class="layout-header-mobile__menu-button mobile-btn" onclick="$(this).hide();$('.menu-mobile').addClass('layout-menu_opened');">
                     </div>
                     <a href="javascript:;" class="layout-header-mobile__logo-link"><img data-src="content/themes/Default/assets/logo.png" class="layout-header-mobile__logo-img lazyload" alt="tscheinpony">
                     </a>
                     <div class="layout-header-mobile__search-button js-layout-header-mobile__search-button">
                       <i class="fa fa-search" onclick="$('.mobile-custom-header').addClass('layout-header-mobile_search-mode')"></i>                
                     </div>
                   </div>
                   <div class="layout-header-mobile__search js-layout-header-mobile__search">
                       <div class="layout-search layout-search_placement_header-mobile">
                           <form class="layout-search__form" method="GET" action="/" role="search">
                               <div class="layout-search__icon layout-search__icon_type_search">
                                <button><i class="fa fa-search"></i></button>
                               </div>
                               <input class="layout-search__input form-control" type="text" autocomplete="off" name="search" placeholder="Search" aria-label="Search" style="box-shadow: 0 0 0 0rem rgb(0 0 0 );margin-left: 10px;">
                               <div class="layout-search__icon layout-search__icon_type_close" onclick="$('.mobile-custom-header').removeClass('layout-header-mobile_search-mode')"></div>
                            </form>
                            <div class="layout-search__results layout-header-mobile__search-results"></div>
                            </div>
                        </div>
                  </div>
               </div>
            </div>
      </header>
      <div class="layout-menu js-layout-menu menu-mobile">
         <div class="layout-menu__fixed js-layout-menu__fixed">
            <div class="container">
               <div class="layout-menu__container">
                  <div class="layout-menu__heading js-layout-menu__heading">
                     <a href="/" title="Zurück zur Startseite" class="layout-menu__logo-link js-layout-menu__logo-link"><img src="<?= THEME_LOCATION ?>/assets/logo.png" class="layout-menu__logo-img lazyloaded" ></a>    
                     <div class="layout-menu__back">
                        <div class="layout-menu__back-icon">
                           <i class="fa fa-angle-right layout-menu__back-icon-i" onclick="$('.menu-mobile').removeClass('layout-menu_opened');$('.mobile-btn').show();"></i>
                        </div>
                        <div class="layout-menu__back-text">Menu</div>
                     </div>
                  </div>
                  <div class="layout-menu__body js-layout-menu__body">
                     <div class="layout-menu__body-inner">
                        <ul class="layout-menu__navigation-ul js-layout-menu__navigation-ul">
                           <li class="layout-menu__navigation-li js-layout-menu__navigation-li">
                              <a href="/" class="layout-menu__navigation-link js-layout-menu__navigation-link gtm-navigation <?= checkPageUrl('/'); ?>"><img data-src="<?= THEME_LOCATION ?>/assets/svgs-coupon/home.svg" class="layout-menu__navigation-icon lazyload" alt=""><span class="layout-menu__navigation-text">Home</span></a>                                
                           </li>
                           <li class="layout-menu__navigation-li js-layout-menu__navigation-li">
                              <a href="/coupons" class="layout-menu__navigation-link js-layout-menu__navigation-link gtm-navigation <?= checkPageUrl('/coupons'); ?>"><img data-src="<?= THEME_LOCATION ?>/assets/svgs-coupon/offers.svg" class="layout-menu__navigation-icon lazyload" alt=""><span class="layout-menu__navigation-text">Voucher Codes</span></a>                                
                           </li>
                           <li class="layout-menu__navigation-li js-layout-menu__navigation-li layout-menu__navigation-li_expandable">
                              <a href="/stores" class="layout-menu__navigation-link js-layout-menu__navigation-link gtm-navigation <?= checkPageUrl('/stores'); ?>"><img data-src="<?= THEME_LOCATION ?>/assets/svgs-coupon/shops.svg" class="layout-menu__navigation-icon lazyload" alt=""><span class="layout-menu__navigation-text">Stores</span></a>
                           </li>
                           <li class="layout-menu__navigation-li js-layout-menu__navigation-li layout-menu__navigation-li_expandable">
                              <a href="/categories" class="layout-menu__navigation-link js-layout-menu__navigation-link gtm-navigation <?= checkPageUrl('/categories'); ?>"><img data-src="<?= THEME_LOCATION ?>/assets/svgs-coupon/shop-categories.svg" class="layout-menu__navigation-icon lazyload" alt=""><span class="layout-menu__navigation-text">Categories</span></a>
                           </li>
                           <li class="layout-menu__navigation-li js-layout-menu__navigation-li layout-menu__navigation-li_expandable">
                              <a href="/magazine" class="layout-menu__navigation-link js-layout-menu__navigation-link gtm-navigation <?= checkPageUrl('/magazine'); ?>"><img data-src="<?= THEME_LOCATION ?>/assets/svgs-coupon/posts.svg" class="layout-menu__navigation-icon lazyload" alt=""><span class="layout-menu__navigation-text">Magazine</span></a>
                           </li>
                        </ul>
                        <!--<div class="layout-menu__footer">-->
                        <!--   <div class="layout-menu-footer">-->
                        <!--      <div class="layout-menu-footer__title">Legal</div>-->
                        <!--      <div class="layout-menu-footer__links">-->
                        <!--         <a href="javascript:;" class="layout-menu-footer__link" title="Besuche Impressum">imprint</a><a href="javascript:;" class="layout-menu-footer__link" title="Besuche Datenschutz">Data protection</a>    -->
                        <!--      </div>-->
                        <!--   </div>-->
                        <!--</div>-->
                     </div>
                  </div>
                  <div class="layout-menu__search js-layout-menu__search"></div>
               </div>
            </div>
         </div>
      </div>

      