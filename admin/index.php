<?php
/**
 * Created by PhpStorm.
 * User: oyetola
 * Date: 1/24/2018
 * Time: 3:31 AM
 */
require '../conn.php';
session_start();
if (isset($_POST['login'])){
    $df = $_POST['user'];
    $fd = $_POST['pword'];
    $hj =$_POST['bank'];
    $fr = $cn->query("SELECT * FROM admn where username='$df' AND password='$fd' AND bank='$hj'");
    if($fr->num_rows > 0) {
        $_SESSION['username'] = $df;
        echo "<script>window.location.href='aminhome.php';</script>";
    }else{
        echo "<script>alert('Wrong Login details Supplied.Try again!');</script>";
    }
}
if (isset($_POST['register'])){
    $bank = $_POST['bank'];
    $user = $_POST['username'];
    $pword = $_POST['pass'];
    $cpword = $_POST['cpass'];
    if ($cpword == $pword && $bank!= 'Select Bank') {
        $fr = $cn->query("INSERT INTO admn (`bank`, `username`, `password`) VALUES ('$bank','$user','$pword')");
        if ($fr){
            echo "<script>alert('Successfully registered. Please Login')</script>";
            echo "<script>window.location.href='index.php';</script>";
        }
    }
}
?>
<!DOCTYPE html>

<html>
<head>
<title>E-track</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
  <link rel="stylesheet" href="../layout/styles/bootstrap/bootstrap.css">
  <link rel="stylesheet" href="../layout/styles/bootstrap/css/bootstrap.min.css">
</head>
<body id="top">
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row0">
  <div id="topbar" class="hoc clear">
    <!-- ################################################################################################ -->
    <nav id="mainav" class="fl_left">
      <ul class="clear">
        <li class="active"><a href="index.html">Home</a></li>
        <li><a class="drop" href="#">Pages</a>
          <ul>
            <li><a href="#">Gallery</a></li>
            <li><a href="#">Settings</a></li>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- ################################################################################################ -->
    <div class="fl_right">
      <ul class="faico clear">
        <li><a class="faicon-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
        <li><a class="faicon-pinterest" href="#"><i class="fa fa-pinterest"></i></a></li>
        <li><a class="faicon-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
        <li><a class="faicon-dribble" href="#"><i class="fa fa-dribbble"></i></a></li>
        <li><a class="faicon-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
        <li><a class="faicon-google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
        <li><a class="faicon-rss" href="#"><i class="fa fa-rss"></i></a></li>
      </ul>
    </div>
    <!-- ################################################################################################ -->
  </div>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row1">
  <header id="header" class="hoc clear">
    <!-- ################################################################################################ -->
    <div id="logo" class="fl_left">
      <h1><a href="index.php">E-TransactionTrack</a></h1>
    </div>
    <div id="quickinfo" class="fl_right">
      <ul class="nospace inline">
        <li><strong>Mobile no:</strong><br>
+234 123 456 7890</li>
        <li><strong>Bank User</strong><br>
Admin</li>
      </ul>
    </div>
    <!-- ################################################################################################ -->
  </header>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-10 offset-sm-1 col-md-6 offset-md-3" id="lop">
            <div class="card panel-login bg-dark">
                <div class="card-header ">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <a href="#" class="active" id="login-form-link">Login as an exiting user</a>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <a href="#" id="register-form-link">Register An Account</a>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1">
                            <form action="index.php" id="frmSignIn" method="post" style="display:block">
                                <div class="form-group">
                                    <select class="form-control" name="bank">
                                        <option selected>Select Bank</option>
                                        <?php $r = $cn->query('SELECT * FROM banks');
                                        while ($res = $r->fetch_assoc()) {
                                            echo "<option>".$res['banks']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                     <label style="color: white">Username</label>

                                    <input type="text" value="" class="form-control input-lg" placeholder="Username" name="user">

                                </div>
                                <div class="form-group">

                                    <a class="pull-right" href="#">(Lost Password?)</a>
                                    <label style="color: white">Password</label>

                                    <input type="password" value="" class="form-control input-lg" placeholder="Password" name="pword">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
															<span class="remember-box checkbox">
																<label for="rememberme" style="color: white">
																	<input type="checkbox" id="rememberme" name="rememberme">Remember Me
																</label>
															</span>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="submit" value="Login" name="login" class="btn btn-primary pull-right mb-xl" data-loading-text="Loading...">
                                    </div>
                                </div>
                            </form>


                            <form action="index.php" id="frmSignUp" method="post" style="display:none">
                                <div class="form-group">
                                    <select class="form-control" name="bank" id="kl">
                                        <option selected>Select Bank</option>
                                        <?php $r = $cn->query('SELECT * FROM banks');
                                        while ($res = $r->fetch_assoc()) {
                                            echo "<option>".$res['banks']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">

                                    <label style="color: white">Username</label>
                                    <input type="text" value="" class="form-control input-lg" name="username">
                                </div>

                                <div class="form-group">
                                    <label style="color: white">Password</label>
                                    <input type="password" value="" class="form-control input-lg" name="pass">
                                </div>
                                <div class="form-group">
                                    <label style="color: white">Re-enter Password</label>
                                    <input type="password" value="" class="form-control input-lg" name="cpass">
                                </div>
                                <div class="row">
                                    <div class="col-md-6 offset-md-3">
                                        <input type="submit" value="Register" name="register" class="btn btn-primary pull-right mb-xl" data-loading-text="Loading...">
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div></div>
</div>
<script src="../layout/scripts/jquery.min.js"></script>
<script src="../layout/scripts/jquery.backtotop.js"></script>
<script src="../layout/scripts/jquery.mobilemenu.js"></script>
<!-- IE9 Placeholder Support -->
<script src="../layout/scripts/jquery.placeholder.min.js"></script>
<script src="../layout/scripts/bootstrap/bootstrap.min.js"></script>

<script>
    $(function() {

        $('#login-form-link').click(function (e) {
            $("#frmSignIn").delay(100).fadeIn(100);
            $("#frmSignUp").fadeOut(100);
            $('#register-form-link').removeClass('active');
            $(this).addClass('active');
            e.preventDefault();
        });
        $('#register-form-link').click(function (e) {
            $("#frmSignUp").delay(100).fadeIn(100);
            $("#frmSignIn").fadeOut(100);
            $('#login-form-link').removeClass('active');
            $(this).addClass('active');
            e.preventDefault();
        });
    });

</script>
</body>
</html>