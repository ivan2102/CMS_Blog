<?php require_once("Includes/DB.php"); ?>
<?php

function Redirect_to($New_Location) {

    header("Location:" .$New_Location);
    exit;
}


function TotalPosts(){

   global $ConnectingDB;
   $query = "SELECT COUNT(*) FROM posts";
   $stmt = $ConnectingDB->query($query);
   $TotalRows = $stmt->fetch();
   $TotalPosts = array_shift($TotalRows);
   echo $TotalPosts;
}

function TotalCategory() {

   global $ConnectingDB;
   $query = "SELECT COUNT(*) FROM category";
   $stmt = $ConnectingDB->query($query);
   $TotalRows = $stmt->fetch();
   $TotalCategory = array_shift($TotalRows);
   echo $TotalCategory;
}

function TotalAdmin(){

   global $ConnectingDB;
   $query = "SELECT COUNT(*) FROM admin";
   $stmt = $ConnectingDB->query($query);
   $TotalRows = $stmt->fetch();
   $TotalAdmin = array_shift($TotalRows);
   echo $TotalAdmin;
}

function TotalComments(){

   global $ConnectingDB;
   $query = "SELECT COUNT(*) FROM comments";
   $stmt = $ConnectingDB->query($query);
   $TotalRows = $stmt->fetch();
   $TotalComments = array_shift($TotalRows);
   echo $TotalComments;
}


function ApproveCommentsAccordingtoPost($post_id){

   global $ConnectingDB;
   $queryApprove = "SELECT COUNT(*) FROM comments WHERE post_id='$post_id' AND comment_status='ON'";
   $stmtApprove = $ConnectingDB->query($queryApprove);
   $RowsTotal = $stmtApprove->fetch();
   $Total = array_shift($RowsTotal);
   return $Total;
}


function DisApproveCommentsAccordingtoPost($post_id){

   global $ConnectingDB;
         $queryDisApprove = "SELECT COUNT(*) FROM comments WHERE post_id='$post_id' AND comment_status='OFF'";
         $stmtDisApprove = $ConnectingDB->query($queryDisApprove);
         $RowsTotal = $stmtDisApprove->fetch();
         $Total = array_shift($RowsTotal);
         return $Total;
}

//function CheckUsername($admin_username) {

  // global $ConnectingDB;
  // $query = "SELECT admin_username FROM admin WHERE admin_username = $admin_username ";
  // $stmt = $ConnectingDB->prepare($query);
  // $admin_username = $row['admin_username'];
  // $stmt->execute();
  // $Result = $stmt->rowcount();
  // if($Result == 1){
   //   return true;
  // }else {
     // return false;
  // }
//}





       // function Login_Attempt($admin_username, $admin_password) {
       
         //$Result = $stmt->rowcount();
         //if($Result == 1){
            //return $Found_Account = $stmt->fetch();
        // }else {
           // return null;
        // }


      //  }
       


//function query($sql) {

  //  global $connection;

   // return mysqli_query($connection, $sql);
//}


//function confirm($result) {

   // global $connection;

    //if(!'result') {

      //  die("QUERY_FAILED" . mysqli_error($connection));
   // }
//}


//function escape_string($string) {

   // global $connection;

   // return mysqli_real_escape_string($connection, $string);
//}


//function fetch_array($result) {

   // return mysqli_fetch_array($result);
//}

?>