<?php include_once("includes/session.php");?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>| Log in</title>
    <?php include_once("includes/head.php");?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
    <?php include_once("includes/notifications.php");?>
    <div class="full-width">
      <div class="login-box">
        <div class="login-logo">
          <span class="logo-lg"><b><img src="assets/img/OS_logo-01.png"  width="70%" style="padding:10px" /></b></span>
         <!-- <a href="index.php"><b style="color:#3c8dbc">Oral Swiss</b></a> -->
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body center">
          <p class="login-box-msg">Insira os seus dados</p>

          <form action="login-done.php" method="post">
            <div class="form-group has-feedback">
              <input type="text" class="form-control" name="nameUser" placeholder="Utilizador" required>
              <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
              <input type="password" class="form-control" name="pwUser" placeholder="Password" required>
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback hide">
              <input type="text" class="form-control" name="bot">
            </div>
            <div class="row">
              <!-- /.col -->
              <div class="col-xs-offset-2 col-xs-8 col-xs-onset-2">
                <button type="submit" class="btn btn-primary btn-block btn-flat" style="background:#3c8dbc;border:#3c8dbc">Entrar</button>
              </div>
              <!-- /.col -->
            </div>
          </form>
          <!-- /.social-auth-links -->

          <a class="hide" href="#">I forgot my password</a><br>
          <a href="register.html" class="text-center hide">Register a new membership</a>

        </div>
        <!-- /.login-box-body -->
      </div>
      <!-- /.login-box -->

      <!-- jQuery 2.2.3 -->
      <script src="assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
      <!-- Bootstrap 3.3.6 -->
      <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    </div>
  </body>
</html>
