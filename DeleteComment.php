<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>

<?php
//$id = '';
if(isset($_GET['id'])){
$id = $_GET['id'];
    global $ConnectingDB;
    $query = "DELETE FROM comments WHERE comment_id='$id'";
    $Execute = $ConnectingDB->query($query);

    if($Execute) {

        $_SESSION['SuccessMessage'] = "Comment Deleted Successfully";
        Redirect_to("Comments.php");
    } else{

        $_SESSION['ErrorMessage'] = "Something went wrong. Try again!";
        Redirect_to("Comments.php");
    }
}



?>