<?php  
session_start();
if( empty($_SESSION['id_admin']) ) {
	header("Location: index.php");
	exit();
}
require_once("../db.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Job Portal</title>
    
    <link rel="icon" href="https://sg-files.hostinger.co.id/handler.php?action=download?action=download&path=%2Fpublic_html%2Fassets%2Flogo.png" type="image/ico" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <header>
      
      <!-- NAVIGATION BAR -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="../index.php">Job Portal</a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
              <li><a href="profile.php">Profile</a></li>
              <li><a href="../logout.php">Logout</a></li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>

    </header>

  <div class="container-fluid">

    <div class="row">
      <div class="col-md-4">
        <div class="list-group">
          <a href="dashboard.php" class="list-group-item">Dashboard</a>
          <a href="#" class="list-group-item active">Users</a>
          <a href="company.php" class="list-group-item">Company</a>
          <a href="job-posts.php" class="list-group-item">Job Posts</a>
        </div>
      </div>

      <div class="col-md-6">

      <!-- SESSION USER DELETE SUCCESS -->
      <?php if( isset($_SESSION['usersDeleteSuccess']) ) { ?>
      <div class="row">
        <div class="col-md-12 successMessage">
          <div class="alert alert-danger">
            User Deleted Successfully !
          </div>        
        </div>
      </div>
      <?php  
      unset($_SESSION['usersDeleteSuccess']); }
      ?>

      <?php  

      $sql = "SELECT * FROM users";
      $result = $conn->query($sql);
      if( $result->num_rows > 0 ) {

        echo'<h3>Total Users : '. $result->num_rows . '</h3>';
      
      } ?>      

        <table class="table">
          <thead>
            <th>No.</th>
            <th>FirstName</th>
            <th>LastName</th>
            <th>Email</th>
            <th>Address</th>
            <th>Action</th>
          </thead>

          <tbody>
            <?php  

            $sql = "SELECT * FROM users";
            $result = $conn->query($sql);
            if( $result->num_rows > 0 ) {
              $i = 0;
              while( $row = $result->fetch_assoc() ) { ?>

              <tr>
                <td><?= ++$i; ?></td>
                <td><?= $row['firstname']; ?></td>
                <td><?= $row['lastname']; ?></td>
                <td><?= $row['email']; ?></td>
                <td><?= $row['address']; ?></td>
                <td><a style="color:red" href="delete-user.php?id=<?= $row['id_user']; ?>">Delete</a></td>
              </tr>

            <?php }
                }
            ?>

          </tbody>
        </table>
      </div>
    </div>

  </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script type="text/JavaScript">
      $(function() {
        $(".successMessage:visible").fadeOut(2000);
      });
    </script>


  </body>
</html>