<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
require_once('../../../private/initialize.php');
require_login();

?>

<?php 
// placeholders for the different pages
// this is a stand-in (substitute) for a database in the future.

//! Hard coded Data
// $pages = [ 
//         [ 'id'=>'1' , 'position'=>'1','visible'=> '1', 'title'=>'John of arc', 'author' => 'Arther Messenger' ],
//         [ 'id'=>'2' , 'position'=>'2','visible'=> '1', 'title'=>'Terminator', 'author' => 'Michal Jordan' ],
//         [ 'id'=>'3' , 'position'=>'3','visible'=> '1', 'title'=>'Broken Arrow', 'author' => 'Michelle Pfeifer' ],
//         [ 'id'=>'4' , 'position'=>'4','visible'=> '1', 'title'=>'Alice in Wonderland', 'author' => 'Sandra Bullock' ],
// ]; 

//! Getting Data from the database

$page_set = find_all_pages();

?>
<?php $page_title = 'Pages'; ?>
<?php include (SHARED_PATH . '/staff_header.php');?>

<div id="content">
    <div class="pages listing">
        <h1>Pages</h1>

        <div class="actions">
            <a class="action" href="<?php echo url_for('/staff/pages/new.php');?>">Create New Pages </a>
        </div>

        <table class="list">
            <tr>
                <th>Id</th>
                <th>Subject</th>
                <th>Position</th>
                <th>Visible</th>
                <th>Name</th>
                <th>&nbsp;</th>
                <th>Edit visible off can hide this</th>
                <th>&nbsp;</th>
                <!--&nbsp; non-breaking space  -->
            </tr>
            <?php while($page = mysqli_fetch_assoc($page_set)){ ?>
            <?php $subject = find_subject_by_id($page['subject_id']);?>
            <tr>
                <td><?php echo h($page['id']);?></td>
                <td><?php echo h($subject['menu_name']);?></td>
                <td><?php echo h($page['position']); ?></td>
                <td><?php echo $page['visible'] == 1 ? 'true' : 'false';?></td>
                <td><?php echo h($page['menu_name']);?></td>



                <td><a class="action" href="<?php echo url_for('/staff/pages/show.php?id='.h(u($page['id'])))?>">View
                </td>
                <td><a class="action"
                        href="<?php echo url_for('/staff/pages/edit.php?id=' .h(u($page['id'])));?>">Edit</a>
                </td>
                <td><a class="action"
                        href="<?php echo url_for('/staff/pages/delete.php?id=' . h(u($page['id']))); ?>">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>
        <?php mysqli_free_result($page_set);?>
    </div>
</div>


<?php include SHARED_PATH . '/staff_footer.php';?>