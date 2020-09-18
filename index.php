<!--using any part of source code of this website is illegal if found legal action will be taken-->

<?php require_once("includes/DB.php"); ?>
<?php require_once("includes/Functions.php"); ?>
<?php require_once("includes/Sessions.php"); ?>

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
    <title>CanLearn</title>
<style media="screen">
  .heading{
font-family: 'Times New Roman', Times, serif;
font-weight: bold;
color: #005E90;
  }

  .heading:hover{
      color: #000;
  }



</style>

  </head>
  <body class="bg-dark">
    <!-- NAVBAR -->

      <nav class="navbar navbar-expand-lg navbar-dark" >
       <div class="container text-center">
       <a href="index.php">
            <h4 class="text-center text-white"></i><img src="includes/images/00.png" alt="CanLearn"></h4>
            </a>
     <script async src="https://cse.google.com/cse.js?cx=000888210889775888983:pqb3ch1ewhg"></script>
                      <div class="gcse-searchbox-only" target="_blank" data-resultsUrl="https://www.google.com/search?rlz=1C1GCEJ_enIN893IN893&sxsrf=ALeKk03cac4XnCHJQRmpDk0ve1T1uj7PNw%3A1598535638127&ei=1rdHX6S2B9nA3LUPr8m52AY&q=site%3A+https%3A%2F%2Fyerry.xyz%2F&oq=site%3A+https%3A%2F%2Fyerry.xyz%2F&gs_lcp=CgZwc3ktYWIQDDoECCMQJzoECAAQDToGCAAQCBAeUMiXA1i2vQNgiOIDaABwAHgAgAGrAYgBnQySAQQwLjEwmAEAoAEBqgEHZ3dzLXdpesABAQ&sclient=psy-ab&ved=0ahUKEwik-fumwbvrAhVZILcAHa9kDmsQ4dUDCA0"></div>
                 </form>

            </div>
       </form>
    </ul>


                 </div>
             </div>
           </nav>
            <div class="bg-dark" style="height:4px;background:#000000; "></div>



            <!-- HEADER -->
             <div class="container">
                  <div class="row mt-4">
           <!--Main Area -->           <!--Main Area -->

                       <div class="col-sm-8 mb-5 bg-dark" lang="uk">




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

                            }elseif (isset($_GET["page"])) {
                                 $Page = $_GET["page"];
                                  $ShowPostFrom=($Page*12)-12;
                                 $sql = "SELECT * FROM posts ORDER BY id desc LIMIT $ShowPostFrom,12";
                                 $stmt=$ConnectingDB->query($sql);
                                 // code...
                            }
                           //The default sql query
                            else{ $sql = "SELECT * FROM posts ORDER BY id desc";
                                  $stmt = $ConnectingDB->query($sql);
                              }
                            while($DataRows = $stmt->fetch()) {
                                 $PostId = $DataRows["id"];
                               $DateTime = $DataRows["datetime"];
                                   $Pnno = $DataRows["number"];
                              $PostTitle =$DataRows["title"];
                               $ADMIN    =$DataRows["author"];
                               $Image    =$DataRows["image"];
                               $PostDescription =$DataRows["post"];

                          ?>
                          <a href="FullPost.php?id=<?php echo $PostId ?>">
                                <div class="card " style="width:100%;border-radius: 5px;"  >
                                     <div class="card-body bg-dark text-white">
                                    <img src="upload/<?php echo htmlentities($Image); ?>" style="max-height:130px; border-radius:25px; " class="image-fluid card-image-top inline"/>


                                         <h4 class="card-title " style=" float:right;"> <?php echo htmlentities($PostTitle); ?></h4>
                                         <br><hr>
                                         <small class="text-muted" style="float:right;"> By <?php echo htmlentities($ADMIN); ?> On <?php echo htmlentities($DateTime); ?> </small>
                                         <a href="FullPost.php?id=<?php echo $PostId ?>" style="float:right;">
                                              <i class="btn btn-primary btn-lg fas fa-chalkboard-teacher mt-5">Lets Learn!! >> </i>
                                        </a>
                                   </div>



                            </div><hr><br>
                          <br> <br><?php } ?><br><br><hr><hr></a>
                          <nav>
                              <!--<ul class="pagination pagination-lg">


                              <li class="page-item">
                                   <a class="page-link" href="index.php?page=1">01</a>
                              </li>
                              <li class="page-item">
                                   <a class="page-link" href="index.php?page=2">02</a>
                              </li>
                              <li class="page-item">
                                   <a class="page-link" href="index.php?page=3">03</a>
                              </li>
                              <li class="page-item">
                                   <a class="page-link" href="index.php?page=4">04</a>
                              </li>
                              <li class="page-item">
                                   <a class="page-link" href="index.php?page=5">05</a>
                              </li>
                              <li class="page-item">
                                   <a class="page-link" href="index.php?page=6">06</a>
                              </li>
                              <li class="page-item">
                                   <a class="page-link" href="index.php?page=7">07</a>
                              </li>
                              <li class="page-item">
                                   <a class="page-link" href="index.php?page=8">08</a>
                              </li>
                              <li class="page-item">
                                   <a class="page-link" href="index.php?page=9">09</a>
                              </li>
                              <li class="page-item">
                                   <a class="page-link" href="index.php?page=10">10</a>
                              </li> <br><br> </ul>

                              <ul class="pagination pagination-lg">

                              <li class="page-item">
                                   <a class="page-link" href="index.php?page=11">11</a>
                              </li>
                              <li class="page-item">
                                   <a class="page-link" href="index.php?page=12">12</a>
                              </li>
                              <li class="page-item">
                                   <a class="page-link" href="index.php?page=13">13</a>
                              </li>
                              <li class="page-item">
                                   <a class="page-link" href="index.php?page=14">14</a>
                              </li>
                              <li class="page-item">
                                   <a class="page-link" href="index.php?page=15">15</a>
                              </li>
                              <li class="page-item">
                                   <a class="page-link" href="index.php?page=16">16</a>
                              </li>
                              <li class="page-item">
                                   <a class="page-link" href="index.php?page=17">17</a>
                              </li>
                              <li class="page-item">
                                   <a class="page-link" href="index.php?page=18">18</a>
                              </li>
                              <li class="page-item">
                                   <a class="page-link" href="index.php?page=19">19</a>
                              </li>
                              <li class="page-item">
                                   <a class="page-link" href="index.php?page=20">20</a>
                              </li>


                         </ul>-->

                     </nav>
               <br> </div><br>

               </a>

                     <!--Main Area End -->
                     <div class="  col-sm-4 mb-5 bg-dark">
                          <div class="card mt-5 bg-dark">
                               <div class="card-body bg-dark">
                                    <img src="images/1.jpg" class="d-block img-fluid mb-3" style="height:650px;" alt="">
