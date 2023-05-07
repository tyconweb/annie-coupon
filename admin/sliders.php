<?php

switch( $_GET['action'] ) {

/** ADD SLIDER */

case 'add':

if( !$GLOBALS['me']->is_admin ) die;

echo '<div class="title">

<h2>' . t( 'sliders_add_title', "Add New Slider" ) . '</h2>

<div style="float:right;margin:0 2px 0 0;">
<a href="?route=sliders.php&amp;action=list" class="btn">' . t( 'sliders_view', "View Sliders" ) . '</a>
</div>';

$subtitle = t( 'sliders_add_subtitle' );

if( !empty( $subtitle ) ) {
    echo '<span>' . $subtitle . '</span>';
}

echo '</div>';

do_action( array( 'after_title_inner_page', 'after_title_sliders_page', 'after_title_add_sliders_page' ) );

if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset( $_POST['csrf'] ) && check_csrf( $_POST['csrf'], 'sliders_csrf' ) ) {

    if( isset( $_POST['name'] )  )
    if( admin\actions::add_slider(
    array(
    'name' => $_POST['name'],
    'publish' => ( isset( $_POST['publish'] ) ? 1 : 0 )
    ) ) )

    echo '<div class="a-success">' . t( 'msg_added', "Added!" ) . '</div>';
    else
    echo '<div class="a-error">' . t( 'msg_error', "Error!" ) . '</div>';

}

$csrf = $_SESSION['sliders_csrf'] = \site\utils::str_random(10);

echo '<div class="form-table">

<form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">

<div class="row"><span>' . t( 'form_name', "Name" ) . ':</span><div><input type="text" name="name" value="" /></div></div>
<div class="row"><span>' . t( 'form_image', "Image" ) . ':</span> <div><input type="file" name="logo" /></div> </div>

</div>

<div class="row"><span>' . t( 'form_publish', "Publish" ) . ':</span><div><input type="checkbox" name="publish" id="publish" checked /> <label for="publish"><span></span> ' . t( 'msg_pubslider', "Publish this slider" ) . '</label></div></div>

<input type="hidden" name="csrf" value="' . $csrf . '" />

<div class="twocols">
    <div>
        <button class="btn btn-important">' . t( 'sliders_add_button', "Add Slider" ) . '</button>
    </div>
    <div></div>
</div>

</form>

</div>';

break;

/** EDIT SLIDER */

case 'edit':

if( !$GLOBALS['me']->is_admin ) die;

$csrf = \site\utils::str_random(10);
$slider_exists = \query\main::slider_exists( $_GET['id'] );
echo '<div class="title">

<h2 >' . t( 'sliders_edit_title', "Edit Slider" ) . '</h2>

<div style="float:right;margin:0 2px 0 0;">';

if( isset( $_GET['id'] ) && ( $slider_exists ) ) {

$info = \query\main::slider_info( $_GET['id'] );

echo '<div class="options">
<a href="#" class="btn">' . t( 'options', "Options" ) . '</a>
<ul>';
if( $info->visible ) {
    echo '<li><a href="?route=sliders.php&amp;type=unpublish&amp;id=' . $_GET['id'] . '&amp;token=' . $csrf . '">' . t( 'unpublish', "Unpublish" ) . '</a></li>';
} else {
    echo '<li><a href="?route=sliders.php&amp;type=publish&amp;id=' . $_GET['id'] . '&amp;token=' . $csrf . '">' . t( 'publish', "Publish" ) . '</a></li>';
}
echo '<li><a href="?route=sliders.php&amp;action=delete&amp;id=' . $_GET['id'] . '&amp;token=' . $csrf . '" data-delete-msg="' . t( 'delete_msg', "Are you sure that you want to delete this?" ) . '">' . t( 'delete', "Delete" ) . '</a></li>
</ul>
</div>';

}

echo '<a href="?route=sliders.php&amp;action=list" class="btn">' . t( 'sliders_view', "View Sliders" ) . '</a>
</div>';

$subtitle = t( 'sliders_edit_subtitle','edit subtitle' );

if( !empty( $subtitle ) ) {
    echo '<span>' . $subtitle . '</span>';
}

echo '</div>';

if( $slider_exists ) {
    // exit($info->title);

do_action( array( 'after_title_inner_page', 'after_title_sliders_page', 'after_title_edit_sliders_page' ) );

if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset( $_POST['csrf'] ) && check_csrf( $_POST['csrf'], 'sliders_csrf' ) ) {

    if( isset( $_POST['name'] ))
    if( admin\actions::edit_slider( $_GET['id'],
    array(
    'name' => $_POST['name'],
    'publish' => ( isset( $_POST['publish'] ) ? 1 : 0 )
    ) ) ) {

    $info = \query\main::slider_info( $_GET['id'] );

    echo '<div class="a-success">' . t( 'msg_saved', "Saved!" ) . '</div>';
    } else
    echo '<div class="a-error">' . t( 'msg_error', "Error!" ) . '</div>';

} else if( isset( $_GET['type'] ) && isset( $_GET['token'] ) && check_csrf( $_GET['token'], 'sliders_csrf' ) ) {

if( $_GET['type'] == 'delete_image' ) {

    if( isset( $_GET['id'] ) )
    if( admin\actions::delete_slider_image( $_GET['id'] ) ) {
    $info->image = '';
    echo '<div class="a-success">' . t( 'msg_deleted', "Deleted!" ) . '</div>';
    } else
    echo '<div class="a-error">' . t( 'msg_error', "Error!" ) . '</div>';

}

}

