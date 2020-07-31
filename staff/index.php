<?php 
ini_set("display_errors", "1");
error_reporting(E_ALL);
require_once ('../../private/initialize.php');
require_login();

// Here you cannot use "PRIVATE_PATH"
//because this is where initialize.php is defined.
//so this is the place where you still use ../.. to get everything located correctly.

//unset($_SESSION['admin_id']);

?>

<?php $page_title = 'Staff Menu'; ?>
<?php include (SHARED_PATH .'/staff_header.php'); ?>

<div id="content">
    <div id="main-menu">
        <h2>Main Menu</h2>
        <ul>
            <li><a href="<?php echo url_for('/staff/subjects/index.php');
             ?>">Subjects</a>
            </li>
            <li><a href="<?php echo url_for('/staff/pages/index.php');
            
             ?>">Pages</a>
            </li>
            <li><a href="<?php echo url_for('/staff/admins/index.php');?>">Admins</a> </li>
        </ul>
    </div>
</div>

<?php include (SHARED_PATH .'/staff_footer.php');?>