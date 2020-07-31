<?php

require_once('../../../private/initialize.php');
require_login();

ini_set("display_errors", "1");
error_reporting(E_ALL);


$page_title = 'Page';
include SHARED_PATH . '/staff_header.php';


if(is_post_request()){
$page['menu_name'] = $_POST['menu_name']??'';
$page['position'] = $POST['position']??'';
$page['visible'] = $POST['visible']??'';
$page['content'] = $_POST['content']??'';
$result = insert_page($page);
$new_id = mysqli_insert_id($db);

redirect_to(url_for('/staff/pages/show.php?id=' . $new_id));

} else {
    redirect_to(url_for('./staff/pages/new.php'));
}

include (SHARED_PATH .'/staff_footer.php');
?>