$_SESSION['sliders_csrf'] = $csrf;

echo '<div class="form-table">
<form action="#" method="POST" enctype="multipart/form-data">

<div class="row"><span>' . t( 'form_name', "Name" ) . ':</span><div><input type="text" name="name" value="' . $info->title . '" /></div></div>
<div class="row"><span>' . t( 'form_image', "Image" ) . ':</span>

<div>
<div style="display: table; margin-bottom: 2px;"><img src="' . \query\main::slider_avatar( $info->image ) . '" class="avt" alt="" style="display:table-cell;vertical-align:middle;max-width:120px;height:80px;margin: 0 20px 5px 0;" />
<div style="display: table-cell; vertical-align: middle; margin-left: 25px;">';
if( !empty( $info->image ) ) echo '<a href="' . \site\utils::update_uri( '', array( 'type' => 'delete_image', 'token' => $csrf ) ) . '" class="btn" data-delete-msg="' . t( 'delete_msg', "Are you sure that you want to delete this?" ) . '">' . t( 'delete', "Delete" ) . '</a>';
echo '</div>
</div>

<input type="file" name="logo" /></div> </div>


<div class="row"><span>' . t( 'form_publish', "Publish" ) . ':</span><div><input type="checkbox" name="publish" id="publish" ' . ( $info->visible ? ' checked' : '' ) . ' /> <label for="publish"><span></span> ' . t( 'msg_pubslider', "Publish this slider" ) . '</label></div></div>

<input type="hidden" name="csrf" value="' . $csrf . '" />

<div class="twocols">
    <div>
        <button class="btn btn-important">' . t( 'sliders_edit_button', "Edit Slider" ) . '</button>
    </div>
    <div></div>
</div>

</form>

</div>


<div class="title" style="margin-top:40px;">

<h2>' . t( 'sliders_info_title', "Information About This Slider" ) . '</h2>

</div>';

echo '<div class="info-table" style="padding-bottom:20px;">

<div class="row"><span>ID:</span> <div>' . $info->ID . '</div></div>
<div class="row"><span>' . t( 'last_update_by', "Last update by" ) . ':</span> <div>' . ( empty( $info->lastupdate_by_name ) ? '-' : '<a href="?route=users.php&amp;action=edit&amp;id=' . $info->lastupdate_by . '">' . $info->lastupdate_by_name . '</a>' ) . '</div></div>
<div class="row"><span>' . t( 'last_update_on', "Last update on" ) . ':</span> <div>' . $info->last_update . '</div></div>
<div class="row"><span>' . t( 'added_by', "Added by" ) . ':</span> <div>' . ( empty( $info->user_name ) ? '-' : '<a href="?route=users.php&amp;action=edit&amp;id=' . $info->user . '">' . $info->user_name . '</a>' ) . '</div></div>
<div class="row"><span>' . t( 'added_on', "Added on" ) . ':</span> <div>' . $info->date . '</div></div>
</div>';

} else echo '<div class="a-error">' . t( 'invalid_id', "Invalid ID" ) . '</div>';

break;

/** LIST OF SLIDERS */

default:

if( !$GLOBALS['me']->is_admin ) die;

echo '<div class="title">

<h2>' . t( 'sliders_title', "Sliders" ) . '</h2>

<div style="float:right;margin:0 2px 0 0;">
<a href="?route=sliders.php&amp;action=add" class="btn">' . t( 'sliders_add', "Add Slider" ) . '</a>
</div>';

$subtitle = t( 'sliders_subtitle' );

if( !empty( $subtitle ) ) {
    echo '<span>' . $subtitle . '</span>';
}

echo '</div>';

do_action( array( 'after_title_inner_page', 'after_title_sliders_page', 'after_title_list_sliders_page' ) );

if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset( $_POST['csrf'] ) && check_csrf( $_POST['csrf'], 'sliders_csrf' ) ) {

if( isset( $_POST['delete'] ) ) {

    if( isset( $_POST['id'] ) )
    if( admin\actions::delete_slider( array_keys( $_POST['id'] ) ) )
    echo '<div class="a-success">' . t( 'msg_deleted', "Deleted!" ) . '</div>';
    else
    echo '<div class="a-error">' . t( 'msg_error', "Error!" ) . '</div>';

}

} else if( isset( $_GET['action'] ) && isset( $_GET['token'] ) && check_csrf( $_GET['token'], 'sliders_csrf' ) ) {

if( $_GET['action'] == 'delete' ) {

    if( isset( $_GET['id'] ) )
    if( admin\actions::delete_slider( $_GET['id'] ) )
    echo '<div class="a-success">' . t( 'msg_deleted', "Deleted!" ) . '</div>';
    else
    echo '<div class="a-error">' . t( 'msg_error', "Error!" ) . '</div>';

} else if( $_GET['type'] == 'publish' || $_GET['type'] == 'unpublish' ) {

    if( isset( $_GET['id'] ) )
    if( admin\actions::action_slider( $_GET['type'], $_GET['id'] ) )
    echo '<div class="a-success">' . t( 'msg_saved', "Saved!" ) . '</div>';
    else
    echo '<div class="a-error">' . t( 'msg_error', "Error!" ) . '</div>';

}

}

