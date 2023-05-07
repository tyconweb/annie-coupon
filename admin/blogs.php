<?php

switch( $_GET['action'] ) {

/** ADD BLOG */

case 'add':

if( !ab_to( array( 'blogs' => 'add' ) ) ) die;

echo '<div class="title">

<h2>' .t( 'blogs_add_title', "Add New Blog" ). '</h2>

<div style="float:right; margin: 0 2px 0 0;">
<a href="?route=blogs.php&amp;action=list" class="btn">' . t( 'blogs_view', "View Blogs" ) . '</a>
</div>';

$subtitle1 = t( 'blogs_add_subtitle' );
$subtitle2 = t( 'subblogs_add_subtitle' );

if( !empty( $subtitle1 ) || ( isset( $_GET['subcat'] ) && !empty( $subtitle2 ) ) ) {
    echo '<span>' . ( isset( $_GET['subcat'] ) ? $subtitle2 : $subtitle1 ) . '</span>';
}

echo '</div>';

do_action( array( 'after_title_inner_page', 'after_title_blog_page', 'after_title_add_blog_page' ) );

if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset( $_POST['csrf'] ) && check_csrf( $_POST['csrf'], 'blogs_csrf' ) ) {

    if( isset( $_POST['title'] ) && isset( $_POST['short_description'] ) && isset( $_POST['meta_title'] ) && isset( $_POST['meta_keywords'] ) && isset( $_POST['meta_desc'] ) )
    if( ( $new_blog_id = admin\actions::add_blog(
    value_with_filter( 'save_blog_values', array(
    'title'          => ( isset( $_POST['title'] ) ? $_POST['title'] : '' ),
    'short_description'          => ( isset( $_POST['short_description'] ) ? $_POST['short_description'] : '' ),
    'content'          => ( isset( $_POST['content'] ) ? $_POST['content'] : '' ),
    'section_name'          => ( isset( $_POST['section_name'] ) ? $_POST['section_name'] : '' ),
    'display_name'          => ( isset( $_POST['display_name'] ) ? $_POST['display_name'] : '' ),
    'meta_title'    => ( isset( $_POST['meta_title'] ) ? $_POST['meta_title'] : '' ),
    'meta_keywords' => ( isset( $_POST['meta_keywords'] ) ? $_POST['meta_keywords'] : '' ),
    'meta_desc'     => ( isset( $_POST['meta_desc'] ) ? $_POST['meta_desc'] : '' ),
    ) ) ) ) ) {

    echo '<div class="a-success">' . t( 'msg_added', "Added!" ) . '</div>';

    do_action( array( 'admin_blog_added_edited', 'admin_blog_added' ), $new_blog_id );
    
    } else
    echo '<div class="a-error">' . t( 'msg_error', "Error!" ) . '</div>';

}

$csrf   = $_SESSION['blogs_csrf'] = \site\utils::str_random(10);

$main   = $GLOBALS['admin_main_class']->blog_fields( array(), $csrf );
$fields = $main['fields'];

admin\widgets::get_page_tabs( $main );

echo '<div class="form-table">

<form action="#" method="POST"  enctype="multipart/form-data" autocomplete="off">';

uasort( $fields, function( $a, $b ) {
    if( (double) $a['position'] === (double) $b['position'] ) return 0;
    return ( (double) $a['position'] < (double) $b['position'] ? -1 : 1 );
} );

foreach( $fields as $key => $f ) {
    echo $f['markup'];
}
echo '        <div class="row"><span>' . t( 'form_image', "Image" ) . ':</span> <div><input type="file" name="image" /></div> </div>';


do_action( array( 'admin_blog_after_form_add_edit', 'admin_blog_after_form_add' ) );

echo '<div id="modify_mt">

<div class="title">
    <h2>' . t( 'pages_title_meta', "Modify Personalized Meta-Tags" ) . '</h2>
</div>

<div class="content">';

$fields = $GLOBALS['admin_main_class']->meta_tags_fields( array(), $csrf );

uasort( $fields, function( $a, $b ) {
    if( (double) $a['position'] === (double) $b['position'] ) return 0;
    return ( (double) $a['position'] < (double) $b['position'] ? -1 : 1 );
} );

