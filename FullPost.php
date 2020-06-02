<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>

<?php 
$id = ''; 
if( isset( $_GET['id'])) {
    $id = $_GET['id']; 
} 
?>

<?php 

if(isset($_POST['submit'])) {

$comment_name = $_POST['comment_name'];
$comment_email = $_POST['comment_email'];
$comment = $_POST['comment'];
$comm_approved_by ="Pending";
$comment_status = "OFF";


date_default_timezone_set("Europe/Belgrade");
$CurrentTime = time();
$DateTime = strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);

if(empty($comment_name) || empty($comment_email) || empty($comment)) {

    $_SESSION['ErrorMessage'] = "All fields must be filled out";
    Redirect_to("FullPost.php?id={$id}");
} elseif (strlen($comment) > 255){

    $_SESSION['ErrorMessage'] = "Comment length should be less than 255 characters";
    Redirect_to("FullPost.php?id={$id}");
} 
//Query to insert comment in DB when everything is fine
$query = ("INSERT INTO comments(comment_datetime,comment_name,comment_email,comment,comm_approved_by,comment_status,post_id) VALUES('{$DateTime}' ,'{$comment_name}' ,'{$comment_email}' ,'{$comment}', '{$comm_approved_by}', '{$comment_status}','{$id}') ");
$stmt = $ConnectingDB->prepare($query);
$DateTime = $row['comment_datetime'];
$comment_name = $row['comment_name'];
$comment_email = $row['comment_email'];
$comment = $row['comment'];
$comm_approved_by = $row['comm_aproved_by'];
$comment_status = $row['comment_status'];

$Execute=$stmt->execute();

if($Execute) {
    $_SESSION['SuccessMessage'] = "Comment Submitted Successfully";
    Redirect_to("FullPost.php?id={$id}");
}else {
   $_SESSION['ErrorMessage'] = "Something went wrong. Try again!";
    Redirect_to("FullPost.php?id={$id}");
}

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Blog Page</title>
</head>

<body>
    <!--NAVBAR-->
    <div style="height: 10px; background: #27aae1;"></div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a href="#" class="navbar-brand">IVAN2102.COM</a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarcollapseCMS">
                <ul class="navbar-nav mr-auto">
                    >
                    <li class="nav-item">
                        <a href="Blog.php" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">About us</a>
                    </li>
                    <li class="nav-item">
                        <a href="Blog.php" class="nav-link">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Contact us</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Features</a>
                    </li>
                   
                </ul>

                <ul class="navbar-nav ml-auto">
                    <form class="form-inline d-none d-sm-block" action="Blog.php">
                    <div class="form-group">
                        <input class="form-control" mr-2 type="text" name="search" placeholder="Search here" value="">
                        <button type="button" class="btn btn-primary" name="search_button">Go</button>
                    </div>
                    </form>
                </ul>
            </div>
        </div>
    </nav>
    <div style="height: 10px; background: #27aae1;"></div>
    <!--END OF NAVIGATION BAR-->

    <!--HEADER-->
   <div class="container">
       <div class="row mt-4">
           <div class="col-sm-8">
               <h1>The Complete Responsive CMS Blog</h1>
               <h1 class="lead">The Complete blog by using PHP by Ivan Nesic</h1>
               <?php 
               
               echo ErrorMessage();
               echo SuccessMessage();
               ?>

               <?php  
                global $ConnectingDB;
               if(isset($_GET['search_button'])) {
               $search = $_GET['search'];

               $query ="SELECT * FROM posts WHERE post_datetime LIKE :search OR post_title LIKE :search OR post_category LIKE :search OR post_content LIKE :search";
               $stmt = $ConnectingDB->prepare($query);
               $stmt->bindValue(':search', '%'.$search.'%');
               $stmt->execute();
               }
              else {
                
                $query = "SELECT * FROM posts";
                $stmt = $ConnectingDB->query($query);
              }  
               
               
               while($row = $stmt->fetch()) {

               $post_id = $row['post_id'];
               $DateTime = $row['post_datetime'];
               $post_title = $row['post_title'];
               $post_category = $row['post_category'];
               $post_author = $row['post_author'];
               $post_image = $row['post_image'];
               $post_content = $row['post_content'];


                ?>
               <div class="card">
               <img src="Upload/<?php echo $post_image; ?>" style="max-height: 450px;" class="img-fluid card-img-top" />
               <div class="card-body">
               <h4 class="card-title"><?php echo $post_title; ?></h4>
               <small class="text-muted">Written by <?php echo $post_author;  ?> On <?php echo $DateTime; ?></small>

               <hr>
               <p class="card-text"><?php  echo $post_content; ?></p>
               <a href="Blog.php" style="float:right;">
               <span class="btn btn-info">Back >></span>
               </a>
               </div>
               
               </div>

             <?php  } ?>
             <!--Fetching existing comment START-->

             <?php 
             global $ConnectingDB;
             $query = "SELECT * FROM comments WHERE post_id='$id' AND comment_status='ON'";
             $stmt = $ConnectingDB->query($query);
             while ($row = $stmt->fetch()) {
               $DateTime = $row['comment_datetime'];
               $comment_name = $row['comment_name'];
               $comment = $row['comment'];

              ?>

             
             <div>
             <span class="FieldInfo">Comments</span>
             <div class="media comment-block">
             <img style="width:50px;" class="d-block img-fluid" src="images/index.jpg" alt="">
             <div class="media-body ml-2">
             <h6 class="lead"><?php echo $comment_name; ?></h6>
             <p class="small"><?php echo $DateTime; ?></p>
             <p><?php echo $comment; ?></p>
             </div>
             </div>
             </div>

            <?php } ?>
             
             <!--Fetching existing comment END-->

             <!--COMMENTS PART START-->
             <div class="">
            <form action="FullPost.php?id=<?php echo $id; ?>" method="post">
            <div class="card mb-3">
            <div class="card-header">
            <h5 class="FieldInfo">Share your thoughts about this post</h5>
            </div>
            <div class="card-body">
            <div class="form-group">
            <div class="input-group">
            <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
            
            </div>
            <input class="form-control" type="text" name="comment_name" placeholder="Name" value="">
            </div>

            </div>

            <div class="form-group">
            <div class="input-group">
            <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            
            </div>
            <input class="form-control" type="email" name="comment_email" placeholder="Email" value="">
            </div>

            </div>

            <div class="form-group">
            
            <textarea name="comment"  class="form-control" id="" cols="80" rows="6"></textarea>
            </div>

            <div class="">
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </div>
            
            </div>
            
            </div>
            
            
            
            </form>
             
             </div>

             </div>

             <!--COMMENTS PART END-->


           <!-- The Side Area Start -->
           <div class="col-sm-4">
           <div class="card mt-4">
           <div class="card-body">
           <img src="images/index.jpg" class="d-block img-fluid mb-3" alt="">
           <div class="text-center">
           