$csrf = $_SESSION['sliders_csrf'] = \site\utils::str_random(10);

echo '<div class="page-toolbar">

<form action="#" method="GET" autocomplete="off">
<input type="hidden" name="route" value="sliders.php" />
<input type="hidden" name="action" value="list" />

' . t( 'order_by', "Order by" ) . ':
<select name="orderby">';
foreach( array( 'date' => t( 'order_date', "Date" ), 'date desc' => t( 'order_date_desc', "Date DESC" ), 'name' => t( 'order_name', "Name" ), 'name desc' => t( 'order_name_desc', "Name DESC" ), 'points' => t( 'order_points', "Points" ), 'points desc' => t( 'order_points_desc', "Points DESC" ) ) as $k => $v )echo '<option value="' . $k . '"' . (isset( $_GET['orderby'] ) && urldecode( $_GET['orderby'] ) == $k || !isset( $_GET['orderby'] ) && $k == 'date desc' ? ' selected' : '') . '>' . $v . '</option>';
echo '</select>';

if( isset( $_GET['search'] ) ) {
echo '<input type="hidden" name="search" value="' . esc_html( $_GET['search'] ) . '" />';
}

echo ' <button class="btn">' . t( 'view', "View" ) . '</button>

</form>

<form action="#" method="GET" autocomplete="off">
<input type="hidden" name="route" value="sliders.php" />
<input type="hidden" name="action" value="list" />';

if( isset( $_GET['orderby'] ) ) {
echo '<input type="hidden" name="orderby" value="' . esc_html( $_GET['orderby'] ) . '" />';
}

echo '<input type="search" name="search" value="' . (isset( $_GET['search'] ) ? esc_html( $_GET['search'] ) : '') . '" placeholder="' . t( 'sliders_search_input', "Search sliders" ) . '" />
<button class="btn">' . t( 'search', "Search" ) . '</button>
</form>

</div>';

$p = \query\main::have_sliders( $options = array( 'per_page' => 10, 'show' => 'all', 'search' => (isset( $_GET['search'] ) ? urldecode( $_GET['search'] ) : '') ) );

echo '<div class="results">' . ( (int) $p['results'] === 1 ? sprintf( t( 'result', "<b>%s</b> result" ), $p['results'] ) : sprintf( t( 'results', "<b>%s</b> results" ), $p['results'] ) );
if( !empty( $_GET['search'] ) ) echo ' / <a href="?route=sliders.php&amp;action=list">' . t( 'reset_view', "Reset view" ) . '</a>';
echo '</div>';

if( $p['results'] ) {

echo '<form action="?route=sliders.php&amp;action=list" method="POST">

<ul class="elements-list">

<li class="head"><input type="checkbox" id="selectall" data-checkall /> <label for="selectall"><span></span> ' . t( 'name', "Name" ) . '</label></li>

<div class="bulk_options">
    <button class="btn" name="delete" data-delete-msg="' . t( 'delete_msg', "Are you sure that you want to delete this?" ) . '">' . t( 'delete_all', "Delete All" ) . '</button>
</div>';

foreach( \query\main::while_sliders( array_merge( array( 'page' => $p['page'], 'orderby' => (isset( $_GET['orderby'] ) ? urldecode( $_GET['orderby'] ) : 'date desc') ), $options ) ) as $item ) {

    $links = array();

    $links['edit'] = '<a href="?route=sliders.php&amp;action=edit&amp;id=' . $item->ID . '">' . t( 'edit', "Edit" ) . '</a>';
    $links['publish'] = '<a href="' . \site\utils::update_uri( '', array( 'type' => ( !$item->visible ? 'publish' : 'unpublish' ), 'id' => $item->ID, 'token' => $csrf ) ) . '">' . ( !$item->visible ? t( 'publish', "Publish" ) : t( 'unpublish', "Unpublish" ) ) . '</a>';
    $links['delete'] = '<a href="' . \site\utils::update_uri( '', array( 'action' => 'delete', 'id' => $item->ID, 'token' => $csrf ) ) . '" data-delete-msg="' . t( 'delete_msg', "Are you sure that you want to delete this?" ) . '">' . t( 'delete', "Delete" ) . '</a>';

    echo get_list_type( 'slider', $item, $links );

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

} else echo '<div class="a-alert">' . t( 'no_sliders_yet', "No sliders yet." ) . '</div>';

break;

}