<div class="text-center bg-dark text-white">
<h2>
<img src="includes/images/00.png" alt="CanLearn">
</h2>
<br>

 <br><br><br>

<br>
                               </div>
<div class="card">
<div class="card-header bg-primary text-light">

<h2 class="lead text-center">New skills</h2>
               </div>
<div class="card-body">
     <?php
     global $ConnectingDB;
     $sql =  "SELECT * FROM category ORDER BY id desc";
     $stmt = $ConnectingDB->query($sql);
     while ($DataRows = $stmt->fetch()) {
          $CategoryId = $DataRows["id"];
          $CategoryName =$DataRows["title"];

     ?>
     <a href="index.php?category=<?php echo $CategoryName; ?>"><span class="heading"><?php echo $CategoryName?></span><br><br></a>
     <?php }?>

</div>




</div>
                          </div>
                          <br>

                     </div>
                </div>
                     </div>
                  </div>

             <!--HEADER END-->

              <!-- MAIN AREA -->


</div>








                <!-- END MAIN AREA -->
           <!-- FOOTER -->
           <footer class=" text-white" style="background: #000000; width:100%">
          <div class="container" >
            <div class="row">
              <div class="10column">
                   <div class="" align="center" style="margin-left:55px">
                        <a href="https://www.instagram.com/_candede/?hl=en">
                        <p class="text-white"><img style="width:35px;" src="includes/images/1.png" alt="Instagram">
                        Follow us on instagram</p><br><hr><br>
                        </a>
                   </div>
                </div>




              <br><hr>


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
