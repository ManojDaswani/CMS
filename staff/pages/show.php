<?php
error_reporting(E_ALL);
ini_set("display_errors", "1");
ini_set('display_startup_errors', true);

require_once('../../../private/initialize.php');
require_login();

?>


<?php 

    $id = $_GET['id'] ?? '1';

// $id = isset($_GET['id']) ? $_GET['id'] : '1'; //In older PHP < 7.0 $id=$_GET['id'] ?? '1' ; // PHP> 7.0

    $page = find_page_by_id($id); //pass in the id and get back assoc array ready for me to use -
    //this is how you find single page using its 'id'

?>

<?php $page_title = 'Show Page';?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a>

    <div class="page show">

        <h1>Page: <?php echo h($page['menu_name']); ?></h1>

        <div class="attributes">

            <!-- Instead of displaying the subject_id, that foreign key, I simply ask for find_subject_by_id and I get back an associative array and I can then display it's menu name (line 37).
             -->

            <?php $subject = find_subject_by_id($page['subject_id']);?>
            <dl>
                <dt>Subject</dt>
                <dd><?php echo h($subject['menu_name']); ?>
                </dd>
            </dl>
            <dl>
                <dt>Menu Name </dt>
                <dd><?php echo h($page['menu_name']); ?>
                </dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd><?php echo h($page['position']); ?></dd>
            </dl>
            <dl>
                <dt>Visible</dt>
                <dd><?php echo $page['visible']== '1' ? 'true' : 'false'; ?></dd>
            </dl>

            <dl>
                <dt>Content</dt>
                <dd><?php echo h($page['content']);?></dd>
            </dl>
        </div>
    </div>
</div>

<?php include SHARED_PATH . '/staff_footer.php';?>