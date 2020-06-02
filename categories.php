<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php 

if(isset($_POST['submit'])) {

$category_title = $_POST['category_title'];
$Admin = "Ivan";

date_default_timezone_set("Europe/Belgrade");
$CurrentTime = time();
$DateTime = strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);

if(empty($category_title)) {

    $_SESSION['ErrorMessage'] = "All fields must be filled out";
    Redirect_to("categories.php");
} elseif (strlen($category_title) < 2){

    $_SESSION['ErrorMessage'] = "Category title should be greater than 2 characters";
    Redirect_to("categories.php");
} elseif (strlen($category_title) > 49) {

    $_SESSION['ErrorMessage'] = "Category title should be less than 50 characters";
    Redirect_to("categories.php");
}

$query = ("INSERT INTO category(category_title,category_author,category_datetime) VALUES(:categoryName,:adminName,:dateTime)");
$stmt = $ConnectingDB->prepare($query);
$stmt->bindValue(':categoryName',$category_title);
$stmt->bindValue(':adminName',$Admin);
$stmt->bindValue(':dateTime',$DateTime);
$Execute=$stmt->execute();

if($Execute) {
    $_SESSION['SuccessMessage'] = "Category Added Successfully";
    Redirect_to("categories.php");
}else {
    $_SESSION['ErrorMessage'] = "Something went wrong. Try again!";
    Redirect_to("categories.php");
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
    <title>Categories</title>
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
                    <h1><i class="fas fa-edit" style="color:#27aae1;"></i> Manage Categories</h1>
                </div>
            </div>
        </div>
    </header>
    <!--END OF HEADER-->
    <!--MAIN AREA-->
<section class="container py-2 mb-4">

<div class="row">
<div class="offset-lg-1 col-lg-10" style="min-height: 400px;">
<form class="" action="Categories.php" method="post">
    <?php  
    echo ErrorMessage();
    echo SuccessMessage();
    
    ?>
    <div class="card bg-secondary text-light mb-3">
        <div class="card-header">
            <h1>Add New Category</h1>
        </div>
        <div class="card-body bg-dark">
            <div class="form-group">
                <label for="title"> <span class="FieldInfo"> Category Title: </span></label>
                <input class="form-control" type="text" name="category_title" id="title" value="">
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


<h2>Existing Categories</h2>
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>No.</th>
                    <th>Date&Time</th>
                    <th> Category Name</th>
                    <th>Creator Name</th>
                    <th>Action</th>
                </tr>
            </thead>

        
        <?php
        global $ConnectingDB;
        $query = "SELECT * FROM category  ORDER BY category_id DESC";
        $Execute = $ConnectingDB->query($query);
        $SrNo = 0;
        while($row = $Execute->fetch()){

            $category_id = $row['category_id'];
            $category_title = $row['category_title'];
            $category_author = $row['category_author'];
            $DateTime = $row['category_datetime'];
           
            
            $SrNo++;
       
        ?>
        <tbody>
        <tr>
            <td><?php echo $SrNo; ?></td>
            <td><?php echo $DateTime; ?></td>
            <td><?php echo $category_title; ?></td>
            <td><?php echo $category_author; ?></td>
            
            <td><a href="DeleteCategory.php?id=<?php echo $category_id; ?>" class="btn btn-danger">Delete</a></td>
            
        </tr>
        </tbody>

       <?php } ?>

        </table>

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