foreach( $fields as $key => $f ) {
    echo $f['markup'];
}

echo '
    </div>

</div>

<input type="hidden" name="csrf" value="' . $csrf . '" />

<div class="twocols">
    <div>
        <button class="btn btn-important">' . ( isset( $_GET['subcat'] ) ? t( 'subblogs_add_button', "Add Subblog" ) : t( 'blogs_add_button', "Add Blog" ) ) . '</button>
    </div>
    <div>
        <a href="#" class="btn" id="modify_mt_but">' . t( 'pages_editmt_button', "Meta Tags" ) . '</a>
    </div>
</div>

</form>

</div>';

break;

/** EDIT BLOG */

case 'edit':

if( !ab_to( array( 'blogs' => 'edit' ) ) ) die;

$csrf = \site\utils::str_random(10);

echo '<div class="title">

<h2>' . t( 'blogs_edit_title', "Edit Blog" ) . '</h2>

<div style="float:right; margin: 0 2px 0 0;">';

if( isset( $_GET['id'] ) && ( $blog_exists = \query\main::blog_exists( $_GET['id'] ) ) ) {

$info = \query\main::blog_info( $_GET['id'], array( 'no_emoticons' => true, 'no_shortcodes' => true, 'no_filters' => true ) );

$ab_del = ab_to( array( 'blogs' => 'delete' ) );

if( $ab_del ) {
echo '<div class="options">
<a href="#" class="btn">' . t( 'options', "Options" ) . '</a>
<ul>';
if( $ab_del ) echo '<li><a href="?route=blogs.php&amp;action=delete&amp;id=' . $_GET['id'] . '&amp;token=' . $csrf . '" data-delete-msg="' . t( 'delete_msg', "Are you sure that you want to delete this?" ) . '">' . t( 'delete', "Delete" ) . '</a></li>';
echo '</ul>
</div>';

}

}

echo '<a href="?route=blogs.php&amp;action=list" class="btn">' . t( 'blogs_view', "View Blogs" ) . '</a>
</div>';

$subtitle = t( 'blogs_edit_subtitle', "Edit blog" );

if( !empty( $subtitle ) ) {
    echo '<span>' . $subtitle . '</span>';
}

echo '</div>';

do_action( array( 'after_title_inner_page', 'after_title_blog_page', 'after_title_edit_blog_page' ), $info->ID );

if( $blog_exists ) {

if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset( $_POST['csrf'] ) && check_csrf( $_POST['csrf'], 'blogs_csrf' ) ) {
    if( isset( $_POST['change_url_title'] ) ) {

        if( isset( $_POST['url_title'] ) )
        if( admin\actions::edit_blog_url( $_GET['id'],
        array(
        'title' => $_POST['url_title']
        ) ) ) {

        $info = \query\main::blog_info( $_GET['id'], array( 'no_emoticons' => true, 'no_shortcodes' => true, 'no_filters' => true ) );

        echo '<div class="a-success">' . t( 'msg_saved', "Saved!" ) . '</div>';
        } else
        echo '<div class="a-error">' . t( 'msg_error', "Error!" ) . '</div>';

    } else {

        if( isset( $_POST['title'] ) && isset( $_POST['content'] ) && isset( $_POST['meta_title'] ) && isset( $_POST['meta_keywords'] ) && isset( $_POST['meta_desc'] ) )
        if( admin\actions::edit_blog( $_GET['id'],
        value_with_filter( 'save_blog_values', array(
        'title'          => ( isset( $_POST['title'] ) ? $_POST['title'] : '' ),
        'content'   => ( isset( $_POST['content'] ) ? $_POST['content'] : '' ),
        'short_description'      => ( isset( $_POST['short_description'] ) ? $_POST['short_description'] : 0 ),
        'display_name'      => ( isset( $_POST['display_name'] ) ? $_POST['display_name'] : 0 ),
        'section_name'      => ( isset( $_POST['section_name'] ) ? $_POST['section_name'] : 0 ),
        'meta_title'    => ( isset( $_POST['meta_title'] ) ? $_POST['meta_title'] : '' ),
        'meta_keywords' => ( isset( $_POST['meta_keywords'] ) ? $_POST['meta_keywords'] : '' ),
        'meta_desc'     => ( isset( $_POST['meta_desc'] ) ? $_POST['meta_desc'] : '' ),
        ) ) ) ) {

        $info = \query\main::blog_info( $_GET['id'], array( 'no_emoticons' => true, 'no_shortcodes' => true, 'no_filters' => true ) );

        echo '<div class="a-success">' . t( 'msg_saved', "Saved!" ) . '</div>';

        do_action( array( 'admin_blog_added_edited', 'admin_blog_edited' ), $info->ID );

        } else
        echo '<div class="a-error">' . t( 'msg_error', "Error!" ) . '</div>';

    }
}else if( isset( $_GET['type'] ) && isset( $_GET['token'] ) && check_csrf( $_GET['token'], 'blogs_csrf' ) ) {
// die;
if( $_GET['type'] == 'delete_image' ) {

    if( isset( $_GET['id'] ) )
    if( admin\actions::delete_blog_image( $_GET['id'] ) ) {
    $info->image = '';
    echo '<div class="a-success">' . t( 'msg_deleted', "Deleted!" ) . '</div>';
    } else
    echo '<div class="a-error">' . t( 'msg_error', "Error!" ) . '</div>';

}

}

