<div role="contentinfo">
   <div class="layout-footer js-layout-footer">
      <div class="container">
         <div class="layout-footer__column-wrapper">
            <div class="layout-footer__column">
               <div class="layout-footer__title">Annie Discount</div>
               <div class="layout-footer__separator"></div>
               <div class="layout-footer__link-list">
                  <a href="<?= get_page_link('1'); ?>" class="layout-footer__link" rel="" title="Visit About Us" target="_self">About Us</a>
                  <a href="<?= get_page_link('3'); ?>" class="layout-footer__link" rel="" title="Blogs" target="_self">Blogs</a>
                  <a href="<?= get_page_link('2'); ?>" class="layout-footer__link" rel="" title="Our Privacy Policy" target="_self">Privacy Policy </a>
                                  
               </div>
            </div>
            <div class="layout-footer__column">
               <div class="layout-footer__title">Help</div>
               <div class="layout-footer__separator"></div>
               <div class="layout-footer__link-list">
                  <a href="<?= get_page_link('4'); ?>" class="layout-footer__link">Discount Guide</a>
                  <a href="<?= get_page_link('5'); ?>" class="layout-footer__link">How to use Voucher</a>
                  <a href="/contact" class="layout-footer__link">Contact Us</a>
               </div>
            </div>
            <div class="layout-footer__column">
               <div class="layout-footer__title">Exclusive</div>
               <div class="layout-footer__separator"></div>
           <div class="layout-footer__link-list">
                  <?php
                       require 'includes/site/db.php';
                       $query = "SELECT * FROM categories LIMIT 5";
                       $query_run = mysqli_query($db, $query);
                       $checkIfExists = mysqli_num_rows($query_run) > 0;
                       if ($checkIfExists)
                        {
                            while($row = mysqli_fetch_array($query_run))
                                {
                   ?>
                    <a href="coupons?category=<?= $row['id'] ?>" class="layout-footer__link"><?= ucfirst($row['name']) ?></a>
                  <?php } } ?>
               </div>
            </div>
            <div class="layout-footer__column">
            </div>
         </div>
         <div class="layout-footer__social-copyright-wrapper">
            <div class="layout-footer__social-media-wrapper">
               <a href="#" class="layout-footer__social-link" rel="noopener" title="Besuche Facebook" target="_blank"><img data-src="https://www.gutscheinpony.de/img/social/facebook.svg" class="layout-footer__social-icon lazyload" alt="Facebook"></a>            
            </div>
            <div class="layout-footer__copyright-wrapper">                
               <div class="layout-footer__copyright">
                  © Copyright <?= date('Y') ?>, Annie Discount<br>All statements without guarantee!<br>Updated <?= date('F Y') ?>               
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php
   require 'includes/site/db.php';
   $couponExist = (isset($_GET['couponId']) ? $_GET['couponId'] : null);
   $currentLink = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
   if ($couponExist) {
      $query = "SELECT c.*, s.image AS store_image
                FROM coupons AS c
                LEFT JOIN stores AS s ON c.store = s.id
                WHERE c.id = '$couponExist'";
      $query_run = mysqli_query($db, $query);
      $row = mysqli_fetch_array($query_run);
      $sid = $row['store'];
      $query = "SELECT * FROM stores WHERE `id`= '$sid'";
      $query_run = mysqli_query($db, $query);
      $storerow = mysqli_fetch_array($query_run);
      // print_r($row);
?>
<div class="page-offers-view js-page-offers-view shown" role="dialog" aria-labelledby="page-offers-view-heading-592389" data-component-ready="" style="display: block;" >
   <div class="page-offers-view__container">
      <div class="page-offers-view__body">
         <i class="page-offers-view__close js-page-offers-view__close" role="button" title="Close">
            <a href="javascript:history.back();"><i class="fa fa-times"></i></a>            
         </i>
         <div class="page-offers-view__logo">
            <img src="/<?= !empty($row['image']) ? $row['image'] : $row['store_image'] ?>" style="height: 100px;" class="img-fluid page-offers-view__logo-img" alt="<?= $row['title'] ?>">            
         </div>
         <div id="page-offers-view-heading-592389" class="page-offers-view__heading">
            <font style="vertical-align: inherit;">
            <font style="vertical-align: inherit;"><?= $row['title'] ?></font></font>
         </div>
         <div class="page-offers-view__block page-offers-view__block_for_direct-link">
            <button class="btn btn_type_clickout btn_color_green page-offers-view__clickout-button clickout js-clickout with-code" data-clickout-url="/offers/clickout/592389" data-offer-url="/gutscheine/kickz#open-592389" data-shop-name="KICKZ" data-offer-name="20% Extra-Rabatt auf Releases">
            <i class="btn__icon fa fa-tag"></i>                    
            <span class="btn__label">Gutschein anzeigen</span>
            <span class="btn__code">
            <span class="btn__code-value">*****</span>
            <span class="btn__code-static"></span>
            <span class="btn__code-corner"></span>
            </span>
            </button>
         </div>
         <div class="page-offers-view__row page-offers-view__row_first">
            <div class="page-offers-view__block page-offers-view__block_for_code">
               <div class="page-offers-view__block-title">
                  <font style="vertical-align: inherit;">
                  <font style="vertical-align: inherit;"> Your voucher code</font>
                  </font>
               </div>
               <div class="page-offers-view__code js-page-offers-view__code" data-code="<?= $row['code'] ?>">
                  <span class="page-offers-view__code-text js-page-offers-view__code-text">
                     <font style="vertical-align: inherit;"><?= $row['code'] ?></font></span>
                     <input type="hidden" id="promoCode" value="<?= $row['code'] ?>">

                  <span style="font-size: 20px;" class="page-offers-view__code-button  fa fa-scissors" role="button" aria-label="Copy code"></span>
               </div>
               <div class="page-offers-view__clickout">
                  <a href="https://<?= $storerow['link'] ?>" target="_blank" class="btn btn_color_green" rel="nofollow">
                  
                  <font style="vertical-align: inherit;">
                  <font style="vertical-align: inherit;">To the shop</font>
                  </font>
                  </a>                        
               </div>
            </div>
            <div class="page-offers-view__block">
               <div class="page-offers-view__block-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                  redemption instructions                    </font></font>
               </div>
               <div class="page-offers-view__details">
                  <ul>
                     <li>
                        <i class="fa fa-check"></i>
                        <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">
                        Applies to articles from the landing page                                    
                        </font>
                        </font>
                     </li>
                     <li>
                        <i class="fa fa-check"></i>
                        <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">In the shopping cart , click</font>
                        <font style="vertical-align: inherit;">on</font>
                        </font>
                        <strong>
                        <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">I have a voucher code</font>
                        </font>
                        </strong>
                        <font style="vertical-align: inherit;"></font>
                     </li>
                     <li>
                        <i class="fa fa-check"></i>
                        <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Enter the voucher code and </font>
                        <font style="vertical-align: inherit;">click</font>
                        </font>
                        <strong>
                        <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Redeem</font>
                        </font>
                        </strong>
                        <font style="vertical-align: inherit;"></font>
                     </li>
                     <li>
                        <i class="fa fa-check"></i>
                        <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">For new and existing customers</font>
                        </font>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="page-offers-view__row">
            <div class="page-offers-view__block">
               <div class="page-offers-view__block-title">
                  <font style="vertical-align: inherit;">
                     <font style="vertical-align: inherit;">
                        Split
                    </font>
                 </font>
               </div>
               <div class="page-offers-view__share">
                  <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $currentLink ?>" class="page-offers-view__share-link js-page-offers-view__share-link" title="share via facebook" target="_blank"><i class="page-offers-view__share-icon fab fa-facebook"></i></a>                        <a href="https://twitter.com/intent/tweet?text=<?= $row['title'] ?>&url=<?= $currentLink ?>" class="page-offers-view__share-link js-page-offers-view__share-link" title="share via twitter" target="_blank" data-popup-height="450"><i class="page-offers-view__share-icon fab fa-twitter"></i></a>                        <a href="https://api.whatsapp.com/send?phone=&text=<?= $currentLink ?>" class="page-offers-view__share-link js-page-offers-view__share-link" title="share via whatsapp" target="_blank" data-popup-width="400"><i class="page-offers-view__share-icon fab fa-whatsapp"></i></a>                    
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php  
   }
?>


<script type="text/javascript">
   $('.page-offers-view__code-button').on('click',function () {
      event.preventDefault();
      // Get the text field
        var copyText = document.getElementById("promoCode");
         copyElementToClipboard(copyText.value);
   });
   function copyElementToClipboard(element) {
     window.getSelection().removeAllRanges();
     let range = document.createRange();
     range.selectNode(typeof element === 'string' ? document.getElementById(element) : element);
     window.getSelection().addRange(range);
     document.execCommand('copy');
     window.getSelection().removeAllRanges();
   }
   function addParameterToURL(param){
         // event.preventDefault();
        _url = location.href;
        _url += (_url.split('?')[1] ? '&':'?') + param;
        return _url;
   }
</script>
</body>
</html>