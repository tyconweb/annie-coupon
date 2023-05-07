<?php if(isset($_GET['id'])){ 
   require 'includes/site/db.php';
   $id = $_GET['id'];
   $query = "SELECT * FROM blogs WHERE id = $id";
   // print_r($query); exit;
   $query_run = mysqli_query($db, $query);
   $row = mysqli_fetch_array($query_run);
   $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://" . $_SERVER['HTTP_HOST'].''.$_SERVER['REQUEST_URI'];
?>
<div role="main">
   <div class="page-posts-view">
      <div class="teaser teaser_for_post page-posts-view__teaser">
         <div class="teaser__image-wrapper">
            <picture class="teaser__image-picture">
               <img class="teaser__image lazyloaded" alt="<?= $row['title'] ?>" data-src="<?= $row['image'] ?>?fit=crop&amp;w=575&amp;h=450&amp;q=70&amp;auto=compress%2Cformat" src="<?= $row['image'] ?>?fit=crop&amp;w=575&amp;h=450&amp;q=70&amp;auto=compress%2Cformat">
               <noscript><img src="<?= $row['image'] ?>?fit=crop&amp;w=575&amp;h=450&amp;q=70&amp;auto=compress%2Cformat" class="teaser__image" alt="<?= $row['title'] ?>"/></noscript>
            </picture>
            <div class="teaser__overlay"></div>
         </div>
         <div class="teaser__content teaser-content-post">
            <div class="container">
               <h1 class="teaser-content-post__title">
                  <?= $row['title'] ?>                
               </h1>
               <div class="teaser-content-post__excerpt">
                  <p><?= $row['short_description'] ?></p>
               </div>
               <div class="posts-meta teaser-content-post__meta posts-meta_color_white posts-meta_size_compact">
                  <div class="posts-meta__published">
                     <i class="posts-meta__published-icon fa fa-clock"></i>&nbsp;<span class="posts-meta__published-text"><?= date('d. F Y', strtotime($row['created'])) ?></span>    
                  </div>
                  <div class="posts-meta__details">
                     <span class="posts-meta__details-author"><?= $row['display_name'] ?></span> in <a href="?category=<?= $row['section_name'] ?>" class="posts-meta__details-category"><?= $row['section_name'] ?></a>    
                  </div>
               </div>
            </div>
         </div>
         <div class="teaser__layout-breadcrumb">
            <div class="container">
               <ol class="layout-breadcrumb layout-breadcrumb_is-teaser">
                  <li class="layout-breadcrumb__item">
                     <a href="/">Home</a>            
                  </li>
                  <li class="layout-breadcrumb__item">
                     <a href="/magazine">Magazine</a>            
                  </li>
                  <li class="layout-breadcrumb__item layout-breadcrumb__item_is-previous">
                     <a href="/magazine?category=<?= $row['section_name'] ?>"><?= $row['section_name'] ?></a>            
                  </li>
                  <li class="layout-breadcrumb__item active">
                     <?= $row['title'] ?>
                  </li>
               </ol>
            </div>
         </div>
      </div>
      <div class="container">
         <div class="page-posts-view__page-post">
            <div class="layout-description js-layout-description " data-component-ready="">
               <div class="layout-description__aside js-layout-description__aside">
               </div>
               <div class="">
                  <div class="wysiwyg-content">
                     <div class="row">
                        <div class="col-12 col-lg-1">
                           <div class="posts-share js-posts-share " data-component-ready="">
                              <div class="posts-share__links">
                                 <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $actual_link ?>" class="posts-share__link js-posts-share__link" target="_blank" title="per Facebook teilen"><i class="fab fa-facebook"></i></a>        <a href="https://twitter.com/intent/tweet?text=<?= $row['title'] ?>url=<?= $actual_link ?>" class="posts-share__link js-posts-share__link" target="_blank" data-popup-height="450" title="per Twitter teilen"><i class="fab fa-twitter"></i></a>        <a href="https://api.whatsapp.com/send?text=<?= $row['title'] ?>%20<?= $actual_link ?>" class="posts-share__link js-posts-share__link" target="_blank" data-popup-width="400" title="per Whatsapp teilen"><i class="fab fa-whatsapp"></i></a>        
                                 <div class="posts-share__link js-posts-share__clipboard-link" data-clipboard-text="<?= $actual_link ?>" data-success-text="Copied" role="button" aria-label="Link Copy">
                                    <i class="fa fa-link"></i>        
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-12 col-lg-11">
                           <?= htmlspecialchars_decode($row['content']) ?>
                        </div>
                     </div>
                  </div>
                  <div class="layout-description__button-holder js-layout-description__button-holder">
                     <div class="layout-description__button-fixed js-layout-description__button-fixed">
                        <div class="layout-description__button js-layout-description__button">
                           <i class="layout-description__button-icon layout-description__button-icon_direction_up fa fa-sort-up"></i>                            <i class="layout-description__button-icon layout-description__button-icon_direction_down fa fa-sort-down"></i>                        
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="scroll-up-button js-scroll-up-button" data-button-label="Nach oben scrollen" data-component-ready=""><button class="btn scroll-up-button__button" aria-label="Nach oben scrollen"></button></div>
</div>
<?php } ?>