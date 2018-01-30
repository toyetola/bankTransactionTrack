<?php
require 'conn.php';
session_start();
if (isset($_POST['login'])){
    $df = $_POST['email'];
    $fd = $_POST['pass'];
    $hj =$_POST['bank'];
    $fr = $cn->query("SELECT name FROM users where email='$df' AND password='$fd' AND bank='$hj'");
    if($fr->num_rows > 0) {
        $_SESSION['email'] = $df;
        echo "<script>window.location.href='user.php';</script>";
    }else{
        echo "<script>alert('Wrong Login details Supplied.Try again!');</script>";
    }
}
?>
<!DOCTYPE html>

<html>
<head>
<title>E-Track</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
  <link rel="stylesheet" href="/layout/styles/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="layout/styles/bootstrap/bootstrap.min.css">
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
            <li><a href="pages/gallery.html">Gallery</a></li>
            <li><a href="pages/full-width.html">Full Width</a></li>
            <li><a href="pages/sidebar-left.html">Sidebar Left</a></li>
            <li><a href="pages/sidebar-right.html">Sidebar Right</a></li>
            <li><a href="pages/basic-grid.html">Basic Grid</a></li>
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
      <h1><a href="index.html">E-TransactionTrack</a></h1>
    </div>
    <div id="quickinfo" class="fl_right">
      <ul class="nospace inline">
        <li><strong>Mobile no:</strong><br>
          +234 123 456 7890</li>
        <li><strong>Phone no:</strong><br>
          +234 123 456 7890</li>
      </ul>
    </div>
    <!-- ################################################################################################ -->
  </header>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper bgded overlay" style="background-image:url('images/demo/backgrounds/01.png');">
  <div id="pageintro" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <article class="col-md-6 pull-right">
        <form method="post" action="index.php">
          <div class="form-group">
            <select class="form-control" name="bank" id="kl">
                <option selected>Select Bank</option>
                <?php $r = $cn->query('SELECT * FROM banks WHERE status= 1');
                while ($res = $r->fetch_assoc()) {
                    echo "<option>".$res['banks']."</option>";
                }
                ?>
            </select>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Email" name="email">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Password" name="pass">
          </div>
            <footer>
                <ul class="nospace inline pushright">
                    <li><button type="submit" class="btn" name="login">Login</button></li>
                    <li><a class="btn inverse" href="register.php">New here? Sign Up</a></li>
                </ul>
            </footer>
        </form>

    </article>
    </div>
    <!-- ################################################################################################ -->
  </div>
</div>

<div class="wrapper row4">
  <footer id="footer" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <div class="one_quarter first">
      <h6 class="title">About</h6>
      <p>Worry less about your transactions that are not succesful, now they can be easilt tracked.</p>
      <p>E-Transaction Track has come to your rescue to clear your worries.</p>
    </div>
    <div class="one_quarter">
      <h6 class="title">Contact</h6>
      <ul class="nospace linklist contact">
        <li><i class="fa fa-map-marker"></i>
          <address>
          My house @ Ibadan, Nigeria.
          </address>
        </li>
        <li><i class="fa fa-phone"></i> +00 (123) 456 7890<br>
          +00 (123) 456 7890</li>
        <li><i class="fa fa-fax"></i> +00 (123) 456 7890</li>
        <li><i class="fa fa-envelope-o"></i> info@domain.com</li>
      </ul>
    </div>
    <div class="one_quarter">
      <h6 class="title"></h6>
      <ul class="nospace linklist">
        <li><a href="#"></a></li>
        <li><a href="#"></a></li>
      </ul>
    </div>
    <div class="one_quarter">
      <h6 class="title">Terms and Conditions</h6>
      <ul class="nospace linklist">
        <li>
          <article>
            <h2 class="nospace font-x1"><a href="#">All rights reserved</a></h2>
            <time class="font-xs block btmspace-10" datetime="2045-04-06">Friday, 6<sup>th</sup> April 2045</time>
            <p class="nospace">&hellip;</p>
          </article>
        </li>
        <li>
          <article>
            <h2 class="nospace font-x1"><a href="#"></a></h2>
            <time class="font-xs block btmspace-10" datetime="2045-04-05">Thursday, 5<sup>th</sup> April 2045</time>
            <p class="nospace">&hellip;</p>
          </article>
        </li>
      </ul>
    </div>
    <!-- ################################################################################################ -->
  </footer>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row5">
  <div id="copyright" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <p class="fl_left">Copyright &copy; 2018 - All Rights Reserved - <a href="#">E-TransactionTrack.ng</a></p>
    <p class="fl_right">By <a target="_blank" href="#">Mayowa 2018</a></p>
    <!-- ################################################################################################ -->
  </div>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
<!-- JAVASCRIPTS -->
<script src="layout/scripts/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
<!-- IE9 Placeholder Support -->
<script src="layout/scripts/jquery.placeholder.min.js"></script>
<script src="layout/scripts/bootstrap/bootstrap.min.js"></script>
<!-- / IE9 Placeholder Support -->
</body>
</html>