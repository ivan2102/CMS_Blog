<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php 

if(isset($_POST['submit'])) {

$post_title = $_POST['post_title'];
$post_category = $_POST['post_category'];
$post_image = $_FILES['image']['name'];
$target = "Upload/".basename($_FILES['image']['name']);
$post_content = $_POST['post_content'];
$post_author = $_POST['post_author'];

date_default_timezone_set("Europe/Belgrade");
$CurrentTime = time();
$DateTime = strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);

if(empty($post_title)) {

    $_SESSION['ErrorMessage'] = "Title cannot be empty";
    Redirect_to("posts.php");
} elseif (strlen($post_title) < 5){

    $_SESSION['ErrorMessage'] = "Post title should be greater than 5 characters";
    Redirect_to("posts.php");
} elseif (strlen($post_content) > 999) {

    $_SESSION['ErrorMessage'] = "Post description  should be less than 1000 characters";
    Redirect_to("posts.php");
}
global $ConnectingDB;
$query = ("INSERT INTO posts(post_datetime, post_title, post_category, post_author, post_image, post_content) VALUES('{$DateTime}', '{$post_title}', '{$post_category}', '{$post_author}', '{$post_image}', '{$post_content}')");
$stmt = $ConnectingDB->prepare($query);
$DateTime = $row['post_datetime'];
$post_title = $row['post_title'];
$post_category = $row['post_category'];
$post_author = $row['post_author'];
$post_image = $row['post_image'];
$post_content = $row['post_content'];
$Execute=$stmt->execute();
move_uploaded_file($_FILES['image']['tmp_name'], $target);
if($Execute) {
    $_SESSION['SuccessMessage'] = "Post Added Successfully";
    Redirect_to("AddNewPost.php");
}else {
    $_SESSION['ErrorMessage'] = "Something went wrong. Try again!";
    Redirect_to("AddNewPost.php");
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
    <title>Posts</title>
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
                    <li class="nav-item">
                        <a href="MyProfile.php" class="nav-link"> <i class="far fa-user text-success"></i> My Profile</a>
                    </li>
                    <li class="nav-item">
                        <a href="Dashboard.php" class="nav-link">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a href="Posts.php" class="nav-link">Posts</a>
                    </li>
                    <li class="nav-item">
                        <a href="Categories.php" class="nav-link">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a href="Admins.php" class="nav-link">Manage Admins</a>
                    </li>
                    <li class="nav-item">
                        <a href="Comments.php" class="nav-link">Comments</a>
                    </li>
                    <li class="nav-item">
                        <a href="Blog.php?page=1" class="nav-link">Live Blog</a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="Logout.php" class="nav-link"> <i class="fas fa-user-times text-danger"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div style="height: 10px; background: #27aae1;"></div>
    <!--END OF NAVIGATION BAR-->

    <!--HEADER-->
    <header class="bg-dark text-white py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1><i class="fas fa-edit" style="color:#27aae1;"></i>Posts</h1>
                </div>
            </div>
        </div>
    </header>
    <!--END OF HEADER-->
    <!--MAIN AREA-->
<section class="container py-2 mb-4">

<div class="row">
<div class="offset-lg-1 col-lg-10" style="min-height: 400px;">
<form class="" action="AddNewPost.php" method="post" enctype="multipart/form-data">
    <?php  
    echo ErrorMessage();
    echo SuccessMessage();
    
    ?>
    <div class="card bg-secondary text-light mb-3">
        <div class="card-header">
            <h1>Add New Post</h1>
        </div>
        <div class="card-body bg-dark">
            <div class="form-group">
                <label for="title"> <span class="FieldInfo"> Post Title: </span></label>
                <input class="form-control" type="text" name="post_title" id="title" value="">
            </div>
            <div class="form-group">
            <label for="category_title"><span class="FieldInfo"> Chose Category</span></label>
            <select class="form-control" name="post_category" id="category_title">

            //FETCHING ALL CATEGORIES FROM CATEGORIES TABLE
            <?php 
            
           global $ConnectingDB;
            $query = ("SELECT category_id,category_title FROM category");
            $stmt = $ConnectingDB->query($query);
            while($row = $stmt->fetch()) {

                $category_id = $row['category_id'];
                $categoryName = $row['category_title'];

            
                ?>

             <option><?php echo $categoryName; ?></option>

             <?php } ?>
          
            </select>
            </div>

            <div class="form-group">
            <label for="author"><span class="FieldInfo"> Post Author: </span></label>
            <input class="form-control" type="text" name="post_author" id="author" value="">
            </div>


            <div class="form-group">
            <label for="imageSelect"><span classs="FieldInfo"> Select Image </span></label>
            <div class="custom-file">
            <input type="file" name="post_image" id="imageSelect" value="">
            
            </div>
            </div>
            <div class="form-group">
            <label for="Post"><span class="FieldInfo"> Post: </span></label>
            <textarea class="form-control" name="post_content" id="Post" cols="80" rows="8"></textarea>
            </div>

            <div class="row">
                <div class="col-lg-6 mb-2">
                    <a href="Dashboard.php" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i> Back To Dashboard</a>
                </div>
                <div class="col-lg-6 mb-2">
                    <button type="submit" name="submit" class="btn btn-success btn-block"><i class="fas fa-check"></i> Publish</button>
                </div>
            </div>
        </div>
    </div>
    
</form>

</div>

</div>

</section>




    <!--END OF MAIN AREA-->
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