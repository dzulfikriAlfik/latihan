<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>How to Add Google Captcha in PHP Registration Form</title>
   <!-- CSS -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
   <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
   <div class="container">

      <div class="row">
         <div class="col"></div>
         <div class="col-6">
            <div class="card">
               <div class="card-header text-center">
                  Add Google Captcha To Registration Form in PHP
               </div>
               <div class="card-body">
                  <form action="validate-captcha.php" method="post">
                     <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" name="name" class="form-control" id="name" required="">
                     </div>
                     <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" required="">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                     </div>
                     <div class="form-group">
                        <label for="exampleInputEmail1">Password</label>
                        <input type="password" name="password" class="form-control" id="password" required="">
                     </div>
                     <div class="form-group">
                        <label for="exampleInputEmail1">Confirm Password</label>
                        <input type="password" name="cpassword" class="form-control" id="cpassword" required="">
                     </div>
                     <div class="g-recaptcha" data-sitekey="6LdhOtMgAAAAAGY68FcUHneoWUowezEQHMVreovX"></div>
                     <br>
                     <input type="submit" name="submit" class="btn btn-primary">
                  </form>
               </div>
            </div>
         </div>
         <div class="col"></div>
      </div>

   </div>
</body>

</html>