What Is A Blog And How Does It Work?
Well, in simple language blog is like a book and when you write your article or posts it becomes its pages.
And anyone on the Internet can read that book in which you write about your passions, or about the things in which you are good at.
If your blog provides useful information and helps people in any kind of way then you are definitely going to benefit from it in the long run.

         </div>
           </div>
           
           </div>
           <br>

           <div class="card">
           <div class="card-header bg-dark text-light">
           <h2 class="text-lead">Sign Up !</h2>
           </div>
           <div class="card-body">
           <button type="button" class="btn btn-success btn-block text-center text-white" name="button">Join the Forum</button>
           <button type="button" class="btn btn-danger btn-block text-center text-white mb-3" name="button">Login</button>
           <div class="input-group mb-3">
           
           <input type="text" class="form-control" placeholder="Enter your email" name="" value="">
           <div class="input-group-append">
           <button type="button" class="btn btn-primary btn-sm text-center text-white" name="button">Subscribe Now</button>
           </div>
           </div>

           </div>
           </div>

           <br>
           <div class="card">
           <div class="card-header bg-primary text-light">
           <h2 class="lead">Categories</h2>
           </div>
           <div class="card-body">
           <?php 
           global $ConnectingDB;
           $query = "SELECT * FROM category ORDER BY category_id DESC";
           $stmt = $ConnectingDB->query($query);
           while($row = $stmt->fetch()) {

            $category_id = $row['category_id'];
            $category_title = $row['category_title'];
             ?>

             <a href="Blog.php?post_category=<?php echo $category_title; ?>"><span class="heading"><?php echo $category_title; ?></span></a><br>
             
          <?php } ?> 
           
           </div>
           
        </div>
        <br>

        <div class="card">
        <div class="card-header bg-info text-white">
        <h2 class="lead"> Recent Posts</h2>
        </div>
        <div class="card-body">

        <?php 
        global $ConnectingDB;
        $query = "SELECT * FROM posts ORDER BY post_id DESC LIMIT 0,5";
        $stmt = $ConnectingDB->query($query);
        while($row = $stmt->fetch()){

            $post_id = $row['post_id'];
            $DateTime = $row['post_datetime'];
            $post_title = $row['post_title'];
            $post_image = $row['post_image'];
          
          ?>
        

        <div class="media">
        <img src="Upload/<?php echo $post_image; ?>" class="d-block img-fluid align-self-start" alt="">
        <div class="media-body ml-2">
       <a href="FullPost.php?post_id=<?php echo $post_id; ?>" target="_blank"> <h6 class="lead"><?php echo $post_title; ?></h6></a>
        <p class="small"><?php echo $DateTime;  ?></p>
        </div>
        </div>

        <?php } ?>

        </div>
        </div>

    </div>

           <!-- The Side Area End -->
       </div>
   </div>
    <!--END OF HEADER-->
    <br>
    <!--FOOTER-->

    <footer class="bg-dark text-white">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="lead text-center">Theme By | Ivan Radisavljevic | <span id="year"></span> &copy; ----All right Reserved.</p>
                </div>
            </div>
        </div>
    </footer>
    <div style="height: 10px; background: #27aae1;"></div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b37c2a5cfc.js" crossorigin="anonymous"></script>
    <script>
        $('#year').text(new Date().getFullYear());
    </script>
</body>

</html>