<?php require 'conn.php';
if (isset($_POST['kl'])){
    $bank = $_POST['bank'];
    $acct = $_POST['acct'];
    $name = $_POST['name'];
    $bvn = $_POST['bvn'];
    $email = $_POST['email'];
    $pword = $_POST['pword'];
    $cpword = $_POST['cpword'];
    if ($cpword == $pword && $bank !== 'Select Bank') {
        $fr = $cn->query("INSERT INTO users(`bank`, `acct_no`, `name`, `bvn`,`email`, `password`) VALUES ('$bank','$acct','$name','$bvn','$email','$pword')");
        if ($fr){
            echo "<script>alert('Successfully registered. Please Login')</script>";
            echo "<script>window.location.href='index.php';</script>";
        }
    }else{
        echo "<script>alert('Password does not match. Check if you selected a bank );</script>";
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
    <link rel="stylesheet" href="layout/styles/bootstrap/bootstrap.css">
<!--    <link rel="stylesheet" href="layout/styles/bootstrap/css/bootstrap.min.css">-->
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
                <li class="active"><a href="index.php">Home</a></li>
                <li><a class="drop" href="#">Pages</a>
                    <ul>
                        <li><a href="#">News</a></li>
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
                <li><strong>Phone no:</strong><br>
                    +234 123 456 7890</li>
            </ul>
        </div>
        <!-- ################################################################################################ -->
    </header>
</div>
<div class="row">
    <div class="wrapper col-sm-10 offset-sm-1 col-lg-6 offset-lg-3" id="c">
<div class="card">
    <div class="card-header bg-dark" style="color: white">
        Sign Up
    </div>
    <div class="card-body">
        <form method="post" action="register.php">
    <div class="form-group">
        <select class="form-control" id="kl" name="bank" required>
            <option selected>Select Bank</option>
            <?php $r = $cn->query('SELECT * FROM banks WHERE status = 1');
            while ($res = $r->fetch_assoc()) {
                echo "<option>".$res['banks']."</option>";
            }
            ?>


        </select>
    </div>
    <div class="form-group">
        <input type="text" placeholder="Account Number" class="form-control" id="jk" name="acct" size="10">
    </div>
    <div class="form-group">
        <input type="text" placeholder="" class="form-control" readonly id="accNo" name="name" required>
    </div>
            <div class="form-group">
                <input type="text" placeholder="BVN" class="form-control"  name="bvn" id="bvn">
            </div>
            <div class="form-group">
                <input type="text" placeholder="Email" class="form-control" name="email">
            </div>
    <div class="form-group">
        <input type="text" placeholder="Password" class="form-control" name="pword">
    </div>
    <div class="form-group">
        <input type="text" placeholder="Confirm Password" class="form-control" name="cpword">
    </div>
        <input type="submit" value="Register" class="btn btn-success pull-right" name="kl">
        </form>
    </div>

</div>
    </div>
    <div class="clearfix"></div>
</div>
</body>
<script src="jquery/jquery.js"></script>
<script src="jquery/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        var d; var c;
        $('#accNo').hide();
        $('#kl').on('change', function () {
           c = $('#kl option:selected').text();
        });
       
        $('#jk').keyup(function () {
    if (this.value != this.value.replace(/[^0-9\.]/g, '')) {
       this.value = this.value.replace(/[^0-9\.]/g, '');
    }
        });


        $('#jk').keypress(function () {
            d = $(this).val();
        if ($(this).val().length = 10){
                $('#jk').attr('readonly');
                      console.log(d);
             }
        });




        $('#jk').on('change', function () {
            d = $(this).val();
            $.ajax({
                url: 'regext.php',
                type: 'POST',
                data: {d:d, c:c},
                success: function (data){
                    if(data !== "") {
                        $('#accNo').show();
                        $('#accNo').val(data);
                    }
                    else{
                        alert('Wrong account Number');
                        $(this).css('border-color', 'red');
                        $('#jk').focus();
                    }

                    // location.reload();}
                },
                error: function (dat) {
                    window.alert('error');
                }
            });
        });
    
  $('#bvn').change( function () {
     var bvn = $(this).val();
      $.ajax({
          url: 'regext.php',
          type: 'POST',
          data: {bvn:bvn, c:c},
          success: function (data){
              if(data !== "") {
                 alert('Correct')
              }
              else{
                  alert('Wrong BVN, Supply the right one');
                  $('#bvn').focus();
              }

              // location.reload();}
          },
          error: function (dat) {
              window.alert('error');
          }
      });
  });
    });

</script>
</html>