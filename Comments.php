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
    <title>Comments</title>
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
                    <h1><i class="fas fa-comments" style="color:#27aae1;"></i> Manage Comments</h1>
                </div>
            </div>
        </div>
    </header>
    <!--END OF HEADER-->
    <!--Comments Section Start-->
    <section class="container py-2 mb-4">
        <div class="row" style="min-height:30px;">
        <div class="col-lg-12" style="min-height:50px;"></div>
        <h2>Un-Approved Comments</h2>
        <?php  
         echo ErrorMessage();
         echo SuccessMessage();
         ?>
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>No.</th>
                    <th>Date&Time</th>
                    <th>Name</th>
                    <th>Comment</th>
                    <th>Approve</th>
                    <th>Action</th>
                    <th>Details</th>
                </tr>
            </thead>

        
        <?php
        global $ConnectingDB;
        $query = "SELECT * FROM comments WHERE comment_status = 'OFF' ORDER BY comment_id DESC";
        $Execute = $ConnectingDB->query($query);
        $SrNo = 0;
        while($row = $Execute->fetch()){

            $comment_id = $row['comment_id'];
            $DateTime = $row['comment_datetime'];
            $comment_name = $row['comment_name'];
            $comment = $row['comment'];
            $post_id = $row['post_id'];
            $SrNo++;
       
        ?>
        <tbody>
        <tr>
            <td><?php echo $SrNo; ?></td>
            <td><?php echo $DateTime; ?></td>
            <td><?php echo $comment_name; ?></td>
            <td><?php echo $comment; ?></td>
            <td><a href="ApproveComment.php?id=<?php echo $comment_id; ?>" class="btn btn-success">Approve</a></td>
            <td><a href="DeleteComment.php?id=<?php echo $comment_id; ?>" class="btn btn-danger">Delete</a></td>
            <td><a class="btn btn-primary" href="FullPost.php?id=<?php echo $post_id; ?>" target="_blank">Live Preview</a></td>
        </tr>
        </tbody>

       <?php } ?>

        </table>

        <h2>Approved Comments</h2>
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>No.</th>
                    <th>Date&Time</th>
                    <th>Name</th>
                    <th>Comment</th>
                    <th>Revert</th>
                    <th>Action</th>
                    <th>Details</th>
                </tr>
            </thead>

        
        <?php
        global $ConnectingDB;
        $query = "SELECT * FROM comments WHERE comment_status = 'ON' ORDER BY comment_id DESC";
        $Execute = $ConnectingDB->query($query);
        $SrNo = 0;
        while($row = $Execute->fetch()){

            $comment_id = $row['comment_id'];
            $DateTime = $row['comment_datetime'];
            $comment_name = $row['comment_name'];
            $comment = $row['comment'];
            $post_id = $row['post_id'];
            $SrNo++;
       
        ?>
        <tbody>
        <tr>
            <td><?php echo $SrNo; ?></td>
            <td><?php echo $DateTime; ?></td>
            <td><?php echo $comment_name; ?></td>
            <td><?php echo $comment; ?></td>
            <td style="width:140px;"><a href="DisApproveComment.php?id=<?php echo $comment_id; ?>" class="btn btn-warning">Dis-Approve</a></td>
            <td><a href="DeleteComment.php?id=<?php echo $comment_id; ?>" class="btn btn-danger">Delete</a></td>
            <td style="width:140px;"><a class="btn btn-primary" href="FullPost.php?id=<?php echo $post_id; ?>" target="_blank">Live Preview</a></td>
        </tr>
        </tbody>

       <?php } ?>

        </table>

        </div>

       </section>
    <!--Comments Section End-->
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