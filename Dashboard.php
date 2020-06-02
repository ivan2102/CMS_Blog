<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Dashboard</title>
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
                    <h1><i class="fas fa-cog" style="color:#27aae1;"></i> Dashboard</h1>
                </div>

                <div class="col-lg-3 mb-2">
                    <a href="AddNewPost.php" class="btn btn-primary btn-block">
                        <i class="fas fa-edit"></i> Add New Post
                    </a>
                </div>

                <div class="col-lg-3 mb-2">
                    <a href="Categories.php" class="btn btn-info btn-block">
                        <i class="fas fa-folder-plus"></i> Add New Category
                    </a>
                </div>

                <div class="col-lg-3 mb-2">
                    <a href="Admins.php" class="btn btn-warning btn-block">
                        <i class="fas fa-edit"></i> Add New Admin
                    </a>
                </div>

                <div class="col-lg-3 mb-2">
                    <a href="Comments.php" class="btn btn-success btn-block">
                        <i class="fas fa-check"></i> Approve Comments
                    </a>
                </div>
            </div>
        </div>
    </header>
    <!--END OF HEADER-->


    <!--Main Area-->

    <section class="container py-2 mb-4">
        <div class="row">

        <!-- Left Side Area Start -->
            <div class="col-lg-2 d-none d-md-block">
           <div class="card text-center bg-dark text-white mb-3">
               <div class="card-body">
                   <h1 class="lead">Posts</h1>
                   <h4 class="display-5">
                       <i class="fab fa-readme"></i>
                       <?php 
                      
                      TotalPosts(); 
                       ?>
                   </h4>
               </div>
           </div> 
           
           <div class="card text-center bg-dark text-white mb-3">
               <div class="card-body">
                   <h1 class="lead">Categories</h1>
                   <h4 class="display-5">
                       <i class="fas fa-folder"></i>
                       <?php 
                      
                      TotalCategory();
                       ?>
                   </h4>
               </div>
           </div>

           <div class="card text-center bg-dark text-white mb-3">
               <div class="card-body">
                   <h1 class="lead">Admin</h1>
                   <h4 class="display-5">
                       <i class="fas fa-users"></i>
                       <?php 
                      
                       TotalAdmin();
                       
                       ?>
                   </h4>
               </div>
           </div>

           <div class="card text-center bg-dark text-white mb-3">
               <div class="card-body">
                   <h1 class="lead">Comments</h1>
                   <h4 class="display-5">
                   <i class="fas fa-comments"></i>
                   <?php 
                  
                   TotalComments();
                   
                   ?>
                   </h4>
               </div>
           </div>
            </div>
         <!-- Left Side Area End -->

         <!--Right Side Area Start -->
         <div class="col-lg-10">
         <h1>Top Posts</h1>
         <table class="table table-striped table-hover">
         <thead class="thead-dark">
         <tr>
         <th>No.</th>
         <th>Date&Time</th>
         <th>Title</th>
         <th>Author</th>
         <th>Comments</th>
         <th>Details</th>
         
         </tr>
         </thead>

         <?php
         $SrNo = 0; 
         global $ConnectingDB;
         $query = "SELECT * FROM posts ORDER BY post_id DESC LIMIT 0,5";
         $stmt = $ConnectingDB->query($query);
         while($row = $stmt->fetch()){

            $post_id = $row['post_id'];
            $DateTime = $row['post_datetime'];
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $SrNo++;
          ?>

         <tbody>
         <tr>

         <td><?php echo $SrNo; ?></td>
         <td><?php echo $DateTime; ?></td>
         <td><?php echo $post_title; ?></td>
         <td><?php echo $post_author; ?></td>
         
         
        
         <td>
         <?php  $Total = ApproveCommentsAccordingtoPost($post_id);
        if($Total>0){
            ?>
            <span class="badge badge-success">
            <?php
            echo $Total; ?>
            </span>

              <?php } ?>

              <?php  $Total = DisApproveCommentsAccordingtoPost($post_id);
        if($Total>0){
            ?>
            <span class="badge badge-danger">
            <?php
            echo $Total; ?>
            </span>

              <?php } ?>
              
              </td>
         <td><a target="_blank" href="FullPost.php?id=<?php echo $post_id; ?>"><span class="btn btn-info">Preview</span></a></td>
         
          </tr>
          </tbody>

          <?php } ?>

         </table>
         </div>


         <!--Right Side Area End -->

        </div>

    </section>

    <!--End of Main Area-->


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