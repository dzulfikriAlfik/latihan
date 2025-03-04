<?php  
session_start();
require_once("db.php");
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

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/1.10.19/features/searchHighlight/dataTables.searchHighlight.css">

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
            <a class="navbar-brand" href="index.php">Job Portal</a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <ul class="nav navbar-nav navbar-right">
            <?php  
            if( isset($_SESSION['id_user']) ) : ?>
              <li><a href="user/dashboard.php">Dashboard</a></li>
              <li><a href="logout.php">Logout</a></li>
            <?php else :
            if(isset($_SESSION['id_company']) ) : ?>
              <li><a href="company/dashboard.php">Dashboard</a></li>
              <li><a href="logout.php">Logout</a></li>
            <?php else : ?>
              <li><a href="admin/index.php">Admin</a></li>
              <li><a href="company.php">Company</a></li>
              <li><a href="register.php">Register</a></li>
              <li><a href="login.php">Login</a></li>
            <?php endif; 
            endif ?>
            </ul>

          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>

    </header>

    <!-- JUMBOTRON  -->
    <section>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="jumbotron text-center">
              <h1>Search Job</h1>
              <p>Find Your Dream Job</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- LATEST JOB POST -->
    <section>
      <div class="container">

        <div class="row">
          <div class="col-md-12">
            <form id="myForm" class="form-inline">
              <div class="form-group">
                <label>Experience</label>
                <select id="experience" class="form-control">
                  <option value="" selected="">Select Experience (Years)</option>
                  <?php  
                    $sql = "SELECT DISTINCT(experience) FROM job_post WHERE experience IS NOT NULL ORDER BY experience ";
                    $result = $conn->query($sql);
                    if( $result->num_rows > 0 ) {
                      while( $row = $result->fetch_assoc() ) {
                        echo "<option value'".$row['experience']."'>".$row['experience']."</option>"; 
                      }
                    }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label>Qualification</label>
                <select id="qualification" class="form-control">
                  <option value="" selected="">Select Qualification</option>
                  <?php  
                    $sql = "SELECT DISTINCT(qualification) FROM job_post WHERE qualification IS NOT NULL ORDER BY qualification ";
                    $result = $conn->query($sql);
                    if( $result->num_rows > 0 ) {
                      while( $row = $result->fetch_assoc() ) {
                        echo "<option value'".$row['qualification']."'>".$row['qualification']."</option>"; 
                      }
                    }
                  ?>
                </select>
              </div>
              <button class="btn btn-success">search</button> 
            </form>
          </div>
        </div>

        <div class="row" style="margin-top: 5%;">
          <div class="table-responsive">
            <table id="myTable" class="table">
              <thead>
                <th>Job Title</th>
                <th>Job Description</th>
                <th>Minimum Salary</th>
                <th>Maximum Salary</th>
                <th>Experience Required</th>
                <th>Qualification Required</th>
                <th>Action</th>
              </thead>

              <tbody>

              </tbody>
            </table>
          </div>
        </div>

      </div>
    </section>


        

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <script src="https://bartaz.github.io/sandbox.js/jquery.highlight.js"></script>

    <script src="https://cdn.datatables.net/plug-ins/1.10.15/features/searchHighlight/dataTables.searchHighlight.min.js"></script>

    <script type="text/JavaScript">
      $( function () {

        var oTable = $('#myTable').DataTable({
          "autoWidth" : false,
          "ajax" : {
            "url" : "refresh_job_search.php",
            "dataSrc" : "",
          "data" : function (d) {
              d.experience = $("#experience").val();
              d.qualification = $("#qualification").val();
            }
          }
        }); 

        oTable.on('draw', function() {
          var body = $(oTable.table().body());

          body.unhighlight();

          body.highlight(oTable.search());

        });

        $("#myForm").on("submit", function(e) {
          e.preventDefault();
          oTable.ajax.reload( null, false );
        });

      });
    </script>

  </body>
</html>