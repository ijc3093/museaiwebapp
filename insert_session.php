<?php
  
  include('header.php');
  
  include('DB_Management.php');
  $db = new DB();
  //var_dump($_POST);
  if(isset($_POST['insertSession'])){


    //does  validation first
    $_POST['name'] = sanitize_input($_POST["name"]);
    $_POST['startdate'] = sanitize_input($_POST["startdate"]);
    $_POST['enddate'] = sanitize_input($_POST["enddate"]);
    $_POST['numberAllowed'] = sanitize_input($_POST["numberAllowed"]);


    $status = $db->insert_Session(
      // id here
      $_POST['name'],
      $_POST['numberallowed'],
      $_POST['event'],
      $_POST['startdate'],
      $_POST['enddate']
    );
    if( $status == 1 ){
      echo "<script>alert('Session saved');</script>";
    }else
    {
      echo "<script>alert('session failed to save');</script>";
    }
  }
  

  // does sanitization second
  function sanitize_input( $value){
    $value = trim($value);
    $value = stripslashes($value);
    $value = htmlspecialchars($value);
    return $value;
  }


  //logout button
  if(isset($_GET['logout'])){
    logout();
  }

  //destory the session to the login local (index)
  function logout(){
   // session_destory();
    //header("location: http://serenity.ist.rit.edu/~ijc3093/ISTE-341/Project1/login.php");
    header("location: http://127.0.0.1:8080/login.php");
    exit();
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <link rel="icon" href="%PUBLIC_URL%/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <meta
      name="description"
      content="Web site created using create-react-app"
    />
    <link rel="apple-touch-icon" href="%PUBLIC_URL%/logo192.png" />
    <!--
      manifest.json provides metadata used when your web app is installed on a
      user's mobile device or desktop. See https://developers.google.com/web/fundamentals/web-app-manifest/
    -->
    <link rel="manifest" href="%PUBLIC_URL%/manifest.json" />
    <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">

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
            </style>
    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
    <title>Events</title>
  </head>
  <body>
    
    <div id="root"></div>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">Add Session</a>
          <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
          <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
              <a class="nav-link" href="">Logout</a>
            </li>
          </ul>
        </nav>
            <div class="container-fluid">
              <div class="row">
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                  <div class="sidebar-sticky pt-3">
                    <ul class="nav flex-column">
                      <?php 
                            echo '<li class="nav-item">
                                <a class="nav-link" href="admin.php">
                                <span data-feather="file"></span>
                                Admin 
                                </a>
                            </li>';
                        ?>
                      <li class="nav-item">
                        <a class="nav-link" href="events.php">
                          <span data-feather="shopping-cart"></span>
                          Events
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="registrations.php">
                          <span data-feather="users"></span>
                          Registrations 
                        </a>
                      </li>
                    </ul>
                  </div>
                </nav>
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                  <div class="col-md-8 order-md-1"><br><br>

                  <h2>Add New Session</h2>
                  <div class="col-lg-8 push-lg-4 personal-info"> 
                        <?php       
                            //var_dump($result);
                            echo'<form action="" method="post" role="form"> 

                                <div class="form-group row">
                                
                                    <label class="col-lg-3 col-form-label form-control-label">Name</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="text" name="name" placeholder="" value="" required /><br>
                                    </div>

                                    <label class="col-lg-3 col-form-label form-control-label">Start Date</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="startdate" placeholder="" value="" required /><br>
                                    </div>';

                                    echo'<label class="col-lg-3 col-form-label form-control-label">End Date</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="enddate" placeholder="" value="" required /><br>
                                    </div>';


                                    echo'<label class="col-lg-3 col-form-label form-control-label">Number Allowed</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="numberallowed" placeholder="" value="" required/><br>
                                    </div>';


                                    echo'<label class="col-lg-3 col-form-label form-control-label">Capacity</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="event" placeholder="" value="" required/><br>
                                    </div>';

                                    
                                    echo  '<button class="btn btn-primary" type="submit" name="insertSession">Save</button>
                                    <hr class="mb-4">';              
                            echo '<hr/></form>';  
                            ?>
                         </div>
                    </div>
                </main>
              </div>
            </div>
  </body>
</html>
