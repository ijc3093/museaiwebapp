<?php
    //var_dump($_GET);

    include('header.php');

   // var_dump($_SESSION);
    
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

        // echo "<script>alert('Delete from museai ');</script>";
    }


  //delete venue
    if(isset($_GET['deleteVenue']) && ($_GET['id']) == 1){
        $db->admin_Delete("venue", $_GET['id'], "idvenue");
        $db->admin_Delete("museai", $_GET['id'], "venue");
    }


    //delete session
    if(isset($_GET['deleteSession'])){
        var_dump($_GET);
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
       // header("location: http://serenity.ist.rit.edu/~ijc3093/ISTE-341/Project1/login.php");
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
    <meta name="description" content="Web site created using create-react-app"/>
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

        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <!-- Custom styles for this template -->
    <!-- <link href="dashboard.css" rel="stylesheet"> -->
    <title>Admin</title>
  </head>
  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Museai RIT</a>
      <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="Admin.php?logout=true">Sign out</a>
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
                <a class="nav-link" href="Manager.php">
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
            <h1 class="h2">The Manager</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <a href="insert_museai.php" class="btn btn-sm btn-outline-secondary">Add</a>
                <button class="btn btn-sm btn-outline-secondary">Share</button>
                <button class="btn btn-sm btn-outline-secondary">Export</button>
              </div>
              <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                This week
              </button>
            </div>
          </div>
                        <div>
                            <div class="table-responsive">
                                <div class="table-wrapper">

                                    <!-- Attendee Table -->
                                    <table class="table table-striped table-dark">
                                            <thead>
                                            <?php
                                                if($_SESSION['userRole'] == 3){
                                                    echo'<tr>
                                                        <th class="text-center">ID</th>
                                                        <th class="text-center">Name</th>
                                                        <th class="text-center">Start Date</th>
                                                        <th class="text-center">End Date</th>
                                                        <th class="text-center">Number Allowed</th>
                                                        <th class="text-center">Venue</th>
                                                        <th class="text-center">Image</th>
                                                        <th class="text-center">video</th>
                                                        <th class="text-center">Location Image</th>
                                                        <th class="text-center">Location Video</th>';
                                                }else{
                                                        echo'
                                                        <th class="text-center">ID</th>
                                                        <th class="text-center">Name</th>
                                                        <th class="text-center">Start Date</th>
                                                        <th class="text-center">End Date</th>
                                                        <th class="text-center">Number Allowed</th>
                                                        <th class="text-center">Venue</th>
                                                        <th class="text-center">Image</th>
                                                        <th class="text-center">video</th>
                                                        <th class="text-center">Location Image</th>
                                                        <th class="text-center">Location Video</th>';

                                                        echo'<th class="text-center">Detail</th>
                                                        <th class="text-center">Edit</th>
                                                        <th class="text-center">Delete</th></tr>';
                                                }
                                            ?>
                                            </thead>

                                            <?php
                                                    $result = $db->get_museais();

                                                    foreach($result as $post){
                                                    echo'<tbody>';
                                                    echo'<tr class="text-center">
                                                        <td>' . $post["idmuseai"] . '</td>
                                                        
                                                        <td>' . $post["name"] . ' </td>

                                                        <td>' . $post["datestart"] . '</td>

                                                        <td>' . $post["dateend"] . '</td>

                                                        <td>' . $post["numberallowed"] . ' </td>

                                                        <td>' . ($db->get_Venue($post["venue"]))["name"] . '</td>
                                                        
                                                        <td>' . $post["image"] . ' </td>
                                                        
                                                        <td>' . $post["location_image"] . '</td> 

                                                        <td>' . $post["video"] . ' </td>

                                                        <td>' . $post["location_video"] . '</td>';
                                                        
                                                        //attendee only
                                                        if($_SESSION['userRole'] == 3){
                                                                // echo'<td class="pt-3-half">
                                                                // <span class="table-remove"><label type="button" class="btn btn-success">Edit</label></span>
                                                                // </td>';
                                                        }
                                                        else{

                                                                echo'<td>
                                                                <a type="button" class="btn btn-success" href="Detail.php?id=' . $post["idmuseai"] . '">Detail</a>
                                                                </td>';

                                                                echo'<td>
                                                                <a type="button" class="btn btn-success" href="edit_museai.php?id=' . $post["idmuseai"] . '">Edit</a>
                                                                </td>';
                                                            }


                                                        if($_SESSION['userRole'] == 3){
                                                                // echo'<td class="pt-3-half">
                                                                // <span class="table-remove"><label type="button" class="btn btn-danger btn-rounded btn-sm my-0">Delete</label></span>
                                                                // </td>';
                                                            }
                                                        else{
                                                                echo'<td>
                                                                    <a type="button" class="btn btn-danger btn-rounded btn-sm my-0" href="museais.php?deleteEvent=true&id= ' . $post["idmuseai"] . '">Delete</a>
                                                                    </td>';
                                                            }

                                                        $atteending = false;
                                                        $username = $db->get_Registration_museais($_SESSION['id']);
                                                        foreach($username as $register){
                                                            if($result['idmuseai'] == $post['idmuseai']){   
                                                            //Delete session
                                                                echo 
                                                                    '<li class="nav-item">
                                                                        <a class="nav-link active" href="museais.php?deleteAttendingEvent=true&id' .$post["idmuseai"] . '">
                                                                            <span data-feather="home"></span>
                                                                                Stop attending on Event<span class="sr-only">(current)</span>
                                                                        </a>
                                                                    </li>';

                                                                    echo'<span class="table-remove">
                                                                    <a class="nav-link active" href="events.php?attendEvent=true&id' .$post["idmuseai"] . '">
                                                                        <span data-feather="home"></span>Stop attending on Event<span class="sr-only">(current)</span>
                                                                    </a>
                                                                    <button type="button" class="btn btn-danger btn-rounded btn-sm my-0">Remove</button></span>';
                                                                $atteending = true;
                                                            } 
                                                        }
                                                echo' </tbody>';
                                                }// close get_Events() 
                                            ?>
                                        </table>
                                </div>
                            </div>
                        </div>


                      <br>
                      <br>
                      <div class="clearfix">
                          <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div> <br>
                          <ul class="pagination">
                              <li class="page-item disabled"><a href="#">Previous</a></li>
                              <li class="page-item"><a href="#" class="page-link">1</a></li>
                              <li class="page-item"><a href="#" class="page-link">2</a></li>
                              <li class="page-item active"><a href="#" class="page-link">3</a></li>
                              <li class="page-item"><a href="#" class="page-link">4</a></li>
                              <li class="page-item"><a href="#" class="page-link">5</a></li>
                              <li class="page-item"><a href="#" class="page-link">Next</a></li>
                          </ul>
                      </div>
                  </div>
              </div>        
            
        </main>
      </div>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../../../assets/js/vendor/popper.min.js"></script>
    <script src="../../../../dist/js/bootstrap.min.js"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>

    <!-- Graphs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script>
      var ctx = document.getElementById("myChart");
      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
          datasets: [{
            data: [15339, 21345, 18483, 24003, 23489, 24092, 12034],
            lineTension: 0,
            backgroundColor: 'transparent',
            borderColor: '#007bff',
            borderWidth: 4,
            pointBackgroundColor: '#007bff'
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: false
              }
            }]
          },
          legend: {
            display: false,
          }
        }
      });
    </script>
  </body>
</html>