$_SESSION['blogs_csrf'] = $csrf;

$main   = $GLOBALS['admin_main_class']->blog_fields( $info, $csrf );
$fields = $main['fields'];

admin\widgets::get_page_tabs( $main );

echo '<div class="form-table">

<form action="?route=blogs.php&amp;action=edit&amp;id=' . $info->ID . '"  enctype="multipart/form-data" method="POST">';

uasort( $fields, function( $a, $b ) {
    if( (double) $a['position'] === (double) $b['position'] ) return 0;
    return ( (double) $a['position'] < (double) $b['position'] ? -1 : 1 );
} );

foreach( $fields as $key => $f ) {
    echo $f['markup'];
}
echo '<div class="row"><span>' . t( 'form_image', "Image" ) . ':</span>

<div>
<div style="display: table; margin-bottom: 2px;"><img src="' . \query\main::blog_avatar( $info->image ) . '" class="avt" alt="" style="display:table-cell;vertical-align:middle;max-width:120px;height:80px;margin: 0 20px 5px 0;" />
<div style="display: table-cell; vertical-align: middle; margin-left: 25px;">';
if( !empty( $info->image ) ) echo '<a href="' . \site\utils::update_uri( '', array( 'type' => 'delete_image', 'token' => $csrf ) ) . '" class="btn" data-delete-msg="' . t( 'delete_msg', "Are you sure that you want to delete this?" ) . '">' . t( 'delete', "Delete" ) . '</a>';
echo '</div>
</div>

<input type="file" name="image" /></div> 
</div>';
do_action( array( 'admin_blog_after_form_add_edit', 'admin_blog_after_form_edit' ), $info );

echo '<div id="modify_mt">

<div class="title">
    <h2>' . t( 'pages_title_meta', "Modify Personalized Meta-Tags" ) . '</h2>
</div>

<div class="content">';

$fields = $GLOBALS['admin_main_class']->meta_tags_fields( $info, $csrf );

uasort( $fields, function( $a, $b ) {
    if( (double) $a['position'] === (double) $b['position'] ) return 0;
    return ( (double) $a['position'] < (double) $b['position'] ? -1 : 1 );
} );

foreach( $fields as $key => $f ) {
    echo $f['markup'];
}

echo '</div>

</div>

<input type="hidden" name="csrf" value="' . $csrf . '" />

<div class="twocols">
    <div>
        <button class="btn btn-important">' . t( 'blogs_edit_button', "Edit Blog" ) . '</button>
    </div>
    <div>
        <a href="#" class="btn" id="modify_mt_but">' . t( 'pages_editmt_button', "Meta Tags" ) . '</a>
    </div>
</div>

</form>

</div>';

echo '<div class="title" style="margin-top: 40px;">

<h2>' . t( 'blogs_info_title', "Information About This Blog" ) . '</h2>

</div>';

echo '<div class="info-table" id="info-table" style="padding-bottom: 20px;">

