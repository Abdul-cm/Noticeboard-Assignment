<?php session_start();
//error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['newuid']==0)) {
  header('location:logout.php');
  } else{
if(isset($_POST['submit']))
{
$posttitle=$_POST['title'];
$postdetails=$_POST['content'];
$pid=$_GET['pid'];
$query=mysqli_query($con,"update posts set title='$posttitle',content='$postdetails' where postid='$pid'");
if($query)
{

echo "<script>alert('Post updated successfully.');</script>";
}
else{
echo "<script>alert('Something went wrong. Please try again.');</script>"; 
} 

}

?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>News Portal | Add Posts</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/modern-business.css" rel="stylesheet">
<style type="text/css">
  .custom{
  margin-top:2%;
}
</style>
<style type="text/css">
  body {
  padding: 25px;
  background-color: white;
  color: black;
}

.dark-mode {
  background-color: black;
  color: white;
}
</style>
  </head>

  <body>

    <!-- Navigation -->
    <?php include('includes/header.php');?>
    <!-- Page Content -->
    <div class="container">

      <h1 class="mt-4 mb-3">Edit Posts</h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Home</a>
        </li>
        <li class="breadcrumb-item active">Edit Posts</li>
      </ol>

      <!-- Intro Content -->
      <div class="row">

        <div class="col-lg-12">
          <?php
$pid=$_GET['pid'];
$query=mysqli_query($con,"select * from posts where postid='$pid'");
while ($row=mysqli_fetch_array($query)) {
?>
<form  method="post" enctype="multipart/form-data">
   

<div class="row custom">
<div class="col-2 col-offset-1">Post Title</div>
<div class="col-6 col-offset-1">
<input type="text" class="form-control" name="title" required="true" value="<?php echo ($row['title']);?>">
</div>
</div>

<div class="row custom">
<div class="col-2 col-offset-1">Post Content</div>
<div class="col-6 col-offset-1">
<textarea type="text" class="form-control" name="content" required="true" rows="10"><?php echo htmlentities($row['content']);?></textarea>
</div>
</div>
<div class="row custom">
<div class="col-2 col-offset-1">Post Image</div>
<div class="col-6 col-offset-1">
            <?php if($row['image']==''):?>
 <img class="img-fluid rounded" src="postimages/no-image.png" alt="<?php echo htmlentities($row['title']);?>" height="350">
<?php else: ?>
 <img class="img-fluid rounded" src="postimages/<?php echo htmlentities($row['image']);?>" alt="<?php echo htmlentities($row['title']);?>">
<?php endif; ?>
<a href="change-image.php?pid=<?php echo $row['postid'];?>">Update Image</a>
</div>
</div>


<div class="row custom">

<div class="form-group col-md-6" align="center">
                <button type="submit" value="submit" name="submit" class="btn btn-primary">Update now</button>
              </div>
</div>
          </div>

</form>
<?php } ?>
        </div>
      </div>
      <!-- /.row -->
    
    </div>
    <!-- /.container -->

    <!-- Footer -->
 <?php include('includes/footer.php');?>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
<?php } ?>