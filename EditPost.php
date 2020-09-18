<?php require_once("includes/DB.php"); ?>
<?php require_once("includes/Functions.php"); ?>
<?php require_once("includes/Sessions.php"); ?>

<?php
$SearchQueryParameter = $_GET['id'];
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
  Redirect_to("Posts.php");

}elseif (strlen($PostTitle)<5) {
    $_SESSION["ErrorMessage"]= "Post Title should be more than 1 characters";
    Redirect_to("Posts.php");
}
  elseif (strlen($PostText)>14999) {
    $_SESSION["ErrorMessage"]= "Description should not be more than 5000 characters";
    Redirect_to("Posts.php");
  }

  else {
    //Query to Update Post in DB when everything is fine
    global $ConnectingDB;
    if (!empty($_FILES["Image"])){
         $sql = "UPDATE posts SET title='$PostTitle',category='$Category',image= '$Image',post='$PostText'
       WHERE id='$SearchQueryParameter'";
 }else {
      $sql = "UPDATE posts SET title='$PostTitle',category='$Category',image= '$Image',

      post='$PostText'
   WHERE id='$SearchQueryParameter'";
 }

    $Execute =$ConnectingDB->query($sql);
      move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);


      if($Execute){
        $_SESSION["SuccessMessage"]="Fantastic!! Post with id : " .$ConnectingDB->lastInsertId()." updated Successfully";
        Redirect_to("Posts.php");
      }else {  $_SESSION["ErrorMessage"]= "oops!! Something went wrong . Please Try Again";
        Redirect_to("EditPost.php");}


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
    <title> Edit Post </title>
  </head>
  <body>
    <!-- NAVBAR -->
  <div style="height:10px; background:#27aae1;"></div>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
      <div class="container">
        <a href="#" class="navbar-brand "> <img src="includes/images/00.png" alt="CanLearn"> </a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
         <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarcollapseCMS">

          <ul class="navbar-nav mr-auto">

            <li class="nav-item">
               <a href="MyProfile.php" class="nav-link"><i class="fa fa-user-o" aria-hidden="true"></i> My Profile</a>
            </li>
            <li class="nav-item">
               <a href="Dashboard.php" class="nav-link">Dashboard</a>
            </li>
            <li class="nav-item">
               <a href="Posts.php" class="nav-link">Posts</a>
            </li>
            <li class="nav-item">
               <a href="category.php" class="nav-link">Categories</a>
            </li>
            <li class="nav-item">
               <a href="Admins.php" class="nav-link">Manage Admins</a>
            </li>
            <li class="nav-item">
               <a href="Comments.php" class="nav-link">Comments</a>
            </li>
            <li class="nav-item">
               <a href="Livenews.php" class="nav-link">LiveNews</a>
            </li>

           <ul>
            <li class="nav-item"><a href="Logout.php" class="nav-link text-danger" >Logout</a>
            </li>
        </ul>
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

                   <h1><i class="fas fa-edit" style="colour:#27aae1;"></i>Edit Post</h1>
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


               global $ConnectingDB;

               $sql = "SELECT * FROM posts WHERE id ='$SearchQueryParameter'";
               $stmt = $ConnectingDB->query($sql);
               while ($DataRows =$stmt->fetch()) {
               $TitleToBeUpdated = $DataRows['title'];

               $CategoryToBeUpdated = $DataRows['category'];
               $ImageToBeUpdated = $DataRows['image'];
               $PostToBeUpdated = $DataRows['post'];

               }
                ?>
                 <form class="" action="EditPost.php?id= <?php echo $SearchQueryParameter; ?>" method="post" enctype="multipart/form-data">
                   <div class="card bg-danger text-light">
                     <div class="card-header">
                      <h7><img src="includes/images/00.png" alt="CanLearn"></h7>
                     </div>
                     <div class="card-body  bg-dark">
                       <div class="form-group">
                         <label for="title"><span class="FeildInfo"> Post Title:</span></label>
                         <input class="form-control" type="text" name="PostTitle" id="title" placeholder="Type Title Here" value="<?php echo $TitleToBeUpdated; ?>">
                       </div>
                       <div class="form-group">
                         <label for="number"><span class="FeildInfo"> Mobile Number:</span></label>
                         <input class="form-control" type="number" name="number" id="number" placeholder="Your Mobile no_" value="">
                       </div>
                       <div class="form-group">
                            <span class="FieldInfo">Existing Category</span>
                            <?php echo $CategoryToBeUpdated; ?>
                            <br>
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
                            <span class="FieldInfo">Existing Image</span>
                            <img class="mb-4" src="upload/<?php echo $ImageToBeUpdated;?>" width="500px"; height="250px";>
                       <div class="custom-file">
                         <input class="custom-file-input" type="file" name="Image" id="imageSelect" value="">
                         <label for="imageSelect" class="custom-file-label">Select Image</label>
                          </div>
                       </div>
                       <div class="form-group">
                         <label for="Post"><span class="FeildInfo"> Post:</span></label>
                         <textarea class="form-control" id="Post" name="PostDescription" rows="8" cols="80">
                              <?php echo $PostToBeUpdated; ?>

                         </textarea>
                       </div>

                       <div class="row">
                         <div class="col-lg-6 mg-2">
                           <a href="Dashboard.php" class="btn btn-warning btn-block">Back to Dashboard</a>
                            </div>
                             <div class="col-lg-6 mg-2">
                              <button type="submit" name="Submit" class="btn btn-success btn-block">Lets Update
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
              <p class="lead text-center"><h2>Theme By | <img src="includes/images/0.png" alt="CanLearn"> |</h2> <span id="year"></span> &copy;<h3>-----ALL RIGHTS RESERVED</h3>  </p>
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
