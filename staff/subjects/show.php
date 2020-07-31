<?php
require_once '../../../private/initialize.php';
require_login();

error_reporting(E_ALL);
ini_set("display_errors", "1");
ini_set('display_startup_errors', true);

// $id = isset($_GET['id']) ? $_GET['id'] : '1'; //Older PHP < 7.0
$id = $_GET['id'] ?? '1'; //Php> 7.0

$subject = find_subject_by_id($id); //! setting up associative array

//! the below 4 lines of code has been made a function = find_subject_by_id()
// $sql = "SELECT * FROM subjects ";
// $sql .="WHERE id='" . $id . "'";
// $result = mysqli_query($db, $sql); // mysqli_query (needs 2 args- $db (handle) & $query)
// confirm_result_set($result); //for error checking use this line

//$subject = mysqli_fetch_assoc($result);
/*this will get our subject --mysqli_fetch_assoc    returns the result back as an associative array. You get an array that looks like
[
'id' => '1',
'menu_name' => 'About Globe Bank',
'position' => '1',
'visible' => '1'
]
 */
// !This statement is only finding one object which is '$id' and we are not looping
//! $subject = mysqli_fetch_assoc($result);
//! we are specifying single subject which is the id ----$sql = "SELECT * FROM subjects ";
//! $sql .= "WHERE id='" . $id . "'";
//! and we are able to fetch the association one time NOT inside a loop by this statement >>
//! $subject = mysqli_fetch_assoc($result);

//! and free the $result immediately by this line >>mysqli_free_result($result);

//mysqli_free_result($result);

?>
<?php $page_title = 'Show Subject';?>
<?php include SHARED_PATH . '/staff_header.php';?>

<?php
//! dynamic data coming from database or user or from cookies you need to escape it first
//! to ensure it doesnt have powerful html characters in it.
//! Here h is an abbreviation of htmlspecialchars.
?>
<?php
//* u is for = urlencode($input)- see function.php
?>
<div id="content">

    <a class="back-link" href="<?php echo url_for('staff/subjects/index.php'); ?>">&laquo; Back to list</a>

    <div class="subject show">

        <h1>Subject: <?php echo h($subject['menu_name']); ?></h1>

        <div class="attributes">
            <dl>
                <dt>Menu Name </dt>
                <dd><?php echo h($subject['menu_name']); ?></dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd><?php echo h($subject['position']); ?></dd>
            </dl>
            <dl>
                <dt>Visible</dt>
                <dd><?php echo $subject['visible'] == '1' ? 'true' : 'false'; ?></dd>
            </dl>

        </div>
    </div>

</div>
<?php include SHARED_PATH . '/staff_footer.php';?>