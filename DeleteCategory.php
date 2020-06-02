<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>

<?php
//$id = '';
if(isset($_GET['id'])){
$id = $_GET['id'];
    global $ConnectingDB;
    $query = "DELETE FROM category WHERE category_id='$id'";
    $Execute = $ConnectingDB->query($query);

    if($Execute) {

        $_SESSION['SuccessMessage'] = "Category Deleted Successfully";
        Redirect_to("Categories.php");
    } else{

        $_SESSION['ErrorMessage'] = "Something went wrong. Try again!";
        Redirect_to("Categories.php");
    }
}



?>