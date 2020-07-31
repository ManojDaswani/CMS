<?php
// Create.php is just the form processing page.
// it does not display any HTML.
// All it does is if it is a POST request, then process the form, if it is NOT-send the person back to the form.
//! This is 2 page form submission. 
//! The new.php is going to submit to create.php

require_once ('../../../private/initialize.php');
require_login();

ini_set("display_errors", "1");
error_reporting(E_ALL);

$page_title = 'Subjects';
include SHARED_PATH . '/staff_header.php';

if (is_post_request()) {
//Handle form value sent by new.php

$subject = [];
//! this is how we set up the variable and initialize them.
$subject['menu_name'] = $_POST['menu_name'] ?? ''; //access this $_POST super global and asks for the values that have been sent in. if no value sent then set the default value '';
$subject['position'] = $_POST['position'] ?? ''; //for menu name, post and visible & assigns them to local variable
$subject['visible'] = $_POST['visible'] ?? '';

$result = insert_subject($subject); //this function is declared in query_function.php
$new_id = mysqli_insert_id($db);
redirect_to(url_for('/staff/subjects/show.php?id=' . $new_id)); //show.php needs to know the id, which is why we went and found that new_id (above line)-
// so now we can say -go to the show page for this to see the details with the id.
// we could also redirect this <<Back to the list>>
//! this is to show us the id

} else {
redirect_to(url_for('/staff/subjects/new.php'));
}

include SHARED_PATH . '/staff_footer.php';

?>