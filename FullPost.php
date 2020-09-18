<?php require_once("includes/DB.php"); ?>
<?php require_once("includes/Functions.php"); ?>
<?php require_once("includes/Sessions.php"); ?>

<?php $SearchQueryParameter= $_GET["id"] ?>

<?php

global $ConnectingDB;

if(isset($_POST["Submit"])){
  $Name = $_POST["CommenterName"];
  $Email = $_POST["CommenterEmail"];
  $Comment = $_POST["CommenterThoughts"];

  date_default_timezone_set("Asia/Karachi");
  $CurrentTime=time();
  $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);

if(empty($Name)||empty($Email)||empty($Comment)){
    $_SESSION["ErrorMessage"] = "All Feilds Must Filled Out";
      Redirect_to("FullPost.php?id={$SearchQueryParameter}");
}elseif (strlen($Comment)>600) {
    $_SESSION["ErrorMessage"] = "Comment lenght should not be greater than 600 characters";
     Redirect_to("FullPost.php?id={$SearchQueryParameter}");
  }else{
    // Query to insert Comment in DB When everything is fine
    global $ConnectingDB;
    $sql = "INSERT INTO comments(datetime,name,email,comment,approvedby,status,post_id)";
    $sql .= "VALUES(:dateTime,:name,:email,:comment,'Pending','OFF',:postIdFromURL)";
    $stmt = $ConnectingDB->prepare($sql);
   $stmt->bindValue(':dateTime',$DateTime);
   $stmt->bindValue(':name',$Name);
   $stmt->bindValue(':email',$Email);
    $stmt->bindValue(':comment',$Comment);
     $stmt->bindValue(':postIdFromURL',$SearchQueryParameter);
    $Execute=$stmt->execute();
    $_SESSION["SuccessMessage"] = "Comment Added Successfully";
     Redirect_to("FullPost.php?id={$SearchQueryParameter}");
     $_SESSION["ErrorMessage"] = "oops!! Something went wrong";
      Redirect_to("FullPost.php?id={$SearchQueryParameter}");

  }
} //Ending of Submit Button If-Condition
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
    <title>Lets Go!!</title>
  </head>
  <body class="bg-dark">
    <!-- NAVBAR -->

      <nav class="navbar navbar-expand-lg navbar-dark" >
       <div class="container text-center" >
       <a href="index.php" class="brandName" >
            <h4 align="center" class="text-center text-white" style=""><img src="includes/images/00.png" alt="CanLearn"></h4>
            </a>
     <script async src="https://cse.google.com/cse.js?cx=000888210889775888983:pqb3ch1ewhg"></script>
                      <div class="gcse-searchbox-only" data-resultsUrl="https://www.google.com/search?rlz=1C1GCEJ_enIN893IN893&sxsrf=ALeKk03cac4XnCHJQRmpDk0ve1T1uj7PNw%3A1598535638127&ei=1rdHX6S2B9nA3LUPr8m52AY&q=site%3A+https%3A%2F%2Fyerry.xyz%2F&oq=site%3A+https%3A%2F%2Fyerry.xyz%2F&gs_lcp=CgZwc3ktYWIQDDoECCMQJzoECAAQDToGCAAQCBAeUMiXA1i2vQNgiOIDaABwAHgAgAGrAYgBnQySAQQwLjEwmAEAoAEBqgEHZ3dzLXdpesABAQ&sclient=psy-ab&ved=0ahUKEwik-fumwbvrAhVZILcAHa9kDmsQ4dUDCA0"></div>
                 </form>

            </div>
       </form>
    </ul>


                 </div>
             </div>
           </nav>
            <div class="bg-dark" style="height:10px;background:#000000; "></div>



            <!-- HEADER -->
             <div class="container">
             <div class="row mt-4"
           <!--Main Area -->
                       <div class="col-sm-11 mb-5" >

                            <?php
                            echo ErrorMessage();
                            echo SuccessMessage();
                            ?>
                            <?php
                             global $ConnectingDB;
                             //sql query when search button is active
                            if(isset($_GET["SearchButton"])){
                                 $Search = $_GET["Search"];
                                 $sql = "SELECT * FROM posts
                                 WHEN datetime LIKE :search
                                  OR title LIKE :search
                                   OR category LIKE :search";
                                   $stmt = $ConnectingDB->prepare($sql);
                                   $stmt->bindvalue(':search','%'.$Search.'%');
                                   $stmt->execute();

                            }
                           //The default sql query
                            else{

                                 $PostIdFromURL = $_GET["id"];

            if (!isset($PostIdFromURL)) {
              $_SESSION["ErrorMessage"]="oops!!Bad Request !";
              Redirect_to("index.php?page=1");
            }
            $sql  = "SELECT * FROM posts  WHERE id= '$PostIdFromURL'";
            $stmt =$ConnectingDB->query($sql);
            $Result=$stmt->rowcount();
            if ($Result!=1) {
              $_SESSION["ErrorMessage"]="oops!!Bad Request !";
              Redirect_to("index.php?page=1");
            }

          }
          while ($DataRows = $stmt->fetch()) {
            $PostId          = $DataRows["id"];
            $DateTime        = $DataRows["datetime"];
            $PostTitle       = $DataRows["title"];
            $Category        = $DataRows["category"];
            $ADMIN        = $DataRows["author"];
            $Image           = $DataRows["image"];
            $PostDescription = $DataRows["post"];
                          ?>
                          <div class="card bg-dark text-white">

                               <img src="upload/<?php echo htmlentities($Image); ?>" class="image-fluid card-image-top"/ style="max-height:560px">
                               <div class="card-body ">
                                    <h4 class="card-title"> <?php echo htmlentities($PostTitle); ?></h4>
                                    <small class="text-muted"> By <?php echo htmlentities($ADMIN); ?> On <?php echo htmlentities($DateTime); ?> </small>
                                    <span style="float:right;" class="badge badge-primary text-height">Comments </span>
                                    <hr>
                                    <p class="card-text">
                                         <?php echo nl2br($PostDescription); ?></p>
                                         <div class="col-lg-6 mg-2 text-white" style="float:right;">
                                          <a href="index.php?id=1" style="float:right;"> <i class="fas fa-backward btn btn-danger btn-lg btn-block mb-1 mt-4" style="colour:#fff;">Go Back</a></i>
                                           </div>

                                         </div>
                               </div>

                      <?php } ?>
                      <!--Comment start-->
