<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.min.css") ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap-theme.min.css") ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/css/mystyle.css") ?>">

  <script src="<?php echo base_url("assets/js/jquery-1.11.2.min.js") ?>"></script>
  <script src="<?php echo base_url("assets/js/bootstrap.min.js") ?>"></script>
  <title>Login</title>
</head>
<body background="<?php echo base_url("assets/img/bg-rep.jpg");?>">
  <div class="container vertical-center"> 
    <div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
      <form class="form-signin" method="post" action="<?php echo site_url("welcome/login_user");?>">
        <h2 class="form-signin-heading">Please login</h2>
        <input type="email" name="email" class="vertical-margin form-control" placeholder="Email address" required>
        <input type="password" name="password" class="vertical-margin form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
      </form>
      <div class="start-link">Don't have account <a href="<?php echo site_url("welcome/signin");?>">sign in</a></div>
    </div>
  </div>
</body>
</html>