<form action="?route=blogs.php&amp;action=edit&amp;id=' . $info->ID . '#info-table" method="POST" autocomplete="off">';

$stat_rows              = array();
$stat_rows['id']        = '<div class="row"><span>ID:</span> <div>' . $info->ID . '</div></div>';
$stat_rows['added_on']  = '<div class="row"><span>' . t( 'added_by', "Added by" ) . ':</span> <div>Admin</div></div>';
$stat_rows['added_date']= '<div class="row"><span>' . t( 'added_on', "Added on" ) . ':</span> <div>' . $info->date . '</div></div>';

echo implode( '', value_with_filter( 'admin_blog_stats', $stat_rows ) );

echo '</form>

</div>';

} else echo '<div class="a-error">Invalid ID.</div>';

break;

/** LIST OF CATEGORIES */

default:

if( !ab_to( array( 'blogs' => 'view' ) ) ) die;

echo '<div class="title">

<h2>' . t( 'blogs_title', "Blogs" ) . '</h2>

<div style="float:right; margin: 0 2px 0 0;">';
if(  ( $ab_add = ab_to( array( 'blogs' => 'add' ) ) ) )echo ' <a href="?route=blogs.php&amp;action=add" class="btn">' . t( 'blogs_add', "Add Blog" ) . '</a>';
echo '</div>';

$subtitle = t( 'blogs_subtitle' );

if( !empty( $subtitle ) ) {
    echo '<span>' . $subtitle . '</span>';
}

echo '</div>';

do_action( array( 'after_title_inner_page', 'after_title_blog_page', 'after_title_blogs_list_page' ) );

if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset( $_POST['csrf'] ) && check_csrf( $_POST['csrf'], 'blogs_csrf' ) ) {

    if( isset( $_POST['delete'] ) ) {

        if( isset( $_POST['id'] ) )
        if( admin\actions::delete_blog( array_keys( $_POST['id'] ) ) )
        echo '<div class="a-success">' . t( 'msg_deleted', "Deleted!" ) . '</div>';
        else
        echo '<div class="a-error">' . t( 'msg_error', "Error!" ) . '</div>';

    }

} else if( isset( $_GET['action'] ) && isset( $_GET['token'] ) && check_csrf( $_GET['token'], 'blogs_csrf' ) ) {

    if( $_GET['action'] == 'delete' ) {

        if( isset( $_GET['id'] ) )
        if( admin\actions::delete_blog( $_GET['id'] ) )
        echo '<div class="a-success">' . t( 'msg_deleted', "Deleted!" ) . '</div>';
        else
        echo '<div class="a-error">' . t( 'msg_error', "Error!" ) . '</div>';

    }

}

$csrf = $_SESSION['blogs_csrf'] = \site\utils::str_random(10);

echo '<div class="page-toolbar">

<form action="#" method="GET" autocomplete="off" novalidate>

<input type="hidden" name="route" value="blogs.php" />

' . t( 'order_by', "Order by" ) . ':
<select name="orderby">';
foreach( array( 'date' => t( 'order_date', "Date" ), 'date desc' => t( 'order_date_desc', "Date DESC" ), 'name' => t( 'order_name', "Name" ), 'name desc' => t( 'order_name_desc', "Name DESC" ) ) as $k => $v )echo '<option value="' . $k . '"' . (isset( $_GET['orderby'] ) && urldecode( $_GET['orderby'] ) == $k || !isset( $_GET['orderby'] ) && $k == 'name' ? ' selected' : '') . '>' . $v . '</option>';
echo '</select>

<input type="hidden" name="action" value="list" />

<button class="btn">' . t( 'view', "View" ) . '</button>

</form>

</div>';

$custom_toolbar = do_action( 'admin_blogs_list_custom_toolbar' );

if( !empty( $custom_toolbar ) ) {
    echo '<div class="page-toolbar">';
    echo $custom_toolbar;
    echo '</div>';
}

$p = \query\main::have_blogs( ( $options = value_with_filter( 'admin_view_blogs_args', array( 'per_page' => 10 ) ) ) );

