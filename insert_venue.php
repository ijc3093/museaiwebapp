<?php
  
  include('header.php');
  

  include('DB_Management.php');
  $db = new DB();


  
  if(isset($_POST['insertVenue'])){

    //does  validation first
    $_POST['name'] = sanitize_input($_POST["name"]);
    $_POST['capacity'] = sanitize_input($_POST["capacity"]); 

    $db->insert_Venue($_POST['name'],$_POST['capacity']);
    echo "<script>alert('Session saved');</script>";
  }


  // does sanitization second
  function sanitize_input( $value){
    $value = trim($value);
    $value = stripslashes($value);
    $value = htmlspecialchars($value);
    return $value;
  }



  $query = "insert into venue (name, capacity) values(?,?)";
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
    <meta charset="utf-8" />
    <link rel="icon" href="%PUBLIC_URL%/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <meta name="description" content="Web site created using create-react-app"/>
    <link rel="apple-touch-icon" href="%PUBLIC_URL%/logo192.png" />
    <title>Insert Museai</title>
    <link rel="manifest" href="%PUBLIC_URL%/manifest.json" />      
    <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Museai RIT</a>
      <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="admin.php?logout=true">Sign out</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="admin.php">
                  Admin <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="museais.php">
                  Manager
                </a>
              </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Saved reports</span>
              <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="plus-circle"></span>
              </a>
            </h6>
            <ul class="nav flex-column mb-2">
              <li class="nav-item">
                <a class="nav-link" href="#">
                  Current month
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  Last quarter
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  Social engagement
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  Year-end post
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                  <div class="col-md-8 order-md-1"><br><br>

                  <div>
                          <h2>Add New Venue</h2>
                          <br>          
                  </div>
                  <div class="col-lg-8 push-lg-4 personal-info"> 
                    <?php 
                            
                        $result = $db->get_Venues();
                          //var_dump($result);
                        echo'<form action="insert_venue.php?insertVenue=true" method="post" role="form" id="createAccountFor" > 

                            <div class="form-group row">

                            <label class="col-lg-3 col-form-label form-control-label">Name</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="name" placeholder="" value="" required /><br>
                                </div>

                                <label class="col-lg-3 col-form-label form-control-label">Capacity</label>
                                <div class="col-lg-9">
                                    <input class="form-control" name="capacity" placeholder="" value="" required /><br>
                                </div>';

                                // echo  '<button class="btn btn-primary btn-lg btn-block" type="submit" name="insertEvent">Save</button>
                                // <hr class="mb-4">';  
                                
                                echo  '<button class="btn btn-primary" type="submit" name="insertVenue">Submit</button>'; 
                    echo '<hr/></form>';  
                    ?>
                    </div>
                  </div>
                </main>
              </div>
            </div>
  </body>
</html>
