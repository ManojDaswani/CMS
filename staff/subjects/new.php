<?php

//! This is 2 page form submission.
//! The new.php is going to submit to create.php

require_once '../../../private/initialize.php';
require_login();


    if(is_post_request()){
    $subject = [];
    $subject["position"] = $subject_count;
    $subject['menu_name'] = $_POST['menu_name'] ?? '';
    $subject['position'] = $_POST['position'] ??'' ;
    $subject['visible'] = $_POST['visible'] ?? '';

    $result = insert_subject($subject);
    if($result === true){
    $new_id = mysqli_insert_id($db);
    $_SESSION['message'] = 'The subject was created successfully.';
    redirect_to(url_for('/staff/subjects/show.php?id=' . $new_id));
    } else {
    $errors = $result;
    }    
    }else{
    $subject = [];
    $subject['menu_name'] = '';
    $subject['position'] = '';
    $subject['visible'] = '';

    $subject_set   = find_all_subjects();
    $subject_count = mysqli_num_rows($subject_set) + 1;
    mysqli_free_result($subject_set);
  
}


// ini_set("display_errors", "1");
// error_reporting(E_ALL);
// require_once '../../../private/initialize.php';
// $test = $_GET['test'] ?? '';
// if ($test == '404') {error_404();
// } elseif ($test == '500') {error_500();
// } elseif ($test == 'redirect') {
//     redirect_to(url_for('/staff/subjects/index.php'));
// }


?>

<?php $page_title = 'Create Subject';?>
<?php include SHARED_PATH . '/staff_header.php';?>

<div id="content">
    <a class="back-link" href="<?php echo url_for('/staff/subjects/index.php'); ?>">&laquo; Back to
        List</a>

    <div class="Create Subject">
        <h1>Create Subject</h1>

        <form action="<?php echo url_for('/staff/subjects/create.php'); ?>" method="post">


            <dl>
                <label>
                    <dt>Menu Name:</dt>
                    <dd><input type="text" name="menu_name" value="<?php echo h($subject['menu_name']); ?>" /></dd>
                </label>
            </dl>
            <dl><label>
                    <dt>Position</dt>
                    <dd>
                        <select name="position">
                            <?php
    for ($i = 0; $i <= $subject_count; $i++) {
    echo "<option value=\"{$i}\"";
    if ($subject["position"] == $i) {
        echo "selected";
    }
    echo ">{$i}</option>";
    }

    //Curly braces {} can be used differently. With a single integer, {n} means "match exactly n occurrences of the preceding expression", with one integer and a comma,  {n,} means "match n or more occurrences of the preceding expression", and with two comma-separated integers {n,m} means "match the previous character if it occurs at least n times, but no more than m times".
    ?>
                        </select>
                    </dd>
                </label>
            </dl>
            <dl>
                <label>
                    <dt>Visible</dt>
                    <dd>
                        <input type="hidden" name="visible" value="0" />
                        <input type="checkbox" name="visible" value="1" />
                    </dd>
                </label>
            </dl>
            <div id="operations">
                <input type="submit" value="Create Subject" />
            </div>
        </form>
    </div>
</div>

<?php include SHARED_PATH . '/staff_footer.php';?>