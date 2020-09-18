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
    <link rel="stylesheet" href="/css/Styles.css">
    <title>POSTS </title>
  </head>
  <body class="text-white text-center" style="background:#343a40;">
    <!-- NAVBAR -->

             <!--HEADER END-->

              <!-- MAIN AREA -->
              <section class="container py-2 mb-4 ">
               <div class="row">
                 <div class="offset-lg-1 col-lg-8 " style="min-height:550px;">
                      <a href="AddNewPost.php" class="btn btn-warning btn-block" style="width:500px; height:35px; border-radius:111111111px"><h6>AddNewPost</h6></a></div> <br>

                      <?php
                      echo ErrorMessage();
                      echo SuccessMessage();
                      ?>
               <table class="table table-striped table-hover">
                    <thead class="thead-dark mb-3">
                    <tr>
                         <th>#</th>
                         <th>Title</th>
                         <th>Category</th>
                         <th>Date&Time</th>
                         <th>Author</th>
                         <th>Banner</th>
                         <th>Comments</th>
                         <th>Action</th>
                         <th>Live Preview</th>
                    </tr>
                    </thead>
                    <?php
                    global $ConnectingDB;
                    $sql = "SELECT * FROM posts";
                    $stmt = $ConnectingDB->query($sql);
                         $Sr = 0;
                    while ($DataRows = $stmt->fetch()) {
                         $Id = $DataRows["id"];
                         $DateTime = $DataRows["datetime"];
                         $PostTitle = $DataRows["title"];
                         $Pnno = $DataRows["number"];
                         $Category = $DataRows["category"];
                         $ADMIN =    $DataRows["author"];
                         $Image=   $DataRows["image"];
                         $PostText   =   $DataRows["post"];
                         $Sr++;
                     ?>
                     <tbody>
                    <tr>
                         <td> <?php echo $Sr; ?></td>

                         <td class="table-danger text-white"> <?php if (strlen($PostTitle)>12){$PostTitle=substr($PostTitle,0,20).'..';}
                               echo $PostTitle; ?></td>
                         <td class="table-info"><?php  echo $Category; ?> </td>
                         <td class="table-warning"> <?php echo $DateTime; ?></td>
                         <td class="table-primary"> <?php echo $ADMIN; ?></td>
                         <td><img src="upload/<?php echo $Image;  ?>" width="170px;" height="120px" </td>
                         <td>Comments</td>
                         <td>
                              <div> <a href="EditPost.php?id=<?php echo $Id; ?>" class="btn btn-warning btn-block"><h6>Edit</h6></a></div>
                         <div> <a href="DeletePost.php?id=<?php echo $Id; ?>" class="btn btn-primary btn-block"><h6>Delete</h6></a></div>
                         </td>
                         <td><a href="FullPost.php?id=<?php echo $Id; ?>"target="_blank" class="btn btn-primary btn-block">Live Preveiw</a></td>
                    </tr>
               </tbody>
              <?php }  ?>
          </table>
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
              <p class="lead text-center">Theme By | <img src="includes/images/0.png" alt="CanLearn">  | <span id="year"></span> &copy; -----ALL RIGHTS RESERVED </p>
              <p class="text-center">


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