</div>

                     <br></div>
                     <br>
                      <div class="bg-dark">
                           <form class="bg-dark" action="FullPost.php?id=<?php echo $SearchQueryParameter; ?>" method="post">
                                <div class="card mb-3 bg-dark text-white">
                                        <div class="col-sm-9 mb-5" >
                                     <div class="card-header ">
                                          <h5 class="Feilddark">>>Share your thoughts about this course</h5>

                                     </div>
                                     <div class="card-body bg-dark">
                                          <div class="form-group">
                                               <div class="input-group">
                                                    <div class="input-group-prepend">
                                                         <span class="input-group-text"></span>

                                                    </div>


                                               <input class="form-control" type="text" name="CommenterName"  placeholder="Name" value="">
                                          </div>
                                          </div>
                                          <div class="form-group">
                                               <div class="input-group">
                                                    <div class="input-group-prepend">
                                                         <span class="input-group-text"></span>

                                                    </div>


                                               <input class="form-control" type="Email" name="CommenterEmail"  placeholder="Email" value="">
                                          </div>
                                          </div>
                                          <div class="form-group">
                                               <textarea name="CommenterThoughts" class="form-control" rows="6" cols="100">Hello Guys!</textarea>
                                          </div>
                                          <div class="mb-3 card-body bg-dark">
                                               <button  type="submit" name="Submit"  class="btn btn-primary btn-lg" style="float:right; "> Post my comment Badcow</button>

                                          </div>
                                     </div>

                                </div>
                           </form>

                           </div>
                      </div>
                      <div class="card bg-dark text-white text-center ">
<div class="card mb-3 bg-dark">
                     <span class="Feild bg-dark"><h2>See students opinion on this course</h2></span>

                     <?php
                     global $ConnectingDB;
                     $sql= "SELECT * FROM comments
                     WHERE post_id='$SearchQueryParameter'AND status='OFF'";
                     $stmt =$ConnectingDB->query($sql);
                     while ($DataRows = $stmt->fetch()) {
                     $CommentDate = $DataRows['datetime'];
                     $CommenterName = $DataRows['name'];
                     $CommentContent =$DataRows['comment'];

                     ?>
                     <div class="card mb-2 mt-2 bg-dark">

                     <div  class="media bg-dark text-white  " >

                     <img class="d-block img-fluid" src="images/123.jpg "style="max-height:60px;float:right;" alt="">
                     <div class="media-body">

                                           <h6 class="lead"><?php echo $CommenterName; ?></h6>
                     <p class="small"><?php echo $CommentDate; ?></p><a href="FullPost.php?id=<?php echo $PostId ?>" style="float:right;">

                     <p><?php echo $CommentContent; ?></p>

                     <span class="btn btn-primary ">Go back</span>

                    </a>
                    <br>
                    <br><br>
                    <a href="index.php" style="float:right;">
                      <span class="btn btn-danger text- text white">Let's go to home page </span>
                    </a>
                     </div>
                     </div>
                     <?php } ?>
                      <!--Featch existing Comments-->
                         <!--Fetch existing comment end-->

</div>
                     <!--Main Area End -->


                          <br>

                     </div>
                    </div>
                     </div>
                    </div>

                    <!--HEADER END-->

                    <!-- MAIN AREA -->










                    <!-- END MAIN AREA -->
                    <!-- FOOTER -->
                    <footer class="bg-dark text-white">
                    <div class="container">
                    <div class="row">
                    <div class="12column">

                    </div>

                    <br>



                    </div><br><br><br>
                    <p class="lead text-center">Theme By | <img src="includes/images/0.png" alt="CanLearn"> | <span id="year"></span> &copy; -----ALL RIGHTS RESERVED </p>
                    <br> <p class="text">

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
