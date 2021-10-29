<?php
   //var_dump($_GET);

    include('header.php');

    // $_SESSION = array(); // destroy all session data
    // session_destroy(); // compelte erase session
    include('DB_Management.php');
    $db = new DB();

  //delete data from museai
    if(isset($_GET['deleteAttendingmuseai'])){
        $db->Delete("attendee_museai", $_GET['id'], "museai");
    }

  //delete data from session
    if(isset($_GET['deleteAttendingSession'])){
        $db->Delete("attendee_session", $_GET['id'], "session");
    }

  //delete museai
    if(isset($_GET['deletemuseai'])){
        $db->admin_Delete("museai", $_GET['id'], "idmuseai");
        $db->admin_Delete("session", $_GET['id'], "museai");
    }

    //deleteUser
    if(isset($_GET['deleteUser']) && !($_GET['id'] == 1)){
        $db->admin_Delete("attendee", $_GET['id'], "idattendee");
    }

  //delete venue
    if(isset($_GET['deleteVenue']) && ($_GET['id']) == 1){
        $db->admin_Delete("venue", $_GET['id'], "idvenue");
        $db->admin_Delete("museai", $_GET['id'], "venue");
    }


    //delete session
    if(isset($_GET['deleteSession'])){
        $db->admin_Delete("session", $_GET['id'], "idsession");
    }

    //attending museai
    if(isset($_GET['attendmuseai'])){
        $db->attending_museai($_GET['id'], $_SESSION['username']);
    }

    //attending session
    if(isset($_GET['attendSession'])){
        $db->attending_Session($_GET['id'], $_SESSION['username']);
    }

    //logout button
    if(isset($_GET['logout'])){
        logout();
    }

    //destory the admin to the login local
    function logout(){
        //$_SESSION = array(); // destroy all venue data
        session_destroy(); // compelte erase venue
        //header("location: http://serenity.ist.rit.edu/~ijc3093/ISTE-341/Project1/login.php");
        header("location: http://127.0.0.1:8080/login.php");
        exit();
    }


    // if($_SESSION['userRole'] == "manager" || $_SESSION['userRole'] == "attendee"){
    //     echo '<script>window.location.replace("registrations.php");</script>';
    // }


    if($_SESSION['userRole'] == 2){
        echo '<script>window.location.replace("registrations.php");</script>';
    }

    if($_SESSION['userRole'] == 3){
        echo '<script>window.location.replace("museais.php");</script>';
    }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <link rel="icon" href="%PUBLIC_URL%/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <meta name="description" content="Web site created using create-react-app"/>
    <link rel="apple-touch-icon" href="%PUBLIC_URL%/logo192.png" />
  
    <link rel="manifest" href="%PUBLIC_URL%/manifest.json" />      
    <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
   
    <title>Admin</title>
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
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">The Information System</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <a href="insert_user.php" class="btn btn-sm btn-outline-secondary">Add</a>
                <button class="btn btn-sm btn-outline-secondary">Share</button>
                <button class="btn btn-sm btn-outline-secondary">Export</button>
              </div>
              <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                This week
              </button>
            </div>
          </div>
                <div class="col-md-8 order-md-1">
                  <div class="container">
                                <br>
                                <br>
                                <div class="col-lg-12 text-lg-center">
                                    <a class="btn btn-primary pull-right class="nav-link" href="insert_user.php">
                                    <span data-feather="users"></span>Add New User</a>
                                <br>
                                </div>

                                    
                                <br>   
                                <!-- Attendee Table -->
                                <table class="table table-dark table-bordered table-responsive-md table-striped text-center">
                                            <thead>
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Role</th>
                                                <th class="text-center">Edit</th>
                                                <th class="text-center">Delete</th>
                                            </tr>
                                            </thead>

                                            <?php
                                                    $result = $db->get_Attendees();

                                                    foreach($result as $post){
                                                    echo'
                                                        <tbody>';

                                                    echo'
                                                            <tr>
                                                            <td class="pt-3-half" contenteditable="true">'
                                                            . $post["idattendee"] . 
                                                            '</td>

                                                            <td class="pt-3-half" contenteditable="true"> '. $post["name"] . '
                                                            </td>';
                                                        
                                                    echo'
                                                            <td class="pt-3-half">';
                                                                if($post['role'] == 1){
                                                                    echo '<input class="form-control" name="role" type="role" value="Admin" />';
                                                                }
                                                                else if($post['role'] == 2){
                                                                    echo '<input class="form-control" name="role" type="role" value="Manager" />';
                                                                }
                                    
                                                                else{
                                                                    echo '<input class="form-control" name="role" type="role" value="Attendee" />';
                                                                }
                                                    echo'
                                                            </td>';




                                                        //Admin's super
                                                        if($_SESSION['userRole'] == 1 || $_SESSION['userRole'] == 2){
                                                            echo'
                                                                <td>
                                                                    <span class="table-remove"><a type="button" class="btn btn-success" href="edit_user.php?id=' 
                                                                    .$post["idattendee"]. '">Edit</a>&nbsp;</span>
                                                                </td>';

                                                            echo'
                                                                <td>
                                                                    <span class="table-remove"><a type="button" class="btn btn-danger" href="admin.php?deleteUser=true&id=' 
                                                                    .$post["idattendee"]. 
                                                                    '">Delete</a>&nbsp;</span>
                                                                </td>';
                                                                
                                                        }else{
                                                            echo'
                                                                <td>
                                                                    <span class="table-remove"><a type="button" class="btn btn-success" href="edit_user.php?id=' 
                                                                    .$post["idattendee"]. 
                                                                    '" disabled>Edit</a>&nbsp;</span>
                                                                </td>';


                                                            echo'
                                                                <td>
                                                                    <span class="table-remove"><a type="button" class="btn btn-danger" href="admin.php?deleteUser=true&id=' 
                                                                    .$post["idattendee"]. '
                                                                    "disabled>Delete</a>&nbsp;</span>
                                                                </td></tr>';
                                                        }
                                                        
                                                        
                                                echo' 
                                                    </tbody>';
                                                }// close get_museais()  
                                            ?>
                                </table>
                                
                                
                                <br>
                                <br>
                                <div class="col-lg-12 text-lg-center">
                                    <!-- Get Registration -->
                                    <h2 class="pull-left">Venue Location</h2>
                                        <a class="btn btn-primary pull-right class="nav-link" href="insert_venue.php">
                                        <span data-feather="users"></span>Add New Venue</a>
                                <br>
                                <br>
                            
                                </div>    
                                <!-- Attendee Table -->
                                <table class="table table-dark table-bordered table-responsive-md table-striped text-center">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">ID</th>
                                                    <th class="text-center">Name</th>
                                                    <th class="text-center">Capacity</th>
                                                    <th class="text-center">Edit</th>
                                                    <th class="text-center">Delete</th>
                                                    
                                                </tr>
                                            </thead>

                                            <?php
                                                $result = $db->get_Venues();
                                                foreach($result as $post){
                                                    echo'<tbody>';
                                                    
                                                    echo'<tr>
                                                        <td class="pt-3-half" contenteditable="true">'. $post["idvenue"] . '</td>
                                                        <td class="pt-3-half" contenteditable="true">'. $post["name"] . '</td>
                                                        <td class="pt-3-half" contenteditable="true">'. $post["capacity"] . ' </td> ';  
                                                        // close get_Register_museais()
                                                    
                                                    echo'    
                                                        <td><a  class="btn btn-success" href="edit_venue.php?id=' . $post["idvenue"] . '">
                                                        Edit</a></td>';

                                                    echo'    
                                                        <td><a  class="btn btn-danger btn-rounded btn-sm my-0" href="admin.php?deleteVenue=true&id=' . $post["idvenue"] . '">
                                                        Delete</a></td></tr>';
                                                    echo' </tbody> ';
                                                }
                                            ?>
                                </table> 
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
