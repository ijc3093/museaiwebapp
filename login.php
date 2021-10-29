
<?php
  
  include('DB_Management.php');
  session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <!-- <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1"> -->
    <title>Signin Template · Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">

    <!-- Bootstrap core CSS -->
<link href="./assets/dist/css/bootstrap.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }



      html,
    body {
      height: 100%;
    }

    body {
      display: -ms-flexbox;
      display: flex;
      -ms-flex-align: center;
      align-items: center;
      padding-top: 40px;
      padding-bottom: 40px;
      background-color: #f5f5f5;
    }

    .form-signin {
      width: 100%;
      max-width: 330px;
      padding: 15px;
      margin: auto;
    }
    .form-signin .checkbox {
      font-weight: 400;
    }
    .form-signin .form-control {
      position: relative;
      box-sizing: border-box;
      height: auto;
      padding: 10px;
      font-size: 16px;
    }
    .form-signin .form-control:focus {
      z-index: 2;
    }
    .form-signin input[type="email"] {
      margin-bottom: -1px;
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;
    }
    .form-signin input[type="password"] {
      margin-bottom: 10px;
      border-top-left-radius: 0;
      border-top-right-radius: 0;
    }

  </style>
    <!-- Custom styles for this template -->
  </head>
  <body class="text-center">

    <?php
          //Validate form
          if(isset($_POST['username']) && isset($_POST['password'])){
            $db = new DB();
            $post  = $db->login($_POST['username'], $_POST['password']);
            if( $post != -1 ){
              echo 'successs';
              echo '<script>window.location.replace("registrations.php");</script>';
            }else{
              echo '<script>alert("Login failed! or have you registered?");</script>';
            }
           }
    ?>


    <form class="form-signin" method="post">
          <!-- <img class="mb-4" src="./assets/brand/bootstrap-solid.svg" alt="" width="72" height="72"> -->
          <h2 class="h3 mb-3 font-weight-normal">Please sign in</h2>
          
          <label for="username" class="sr-only">Role</label>
          <input type="text" id="username" class="form-control" name="username" placeholder="Role" required autofocus>
          
          <label for="password" class="sr-only">Password</label>
          <input type="password" id="password" class="form-control" name="password" placeholder="Password" required>
          
          <div class="checkbox mb-3">
            <label>
              <input type="checkbox" value="remember-me"> Remember me
            </label>
          </div>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button></br>

          <h2 class="h3 mb-3 font-weight-normal">Don't have an account?</h2>
              <a href="register.php" class="btn btn-lg btn-primary btn-block">Register</a>
          
              <p class="mt-5 mb-3 text-muted">&copy; 2017-2021</p>
    </form>
    
</body>
</html>