echo '<div class="results">' . ( (int) $p['results'] === 1 ? sprintf( t( 'result', "<b>%s</b> result" ), $p['results'] ) : sprintf( t( 'results', "<b>%s</b> results" ), $p['results'] ) );
if( value_with_filter( 'admin_blogs_list_reset_view', false ) ) echo ' / <a href="?route=blogs.php&amp;action=list">' . t( 'reset_view', "Reset view" ) . '</a>';
echo '</div>';

if( $p['results'] ) {

echo '<form action="?route=blogs.php&amp;action=list" method="POST">

<ul class="elements-list">

<li class="head"><input type="checkbox" id="selectall" data-checkall /> <label for="selectall"><span></span> ' . t( 'name', "Name" ) . '</label>
</li>';

$ab_edt = ab_to( array( 'blogs' => 'edit' ) );
$ab_del = ab_to( array( 'blogs' => 'delete' ) );

if( $ab_del ) {
echo '<div class="bulk_options">
    <button class="btn" name="delete" data-delete-msg="' . t( 'delete_msg', "Are you sure that you want to delete this?" ) . '">' . t( 'delete_all', "Delete All" ) . '</button>
</div>';
}

foreach( \query\main::while_blogs( array_merge( array( 'page' => $p['page'], 'orderby' => value_with_filter( 'admin_view_blogs_orderby', ( isset( $_GET['orderby'] ) ? urldecode( $_GET['orderby'] ) : 'created desc' ) ) ), $options ), array( 'no_emoticons' => true, 'no_filters' => true ) ) as $item ) {

    $links = array();

    if( $ab_edt ) $links['edit'] = '<a href="?route=blogs.php&amp;action=edit&amp;id=' . $item->ID . '">' . t( 'edit', "Edit" ) . '</a>';
    if( $ab_add) $links['add'] = '<a href="?route=blogs.php&amp;action=add&amp;subcat&amp;cat=' . $item->ID . '">' . t( 'blogs_add', "Add Blog" ) . '</a>';
    if( $ab_del ) $links['delete'] = '<a href="' . \site\utils::update_uri( '', array( 'action' => 'delete', 'id' => $item->ID, 'token' => $csrf ) ) . '" data-delete-msg="' . t( 'delete_msg', "Are you sure that you want to delete this?" ) . '">' . t( 'delete', "Delete" ) . '</a>';

    echo get_list_type( 'blog', $item, $links );


}

echo '</ul>

<input type="hidden" name="csrf" value="' . $csrf . '" />

</form>';

if( isset( $p['prev_page'] ) || isset( $p['next_page'] ) ) {
    echo '<div class="pagination">';

    if( isset( $p['prev_page'] ) ) echo '<a href="' . $p['prev_page'] . '" class="btn">' . t( 'prev_page', "&larr; Prev" ) . '</a>';
    if( isset( $p['next_page'] ) ) echo '<a href="' . $p['next_page'] . '" class="btn">' . t( 'next_page', "Next &rarr;" ) . '</a>';

    if( $p['pages'] > 1 ) {
    echo '<div class="pag_goto">' . sprintf( t( 'pageofpages', "Page <b>%s</b> of <b>%s</b>" ), $page = $p['page'], $pages = $p['pages'] ) . '
    <form action="#" method="GET">';
    foreach( $_GET as $gk => $gv ) if( $gk !== 'page' ) echo '<input type="hidden" name="' . esc_html( $gk ) . '" value="' . esc_html( $gv ) . '" />';
    echo '<input type="number" name="page" min="1" max="' . $pages . '" size="5" value="' . $page . '" />
    <button class="btn">' . t( 'go', "Go" ) . '</button>
    </form>
    </div>';
    }

    echo '</div>';
}

} else echo '<div class="a-alert">' . t( 'no_blogs_yet', "No blogs yet." ) . '</div>';

break;

}

?>  

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script type="text/javascript">
    tinymce.init({
        selector: "textarea[name=content]",
        plugins: [
        "insertdatetime"
        ],
        width: 700,
        height: 400,
    });
    $('.tox-notification--warning').remove();
    setTimeout(() => {
        $('.tox-notification__dismiss').click();
    }, 2000)
    // $('.tox-notification__dismiss').click();
</script>