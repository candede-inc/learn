<?php require_once("includes/DB.php"); ?>
<?php require_once("includes/Functions.php"); ?>
<?php require_once("includes/Sessions.php"); ?>
<?php
global $ConnectingDB;
if(isset($_POST["Submit"])){
 $PostTitle = $_POST["PostTitle"];
 $Pnno      = $_POST["number"];
 $Category  = $_POST["Category"];
 $Image     = $_FILES["Image"]["name"];
 $Target    = "upload/".basename($_FILES["Image"]["name"]);
 $PostText  = $_POST["PostDescription"];
$ADMIN = "Badki";
date_default_timezone_set("Asia/Karachi");
$CurrentTime=time();

$DateTime=strftime( "%Y/%m/%d %H:%M:%S",$CurrentTime);
global $ConnectingDB;
if(empty($PostTitle)){
  $_SESSION["ErrorMessage"]= ("Sorry!! Title cannot be empty");
  Redirect_to("AddNewPost.php");

}elseif (strlen($PostTitle)<5) {
    $_SESSION["ErrorMessage"]= "Post Title should be more than 1 characters";
    Redirect_to("AddNewPost.php");
}
  elseif (strlen($PostText)>14999) {
    $_SESSION["ErrorMessage"]= "Description should not be more than 15000 characters";
    Redirect_to("AddNewPost.php");
  }

  else {
    //Query to insert Post in DB when everything is fine
    global $ConnectingDB;
    $sql = "INSERT INTO posts(datetime, title, number, category, author, image, post)";
    $sql .= "VALUES(:dateTime,:postTitle,:number,:categoryName,:adminName,:imageName,:postDescription)";
    $stmt = $ConnectingDB->prepare($sql);
    $stmt -> bindValue(':dateTime',$DateTime);
      $stmt -> bindValue(':postTitle',$PostTitle);
      $stmt -> bindValue(':number',$Pnno);
      $stmt -> bindValue(':categoryName',$Category);
      $stmt -> bindValue(':adminName',$ADMIN);
      $stmt -> bindValue(':imageName',$Image);
      $stmt -> bindValue(':postDescription',$PostText);
      $Execute=$stmt->execute();
      move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);


      if($Execute){
        $_SESSION["SuccessMessage"]="Fantastic!! Post with id : " .$ConnectingDB->lastInsertId()." added Successfully";
        Redirect_to("AddNewPost.php");
      }else {  $_SESSION["ErrorMessage"]= "oops!! Something went wrong . Please Try Again";
        Redirect_to("AddNewPost.php");

      }
  }

}
 // ENDING OF SUBMIT BUTTON IF-CONDITION
      ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <link rel="stylesheet" href="/css/Styles.css">
    <title> Categories </title>
  </head>
  <body>
    <!-- NAVBAR -->
  <div style="height:10px; background:#27aae1;"></div>
    <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
      <div class="container">
        <a href="#" class="navbar-brand "> <img src="includes/images/00.png" alt="CanLearn"></a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
         <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarcollapseCMS">


               </div>
            </div>
         </nav>
          <div style="height:10px; background:#27aae1;"></div>
            <!-- NAVBAR END -->
            <!-- HEADER -->
             <header class="bg-dark text-white py-4">
               <div class="container">
                 <div class="row">
                  <div class="col-md-12">

                   <h1><i class="fas fa-edit" style="colour:#27aae1;"></i>Add New Post</h1>
                    </div>
                 </div>
               </div>
             </header>
             <!--HEADER END-->

              <!-- MAIN AREA -->
          <section class="container py-2 mb-4 ">
            <div class="row">
              <div class="offset-lg-1 col-lg-10 " style="min-height:550px;">
                <?php
                echo ErrorMessage();
                echo SuccessMessage();
                ?>
                 <form class="" action="AddNewPost.php" method="post" enctype="multipart/form-data">
                   <div class="card bg-danger text-light">
                     <div class="card-header">
                      <h7 class="text-white text-center"><img src="includes/images/00.png" alt="CanLearn"></h7>
                     </div>
                     <div class="card-body  bg-dark">
                       <div class="form-group">
                         <label for="title"><span class="FeildInfo"> Post Title:</span></label>
                         <input class="form-control" type="text" name="PostTitle" id="title" placeholder="Type Title Here" value="">
                       </div>
                       <div class="form-group">
                         <label for="number"><span class="FeildInfo"> Mobile Number:</span></label>
                         <input class="form-control" type="number" name="number" id="number" placeholder="Your Mobile no_" value="">
                       </div>
                       <div class="form-group">
                         <label for="CategoryTitle"><span class="FeildInfo"> Choose Category:</span></label>
                        <select class="form-control" id="CategoryTitle" name="Category">
                          <?php
                          //Fetching all the Category from Category Table
                          global $ConnectingDB;
                          $sql = " SELECT id,title FROM category";
                          $stmt = $ConnectingDB->query($sql);
                          while ($DataRows = $stmt->fetch()) {
                            $Id = $DataRows["id"];
                            $CategoryName = $DataRows["title"];
                            ?>
                          <option> <?php echo $CategoryName; ?>   </option>
                          <?php } ?>
                        </select>
                       </div>
                       <div class="form=group mb-3">
                       <div class="custom-file">
                         <input class="custom-file-input" type="file" name="Image" id="imageSelect" value="">
                         <label for="imageSelect" class="custom-file-label">Select Image</label>
                          </div>
                       </div>
                       <div class="form-group mt-5">
                         <label for="Post"><span class="FeildInfo"> Post:</span></label>
                         <textarea class="form-control" id="Post" name="PostDescription" rows="8" cols="80"></textarea>
                       </div>

                       <div class="row">
                         <div class="col-lg-6 mg-2">
                           <a href="Dashboard.php" class="btn btn-warning btn-block mb-5">Go</a>
                            </div>
                             <div class="col-lg-6 mg-2">
                              <button  type="submit" name="Submit" class="btn btn-success btn-block mb-5">Publish
                              </button>
                       </div>
                     </div>
                   </div>
                 </form>
              </div>

            </div>
          </section>








                <!-- END MAIN AREA -->
           <!-- FOOTER -->
           <footer class="bg-dark text-white">
          <div class="container">
            <div class="row">
              <div class="12column">

              </div>
              <p class="lead text-center"><h2>Theme By | <img src="includes/images/00.png" alt="CanLearn"> |</h2> <span id="year"></span> &copy;<h3>-----ALL RIGHTS RESERVED</h3>  </p>
              <p class="text-center"></p>
                <h6>DS</h>
               </a>
              </p>
            </div>
          </footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script>
  $('#year').text(new Date().getFullYear())
</script>
</body>
</html>
