<div role="main">
    <div class="page-shops-index js-page-shops-index" data-component-ready="">
        <div class="container">
            <div class="page-header">
                <div class="page-header__layout-breadcrumb">
                    <ol class="layout-breadcrumb ">
                        <li class="layout-breadcrumb__item layout-breadcrumb__item_is-previous">
                            <a href="/">Home</a>
                        </li>
                        <li class="layout-breadcrumb__item active"> Shops </li>
                    </ol>
                </div>
                <h1 class="page-header__headline"> All Shops </h1>
            </div>
        </div>
        <div class="page-shops-index__links">
            <div class="container">
                <div class="page-shops-index__links-inner">
                    <a href="#letter-a" class="page-shops-index__links-item js-page-shops-index__links-item" data-link-offset="30">A</a>
                    <a href="#letter-b" class="page-shops-index__links-item js-page-shops-index__links-item" data-link-offset="30">B</a>
                    <a href="#letter-c" class="page-shops-index__links-item js-page-shops-index__links-item" data-link-offset="30">C</a>
                    <a href="#letter-d" class="page-shops-index__links-item js-page-shops-index__links-item" data-link-offset="30">D</a>
                    <a href="#letter-e" class="page-shops-index__links-item js-page-shops-index__links-item" data-link-offset="30">E</a>
                    <a href="#letter-f" class="page-shops-index__links-item js-page-shops-index__links-item" data-link-offset="30">F</a>
                    <a href="#letter-g" class="page-shops-index__links-item js-page-shops-index__links-item" data-link-offset="30">G</a>
                    <a href="#letter-h" class="page-shops-index__links-item js-page-shops-index__links-item" data-link-offset="30">H</a>
                    <a href="#letter-i" class="page-shops-index__links-item js-page-shops-index__links-item" data-link-offset="30">I</a>
                    <a href="#letter-j" class="page-shops-index__links-item js-page-shops-index__links-item" data-link-offset="30">J</a>
                    <a href="#letter-k" class="page-shops-index__links-item js-page-shops-index__links-item" data-link-offset="30">K</a>
                    <a href="#letter-l" class="page-shops-index__links-item js-page-shops-index__links-item" data-link-offset="30">L</a>
                    <a href="#letter-m" class="page-shops-index__links-item js-page-shops-index__links-item" data-link-offset="30">M</a>
                    <a href="#letter-n" class="page-shops-index__links-item js-page-shops-index__links-item" data-link-offset="30">N</a>
                    <a href="#letter-o" class="page-shops-index__links-item js-page-shops-index__links-item" data-link-offset="30">O</a>
                    <a href="#letter-Ö" class="page-shops-index__links-item js-page-shops-index__links-item" data-link-offset="30">Ö</a>
                    <a href="#letter-p" class="page-shops-index__links-item js-page-shops-index__links-item" data-link-offset="30">P</a>
                    <a href="#letter-q" class="page-shops-index__links-item js-page-shops-index__links-item" data-link-offset="30">Q</a>
                    <a href="#letter-r" class="page-shops-index__links-item js-page-shops-index__links-item" data-link-offset="30">R</a>
                    <a href="#letter-s" class="page-shops-index__links-item js-page-shops-index__links-item" data-link-offset="30">S</a>
                    <a href="#letter-t" class="page-shops-index__links-item js-page-shops-index__links-item" data-link-offset="30">T</a>
                    <a href="#letter-u" class="page-shops-index__links-item js-page-shops-index__links-item" data-link-offset="30">U</a>
                    <a href="#letter-v" class="page-shops-index__links-item js-page-shops-index__links-item" data-link-offset="30">V</a>
                    <a href="#letter-w" class="page-shops-index__links-item js-page-shops-index__links-item" data-link-offset="30">W</a>
                    <a href="#letter-x" class="page-shops-index__links-item js-page-shops-index__links-item" data-link-offset="30">X</a>
                    <a href="#letter-y" class="page-shops-index__links-item js-page-shops-index__links-item" data-link-offset="30">Y</a>
                    <a href="#letter-z" class="page-shops-index__links-item js-page-shops-index__links-item" data-link-offset="30">Z</a>
                </div>
            </div>
        </div>
        <div class="container">
            <div  class="page-shops-index__tab" id="letter-0-9">
               
                <div class="row page-shops-index__tab-featured-shops js-page-shops-index__tab-featured-shops" data-related-letter="0-9">
                    <?php
                    require 'includes/site/db.php';
                    $query = "SELECT * FROM stores LIMIT 6";
                    $query_run = mysqli_query($db, $query);
                    $checkIfExists = mysqli_num_rows($query_run) > 0;
                    if ($checkIfExists)
                    {
                    while($row = mysqli_fetch_array($query_run))
                    {
                    ?>
                      <div class="col-12 col-sm-6 col-lg-3">
                      <div  class="page-shops-index__featured-shops-list js-page-shops-index__featured-shops-list">
                          <div style="width: 205px; " class="page-shops-index__featured-shops-item js-page-shops-index__featured-shops-item">
                              <a href="/store/<?php echo $row['name'];?>" class="page-shops-index__featured-shops-link" title="<?php echo $row['name']; ?>">
                                  <div style="margin-top: -8px; " class="page-shops-index__featured-shops-logo">
                                      <img  class="img-fluid image-grayscale lazyloaded" alt="1&amp;1" data-src="<?php echo $row['image']; ?>" src="<?php echo $row['image']; ?>">
                                      <noscript>
                                      <img src="<?php echo $row['image']; ?>" class="img-fluid image-grayscale" alt="1&amp;1" />
                                      </noscript>
                                  </div>
                              </a>
                          </div>
                      </div>
                        <?php
                            $store = $row['id'];
                            $query1 = "SELECT * FROM coupons WHERE `store` = '$store'  ORDER BY store, order_id ASC LIMIT 10";
                            $query_run1 = mysqli_query($db, $query1);
                            $checkIfExists1 = mysqli_num_rows($query_run1) > 0;
                            if ($checkIfExists1)
                            {
                            while($store = mysqli_fetch_array($query_run1))
                            {
                        ?>
                           <a  href="?couponId=<?= $store['id'] ?>" class="d-block"><?php echo $store['code']; ?></a>
                        <?php } } ?>
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
                <div  class="page-shops-index__tab-shops" >
                    <div class="page-shops-index__shop page-shops-index__shop-link">
                    </div>                    
                </div>
            </div>
        </a>
    </div>
</div>
</div>
</div>
</div>