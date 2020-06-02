<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php 

if(isset($_POST['submit'])){

    $admin_username = $_POST['admin_username'];
    $admin_password = $_POST['admin_password'];

    if(empty($admin_username)|| empty($admin_password)){

        $_SESSION['ErrorMessage'] = "All fields must be filled out";
        Redirect_to("Login.php");
    } else {

        global $ConnectingDB;
        $query = "SELECT * FROM admin WHERE admin_username = $admin_username AND admin_password = $admin_password LIMIT 1";
        $stmt = $ConnectingDB->prepare($query);
        $admin_username = $row['admin_username'];
        $admin_password = $row['admin_password'];
        $stmt->execute();
     if($admin_username == $admin_password) {
         $_SESSION["SuccessMessage"] = "Welcome Admin ";
         Redirect_to("Login.php");
     } else {
         $_SESSION["ErrorMessage"] = "Incorrect Username and Password";
         Redirect_to("Login.php");
     }
        
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
    <title>Login</title>
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
                
            </div>
        </div>
    </nav>
    <div style="height: 10px; background: #27aae1;"></div>
    <!--END OF NAVIGATION BAR-->

    <!--Main Area Start-->

           <section class="container py-2 mb-4">
           <div class="row">
           <div class="offset-sm-3 col-sm-6" style="min-height:500px;">
           <br><br><br>

              <?php  
              echo ErrorMessage();
              echo SuccessMessage();
              ?>
             <div class="card bg-secondary text-light">
                 <div class="card-header">
                     <h4>Welcome back !</h4>
                     </div>
                     <div class="card-body bg-dark">
                     <form  class="" action="Login.php" method="post">
                      <div class="form-group">
                       <label for="username"><span class="FieldInfo">Username: </span></label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text text-white bg-info"> <i class="fas fa-user"></i> </span>
                            </div>
                            <input type="text" class="form-control" name="admin_username" id="username" value="">
                        </div>
                      </div>

                      <div class="form-group">
                          <label for="password"><span class="FieldInfo">Password: </span></label>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                  <span class="input-group-text text-white bg-info"> <i class="fas fa-lock"></i> </span>
                              </div>
                              <input type="password" class="form-control" name="admin_password" id="password" value="">
                          </div>
                      </div>

                      <input type="submit" name="submit" class="btn btn-info btn-block" value="Login">
                     </form>
                 </div>
             </div>
         </div>
     </div>

       </section>




    <!--Main Area End-->

    <!--HEADER-->
    <header class="bg-dark text-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                </div>
            </div>
        </div>
    </header>
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