<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>

<?php
if(isset($_GET['id'])){

    $id = $_GET['id'];
    global $ConnectingDB;
    $Admin = "Ivan";
    $query = "UPDATE comments SET comment_status='OFF', comm_approved_by='$Admin' WHERE comment_id='$id'";
    $Execute = $ConnectingDB->query($query);

    if($Execute) {

        $_SESSION['SuccessMessage'] = "Comment Dis-Approved Successfully";
        Redirect_to("Comments.php");
    } else{

        $_SESSION['ErrorMessage'] = "Something went wrong. Try again!";
        Redirect_to("Comments.php");
    }
}



?>