<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php 

//Fetching Admin table from Database for My Profile Page
$admin_id = '';
if(isset($_GET['admin_id'])){
    $admin_id = $_GET['admin_id'];
}
global $ConnectingDB;
$query = "SELECT * FROM admin WHERE admin_id='{$admin_id}'";
$stmt = $ConnectingDB->query($query);
while($row = $stmt->fetch()){
    $admin_name = $row['admin_name'];
}
//Fetching Admin table from Database for My Profile Page End


if(isset($_POST['submit'])) {

$admin_name = $_POST['Name'];
$admin_headline = $_POST['Headline'];
$admin_bio = $_POST['Bio'];
$admin_image = $_FILES['admin_image']['name'];
$target = "images/".basename($_FILES['admin_image']['name']);


 if (strlen($admin_headline) > 12){

    $_SESSION['ErrorMessage'] = "Headline should be lass than 12 charachters";
    Redirect_to("MyProfile.php");
} elseif (strlen($admin_bio) > 500) {

    $_SESSION['ErrorMessage'] = " Bio  should be less than 500 characters";
    Redirect_to("MyProfile.php");
} else {
    //Query to UPDATE Admin table in DB for My Profile page
    global $ConnectingDB;
   if(!empty($_FILES['admin_image']['name'])){

   $query = "UPDATE admin SET admin_name='{$admin_name}', admin_headline='{$admin_headline}', admin_bio='{$admin_bio}', admin_image='{$admin_image}' WHERE admin_id='{$admin_id}'";
   } else {
      $query = "UPDATE admin SET admin_name='{$admin_name}', admin_headline='{$admin_headline}', admin_bio='{$admin_bio}' WHERE admin_id='{$admin_id}'"; 
   }
}

$Execute= $ConnectingDB->query($query);
move_uploaded_file($_FILES['admin_image']['tmp_name'], $target);
if($Execute) {
    $_SESSION['SuccessMessage'] = "Details Updated Successfully";
    Redirect_to("MyProfile.php");
}else {
    $_SESSION['ErrorMessage'] = "Something went wrong. Try again!";
    Redirect_to("MyProfile.php");
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
    <title>My Profile</title>
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
                        <a href="Admin.php" class="nav-link">Manage Admin</a>
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
                    <h1><i class="fas fa-user mr-2" style="color:#27aae1;"></i>My Profile</h1>
                </div>
            </div>
        </div>
    </header>
    <!--END OF HEADER-->

    <!--MAIN AREA-->
<section class="container py-2 mb-4">
<div class="row">

<!--Left Area of My Profile Page -->
<div class="col-md-3">
<div class="card">
<div class="card-header bg-dark text-light">

<h3> <?php echo $admin_name; ?> </h3>
</div>
<div class="card-body">
<img src="images/avatar.png" class="block img-fluid mb-3" alt="">
<div class="">
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam pharetra bibendum sapien id fermentum. Sed at cursus nulla, sollicitudin interdum sapien. Integer a nisi in ante semper elementum vitae et ex. Fusce felis leo, volutpat non metus sed, accumsan molestie odio.
</div>
</div>
</div>
</div>
<!--Right Area of My Profile Page -->
<div class=" col-md-9" style="min-height: 400px;">
<?php  
    echo ErrorMessage();
    echo SuccessMessage();
    ?>
<form class="" action="MyProfile.php" method="post" enctype="multipart/form-data">
    <div class="card bg-dark text-light">
        <div class="card-header bg-secondary text-light">
            <h1>Edit Profile</h1>
        </div>
        <div class="card-body">
            <div class="form-group">
            <input class="form-control" type="text" name="Name" placeholder="Your name" id="title" value="">
            </div>

            <div class="form-group">
            <input class="form-control" type="text" name="Headline" placeholder="Headline" id="title" value="">
            <small class="text-muted">Add a professional headline like, 'Engineer' at XYZ or 'Architect'</small>
            <span class="text-danger">Not more than 12 characters</span>
            </div>

            <div class="form-group">
            <textarea class="form-control" placeholder="Bio" name="Bio" id="Post" cols="80" rows="8"></textarea>
            </div>

            <div class="form-group">
            <label for="imageSelect"><span classs="FieldInfo"> Select Image </span></label>
            <div class="custom-file">
            <input type="file" name="admin_image" id="imageSelect" value="">
            
            </div>
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