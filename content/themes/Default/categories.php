      <div role="main">
          
          <div class="page-shop-categories-index">
              <div class="container">
                  <div class="page-header">
                      <div class="page-header__layout-breadcrumb">
                            <ol class="layout-breadcrumb ">
                          <li class="layout-breadcrumb__item layout-breadcrumb__item_is-previous">
                              <a href="/">Home</a>            </li>
                              <li class="layout-breadcrumb__item active">
                              CATEGORIES            </li>
                          </ol>
                      </div>
                      <h1 class="page-header__headline">
                      All Category            </h1>
                  </div>
                  <div class="page-shop-categories-index__categories">
                      <div class="shop-categories-list-secondary">
                          <div class="row">
                            <?php 
                                 require 'includes/site/db.php';
                                 $query = "SELECT * FROM categories ";
                                    $query_run = mysqli_query($db, $query);
                                    $ifExist = mysqli_num_rows($query_run) > 0;
                                 if ($ifExist) 
                                 {
                                    while($row = mysqli_fetch_array($query_run))
                                    {
                                       ?>
                                  <div class="col-12 col-sm-6 col-lg-4">
                                  <a  href="coupons?category=<?= $row['id'] ?>" class="shop-categories-list-item-secondary shop-categories-list-secondary__item" title="<?= $row['name'] ?>">
                                      <img class="shop-categories-list-item-secondary__icon lazyloaded" alt="" data-src="" src="<?= $row['icon'] ?>"><noscript><img src="<?= $row['icon'] ?>" class="shop-categories-list-item-secondary__icon" alt=""/></noscript>                                <span class="shop-categories-list-item-secondary__title"> <?php echo $row['name']; ?> </span>
                                      <i class="shop-categories-list-item-secondary__arrow fa"></i>
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
                  <div class="page-shop-categories-index__about">
                      <div class="layout-description js-layout-description " data-component-ready="">
                          <div class="layout-description__aside js-layout-description__aside">
                              <div class="layout-description__aside-holder js-layout-description__aside-holder">
                                  <div class="layout-description__aside-fixed js-layout-description__aside-fixed">
                                      <div class="layout-description__aside-title">Contents</div>
                                      <ul>
                                          <li>
                                              <a href="#mit-tollen-gutscheinen-clever-sparen" class="active">
                                             Save cleverly with great vouchers                                  </a>
                                          </li>
                                      </ul>
                                  </div>
                              </div>
                          </div>
                          <div class="layout-description__body">
                              <div class="wysiwyg-content">
                                  <p>
                                      Always new and attractive vouchers for everything your heart desires! At Voucherpony there are discount campaigns for every need. Does the baby need a new crib? Parents want to order something to eat after a hard day? No problem! The most diverse categories, such as food & drink, furniture & living, toys or tickets, make everything possible. And the best thing is: in addition to saving time and money, you also save yourself the hassle of transporting it. You simply look for the right voucher and redeem it at the shop you trust.
                                  </p>
                                  <h2 id="mit-tollen-gutscheinen-clever-sparen">Save cleverly with great vouchers </h2>
                                  <p>
                                     Has the dog food run out again or have you finished the exciting book? You can always find a worthwhile bargain online and even order all kinds of technology, music & DVDs, as well as sports & outdoor accessories. The fact that shopping is purely a woman's domain would thus be completely refuted.
                                  </p>
                                  <p>
                                      Because men in particular like to take advantage of an unbeatable offer of a new flat screen or high-quality music system. Free vouchers are the smart way to shop and save. Simply send the order with a mouse click, save money with a discount code and have the goods in all categories delivered to your home!
                                  </p>
                                  <p>
                                      More and more people feel stressed and don't have time to spend hours on extended shopping trips in the city. Ordering online with a coupon or voucher code is easy on the wallet and on your nerves. Everything a person needs, whether it's the finest delicacies, a holiday at last or just a nice bouquet of flowers for yourself or your loved ones, can be ordered easily and reliably via voucher pony with the appropriate free campaign. If you want to shop in an original and lucrative way and want to secure fascinating savings as a new or existing customer,
                                  </p>
                              </div>
                              <div class="layout-description__button-holder js-layout-description__button-holder">
                                  <div class="layout-description__button-fixed js-layout-description__button-fixed">
                                      <div class="layout-description__button js-layout-description__button">
                                      <i class="layout-description__button-icon layout-description__button-icon_direction_up fa fa-sort-up"></i>                            <i class="layout-description__button-icon layout-description__button-icon_direction_down fa fa-sort-down"></i>                        </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="scroll-up-button js-scroll-up-button" data-button-label="Nach oben scrollen" data-component-ready=""></div>
      </div>