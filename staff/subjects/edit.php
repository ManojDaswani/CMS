<?php

//! THIS IS THE CODE FOR SINGLE PAGE FORM PROCESSING

ini_set("display_errors", "1");
error_reporting(E_ALL);

require_once ('../../../private/initialize.php');

require_login();

if(!isset($_GET['id'])) {
    redirect_to(url_for('/staff/subjects/index.php'));
}

$id= $_GET['id'];

// $menu_name = ''; //$menu_name is intialized to just an empty string. They are default value
// $position  = ''; // $position is initialized to an empty string.They are default value
// $visible   = ''; //$visible is initialized to an empty string.They are default value

if (is_post_request()) {
    //Handle form value sent by new.php

    //! A. getting the form value that are submitted here at $_POST['menu_name]

    $subject = [];
    $subject['id'] = $id;
    $subject['menu_name'] = $_POST['menu_name'] ?? ''; //access this super global ($_POST) and asks for the values that have been sent in.
    $subject['position']  = $_POST['position'] ?? ''; //for menu name, position and visible & assigns them to local variable
    $subject['visible']   = $_POST['visible'] ?? '';

    //! C. Somewhere between A & B we need to perform validation. And we need to validate ALL the time. So we could put validation inside update function so that it always run.

    $result = update_subject($subject); //! B.  Right here i am calling  "update_subject" / performing the update right here.
    if ($result === true) {
        $_SESSION['message'] = 'The subject was updated successfully.';
        redirect_to(url_for('/staff/subjects/show.php?id=' . $id));
    }else{
        $errors = $result;
        var_dump($errors); // errors shown on the screen
    }

    // echo "Form parameters<br/>";
    // echo "Menu name: " . $menu_name . "<br />"; //PHPs that displays those back to us on the page
    // echo "Position : " . $position . "<br/>"; // so we can see what they look like.
    // echo "Visible : " . $visible . "<br/>"; //it simply to read value submitted to this page by a form.
}else{
    
    $subject = find_subject_by_id($id);
    
    $subject_set = find_all_subjects();
    $subject_count = mysqli_num_rows($subject_set);
    mysqli_free_result($subject_set);
    
}
?>

<?php $page_title = 'Edit Subject';?>
<?php include SHARED_PATH . '/staff_header.php';?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/staff/subjects/index.php'); ?>">&laquo; Back to List</a>

    <div class="subject edit">
        <h1>Edit Subject</h1>

        <?php echo display_errors($errors=array()); ?>

        <form action="<?php echo url_for('/staff/subjects/edit.php?id=' . h(u($id))); ?>" method="post">
            <dl>
                <b>
                    <dt><label for="menu_name_id">Menu Name</label></dt>
                    <input type="text" id="menu_name_id" name="menu_name"
                        value="<?php echo h($subject['menu_name']); ?>" />

                </b>
            </dl>
            <dl><label>
                    <dt>Position</dt>
                    <dd>
                        <select name="position">

                            <?php 
                            for($i=0; $i <= $subject_count; $i++){
                                echo "<option value=\"{$i}\"";
                                if($subject["position"]==$i){
                                   echo  "selected";
                                }
                                echo ">{$i}</option>";
                            }

                            //Curly braces {} can be used differently. With a single integer, {n} means "match exactly n occurrences of the preceding expression", with one integer and a comma,  {n,} means "match n or more occurrences of the preceding expression", and with two comma-separated integers {n,m} means "match the previous character if it occurs at least n times, but no more than m times".
                            ?>
                        </select>
                        <!-- <select name="position">
                            <option value="1" <?php if($subject['position'] == "1") { echo " selected"; } ?>>1</option>
                            <option value="2" <?php if($subject['position'] == "2") { echo " selected"; } ?>>2</option>
                            <option value="3" <?php if($subject['position'] == "3") { echo " selected"; } ?>>3</option>
                            <option value="4" <?php if($subject['position'] == "4") { echo " selected"; } ?>>4</option>
                        </select> -->
                    </dd>
                </label>
            </dl>
            <dl><label>
                    <dt>Visible</dt>
                    <dd>
                        <input type="hidden" name="visible" value="0" />
                        <input type="checkbox" name="visible" value="1"
                            <?php if($subject['visible'] == "1") { echo " checked"; } ?> />
                    </dd>
                </label>
            </dl>
            <div id="operations">
                <input type="submit" value="Edit Subject" />
            </div>
        </form>

    </div>

</div>

<?php include SHARED_PATH . '/staff_footer.php' ;?>