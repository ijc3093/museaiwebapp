<?php

include('header.php');

  include('DB_Management.php');
  
  $db = new DB();
  
// Do not delete this....
  // if(isset($_POST['insertmuseai'])){

  //   //does  validation first
  //   $_POST['name'] = sanitize_input($_POST["name"]);
  //   $_POST['datestart'] = sanitize_input($_POST["datestart"]);
  //   $_POST['dateend'] = sanitize_input($_POST["dateend"]);
  //   $_POST['numberAllowed'] = sanitize_input($_POST["numberAllowed"]);
  //   $_POST['dropdown'] = sanitize_input($_POST["dropdown"]);
    

  //   // var_dump($_POST);
  //   $db->insert_museai(
  //     $_POST['name'], 
  //     $_POST['datestart'], 
  //     $_POST['dateend'], 
  //     $_POST['NumberAllowed'], 
  //     $_POST['dropdown'], 
  //     $_SESSION['userRole']
  //   );
  //   echo "<script>alert('museai saved');</script>";
  // }


  
//Do not delete this....
//   if(isset($_POST['upload'])){

//     //does  validation first
//     $_POST['name'] = sanitize_input($_POST["name"]);
//     $_POST['datestart'] = sanitize_input($_POST["datestart"]);
//     $_POST['dateend'] = sanitize_input($_POST["dateend"]);
//     $_POST['numberAllowed'] = sanitize_input($_POST["numberAllowed"]);
//     $_POST['dropdown'] = sanitize_input($_POST["dropdown"]);
//     $_POST['image'] = sanitize_input($_POST["image"]);
    
//     $file_name = $_POST['image'];
//     $file_name_video = $_POST['video'];
//     $file_temp = $_FILES['file']['tmp_name'];
//     $location_image = "upload/".$file_name;
//     $location_video = "upload/".$file_name;

//     if($file_size < 5242880){
//         if(move_uploaded_file($file_temp, $location_image)){
//             try{
//                 $db->insert_Event(
//                     $_POST['name'], 
//                     $_POST['datestart'], 
//                     $_POST['dateend'], 
//                     $_POST['NumberAllowed'], 
//                     $_POST['dropdown'], 
//                     $_POST['image'], 
//                     $location_image,
//                     $_POST['video'],
//                     $location_video,
//                     $_SESSION['userRole']
//                 );
//                 echo "<script>alert('Event saved');</script>";
//             }catch(PDOException $e){
//                 echo $e->getMessage();
//             }
            
//             $conn = null;
//             header('location: Insert_Manager.php');

//              //var_dump($_POST);
    
//         }
//     }else{
//         echo "<center><h3 class='text-danger'>File too large to upload!</h3></center>";
//     }
//   }



  //Do not delete this....
  if(isset($_POST['insertmuseai'])){
    $maxsize = 5929344; // 5MB        
    //$maxsize = 5929344;                   

    $file_name_video = $_POST['video'];
    $name = $_FILES['file']['name'];
    $location_image = "videos/".$file_name_video;
    $target_dir = "videos/".$file_name_video;

    // Select file type
    $videoFileType = strtolower(pathinfo($target_dir,PATHINFO_EXTENSION));

    // Valid file extensions
    $extensions_arr = array("mp4","avi","3gp","mov","mpeg");

    // Check extension
    if( in_array($videoFileType,$extensions_arr) ){
        
        // Check file size
        if(($_FILES["file"]["size"] = 0) || ($_FILES['file']['size'] >= $maxsize)) {
            echo "File too large. File must be less than 5MB.";
        }else{
            // Upload
            if(move_uploaded_file($_FILES['file']['tmp_name'],$target_dir)){
                // Insert record
                // $query = "INSERT INTO videos(name,location) VALUES('".$name."','".$target_file."')";

                $db->insert_museai(
                  $_POST['name'], 
                  $_POST['datestart'], 
                  $_POST['dateend'], 
                  $_POST['NumberAllowed'], 
                  $_POST['dropdown'], 
                  $_POST['image'], 
                  $location_image,
                  $_POST['video'],
                  $target_dir,
                  $_SESSION['userRole']
                );
            }
        }

    }else{
        echo "Invalid file extension.";
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

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Add New museais</h1>
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
          <div >
                <div class="col-md-8 order-md-1"><br><br>
                  <div class="col-lg-8 push-lg-4 personal-info"> 
                    <?php 
                            
                        $result = $db->get_Venues();
                          //var_dump($result);
                        echo'<form enctype="multipart/form-data" action="insert_museai.php"  method="post" role="form" id="createAccountFor" > 

                            <div class="form-group row">

                            <label class="col-lg-3 col-form-label form-control-label">Name</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="name" placeholder="" value="" required /><br>
                                </div>

                                <label class="col-lg-3 col-form-label form-control-label">Start Date</label>
                                <div class="col-lg-9">
                                    <input class="form-control" name="datestart" placeholder="" value="" required /><br>
                                </div>';


                                echo'<label class="col-lg-3 col-form-label form-control-label">End Date</label>
                                <div class="col-lg-9">
                                    <input class="form-control" name="dateend" placeholder="" value="" required /><br>
                                </div>';


                                echo'<label class="col-lg-3 col-form-label form-control-label">Number Allowed</label>
                                <div class="col-lg-9">
                                    <input class="form-control" name="NumberAllowed" placeholder="" value="" required/><br>
                                </div>';


                                echo'<label class="col-lg-3 col-form-label form-control-label">Capacity</label>
                                <div class="col-lg-9">
                                    <input class="form-control" name="capacity" placeholder="" value="" required/><br>
                                </div>';

                                // image
                                echo'<label class="col-lg-3 col-form-label form-control-label">Image</label>
                                <div class="col-lg-9">
                                    <input class="form-control" name="image" placeholder="" value="" required/><br>
                                </div>';

                                echo'<label class="col-lg-3 col-form-label form-control-label">Upload Image</label>
                                <div class="col-lg-9">
                                    <input name="file" type="file"  required="required" class="form-control"/><br>
                                </div>';

                                //video
                                echo'<label class="col-lg-3 col-form-label form-control-label">Video</label>
                                <div class="col-lg-9">
                                    <input class="form-control" name="video" placeholder="" value="" required/><br>
                                </div>';

                                echo'<label class="col-lg-3 col-form-label form-control-label">Upload Video</label>
                                <div class="col-lg-9">
                                    <input name="file" type="file"  required="required" class="form-control"/><br>
                                </div>';

                                echo'<label class="col-lg-3 col-form-label form-control-label">Venue</label>';
                                  $venue = '<select name="dropdown">';
                                  foreach($result as $post){
                                    $venue .= "<option value ='" .$post['idvenue'] . "'>" . $post['name'] . "</option>";
                                  }
                                  $venue .= '</select>';
                                  echo $venue;
                                echo'</div>';
                                // echo  '<button class="btn btn-primary btn-lg btn-block" type="submit" name="insertmuseai">Save</button>
                                // <hr class="mb-4">';  
                                
                                echo  '<button class="btn btn-primary" type="submit" name="insertmuseai">Submit</button>'; 
                    echo '<hr/></form>';  
                    ?>
                    </div>
                  </div>
                </main>
              </div>
            </div>
  </body>
</html>
