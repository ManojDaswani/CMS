<?php

//*TODO Step 1 new.php displays a blank form by default, but if it is a POST request it will submit to the DB
ini_set("display_errors", "1");
error_reporting(E_ALL);
require_once ('../../../private/initialize.php');
require_login();


// Handle form values sent by new.php

if (is_post_request()) { //*TODO Step 6 on this>>once we submit the form its a post request
    // if it is a post request, get those values and display them for now -on top of the page via echo.
    //!Eventually we would submit those values to the database if it is a post request
    // if it is not a POST request, then it just displays the form.
    // *TODO Step 7 on this grab those form values coming from the below forms and put them in associative array
    $page = [];

    $page['subject_id'] = $_POST['subject_id'] ?? '';
    $page['menu_name'] = $_POST['menu_name'] ?? '';
    $page['position']  = $_POST['position'] ?? '';
    $page['visible']   = $_POST['visible'] ?? '';
    $page['content']    = $_POST['content'] ?? '';
    // *TODO Step 8. We gonna pass all of that into insert_page, $result should be true if succeeds
    $result = insert_page($page);
    if($result === true){
    //*TODO Step 9. will then ask for the last id thru mysqli_insert_id()
    $new_id = mysqli_insert_id($db);
    
    $_SESSION['message'] = 'The page was created successfully.';
    
    //*TODO Step 10 - will then redirect the user back to the show page using that $new_id
    redirect_to(url_for('/staff/pages/show.php?id=' .$new_id)); 
    } else {
    $errors = $result;
  }
    
} else { // *TODO step 2 - if it is NOT a post request
    $page = []; // *TODO step 3 Initialize a new associative array called $page and assign default values for different attributes
    $page['subject_id'] = '';
    $page['menu_name'] = '';
    $page['position'] = '';
    $page['visible'] = '';
    $page['content'] = '';

    $page_set = find_all_pages(); // *TODO step 4. I am also going to find number of pages
    $page_count = mysqli_num_rows($page_set) +1; // *TODO step 5. will add +1 to that because we are adding a new  page
    mysqli_free_result($page_set);// *TODO step5 - then we free up that result

}
?>

<?php $page_title = 'Create Page';?>
<?php include SHARED_PATH . '/staff_header.php';?>

<id="content">

    <a class="back-link" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a>


    <div class="Create Page">
        <h1>Create Page</h1>
        <form action="<?php echo url_for('/staff/pages/new.php'); ?>" method="post">
            <!-- page submits to new.php thru <form action <dl> -->
            <dl>
                <dt>Subject </dt>
                <dd><select name="subject_id">
                        <?php $subject_set = find_all_subjects();
                        while($subject = mysqli_fetch_assoc($subject_set)){
                            echo "<option value=\"" .h($subject['id']) ."\"";
                            if($page["subject_id"]== $subject['id']){//current page "subject_id"== $subject_id - if it is then mark it as "selected"
                                echo " selected";
                            }
                            echo ">" .h($subject['menu_name']) . "</option>";
                        }
                        mysqli_free_result($subject_set);
                        ?>
                    </select>
                </dd>
            </dl>

            <dl>
                <label>
                    <dt>Menu Name:</dt>
                    <dd><input type="text" name="menu_name" value="<?php echo h($page['menu_name']); ?>" /></dd>
                </label>
            </dl>
            <dl><label>
                    <dt>Position</dt>
                    <dd>
                        <select name="position">
                            <?php
                    for ($i = 1; $i <= $page_count; $i++) {
                        echo "<option value=\"{$i}\"";
                        if ($page["position"] == $i) {
                            echo " selected";
                        }
                        echo ">{$i}</option>";
                    }
                    ?>
                        </select>
                    </dd>
                </label>
            </dl>

            <dl>
                <dt>Visible</dt>
                <dd>
                    <input type="hidden" name="visible" value="0" />
                    <input type="checkbox" name="visible" value="1"
                        <?php if($page['subject_id'] == "1") { echo " checked"; } ?> />
                    <!-- if echo checkbox is equal to 1, it will 'echo "checked"'' -->
                </dd>
            </dl>

            <dl>
                <dt>Content</dt>
                <dd>
                    <textarea name="content" cols="60" rows="10"><?php echo h($page['content']); ?></textarea>
                </dd>
            </dl>

            <div id="operations">
                <input type="submit" value="Create Page" />
            </div>
        </form>
    </div>
    </div>
    <?php include SHARED_PATH . '/staff_footer.php';