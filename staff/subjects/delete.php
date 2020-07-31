<?php require_once '../../../private/initialize.php';

require_login();

ini_set("display_errors", "1");
error_reporting(E_ALL);


if (!isset($_GET['id'])) {

    redirect_to(url_for('staff/subjects.index.php'));
}

$id = $_GET['id'];

// $subject = find_subject_by_id($id); //no need to find the subject if we are deleting it also keep this to see first if the subject is in the database first.

if (is_post_request()) {
    $result = delete_subject($id);
    
        $_SESSION['message'] = 'The subject was deleted successfully.';
        redirect_to(url_for('/staff/subjects/index.php'));
    } else {
        // only finds the subject if it is not a post request
        $subject = find_subject_by_id($id);
    }

?>

<?php $page_title = 'Delete Subject';?>
<?php include SHARED_PATH . '/staff_header.php';?>

<div id="content">
    <a class="back-link" href="<?php echo url_for('/staff/subjects/index.php'); ?>">&laquo;Back to list</a>
    <div class="subject delete">
        <h1>Delete a subject</h1>
        <p>Are you sure you want to delete the subject?</p>
        <p class="item"><?php echo h($subject['menu_name']); ?></p>

        <form action="<?php echo url_for('/staff/subjects/delete.php?id=' . h(u($subject['id']))); ?>" method="post">
            <div id="operations">
                <input type="submit" name="commit" value="Delete Subject" />
            </div>
        </form>
    </div>
</div>

<?php include SHARED_PATH . '/staff_footer.php';