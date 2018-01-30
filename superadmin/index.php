<?php
/**
 * Created by PhpStorm.
 * User: oyetola
 * Date: 1/27/2018
 * Time: 2:09 PM*/
require '../conn.php';
if(isset($_POST['add'])){
    $bv = $_POST['bank'];
    $m = strtolower($bv);
    $cn ->query(
        "CREATE TABLE $m (
    id int,
    acct_no int,
    name varchar(120),
    email varchar(100),
    bvn int 
);"
    );

$r = $cn->query("INSERT INTO banks(`banks`) VALUES ('$bv')");
if($r){
    echo "<script>alert('Successfully added')</script>";
}
}

if (isset($_POST['block'])){

}

if(isset($_REQUEST['upload'])){
  $fl = $_POST['bank'];
  $fl = strtolower($fl);
    $filetmpname=$_FILES['uploadnew']['tmp_name'];

    $filenamenew= $_FILES['uploadnew']['name'];
    //$filenamenew=$teller_num.".jpg";
    $filedestination=$fl.'/'.$filenamenew;
    move_uploaded_file($filetmpname, $filedestination);

    $file = "$fl/$filenamenew";
    $handle = fopen($file, "r");
    $c = 0;
    while(($filesop = fgetcsv($handle, 1000, ",")) !== false) {

        $acctno = $filesop[0];
        $acctname = $filesop[1];
        $email = $filesop[2];
        $bvn = $filesop[3];

        $sql = ("INSERT INTO $fl (`acct_no`, `name`, `email`, `bvn`) VALUES ('$acctno','$acctname','$email','$bvn')");

        $statement = $cn->query($sql);


        if ($statement == true) {

            echo "<script>alert('Upload was successfull')</script>";
            //header("location:index.php");
        } else {
            echo "<script>alert('Upload Not successfull')</script>";
            //header("location:index.php");
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
    <link rel="stylesheet" href="../layout/styles/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../layout/styles/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../layout/styles/framework.css">
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
                        <li aria-disabled="true">Page<a  href="#"></a></li>
                        <li aria-disabled="true">Settings<a href="#"></a></li>
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
                <li><strong>Super admin</strong><br>
</li>
                <!--<li><strong>Phone no:</strong><br>
+00 (123) 456 7890</li>-->
            </ul>
        </div>
        <!-- ################################################################################################ -->
    </header>
    <div class="row">
<div class="card col-md-4 offset-md-1">
  <div class="card-body">

      <label><span><i class="fa fa-eye"></i></span> View all banks on platform</label>
      <button name="add" class="btn-success" id="view">View</button>
<?php $r = $cn->query('SELECT * FROM banks');
while ($res = $r->fetch_assoc()) {
    if($res['status'] == 1) {
        echo "<div class='col-10 list'><ul id='list'><li class='list'>" . $res['banks'] . "</li><ul><button type='submit' id='block' class='btn-warning btn-sm sus'>Suspend</button></div>";
    }else{
        echo "<div class='col-10 list'><ul id='list'><li class='list'>" . $res['banks'] . "</li><ul><button type='submit' id='block' class='btn-inverse btn-sm susd'>Suspended</button></div>";
    }
    }?>

  </div>
        </div>
        <div class="card col-md-4 offset-md-1">
            <div class="card-body">
               <label><span><i class="fa fa-plus"></i></span> Add bank</label>
                <form method="post" action="index.php">
                <div class="form-group">
                    <input type="text" class="input-group-lg form-control" name="bank" id="bank" required>
                </div>
                    <input type="submit"name="add" class="btn-primary" value="Add">
                </form>
            </div>
        </div>
    </div>

    <div class="row" id="bk">
        <div class="card col-6 offset-1">
        <div class="card-body">
          <label>Add/Update Bank Records</label>

            <form action="index.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <select class="form-control" id="kl" name="bank" required>
                        <option selected>Select Bank</option>
                        <?php $r = $cn->query('SELECT * FROM banks');
                        while ($res = $r->fetch_assoc()) {
                            echo "<option>".$res['banks']."</option>";
                        }
                        ?>
                    </select>
                </div>
                <input type="file" class="form-control" name="uploadnew" required><br>
                <!--<p> Accepted File Extensions Are csv,xml,pgf</p>-->
                <button class="btn-success" name="upload">Upload Excel</button>
            </form>


            <table id="myTable" class="table-bordered table-striped">
                <thead>
                <tr>
                    <th>S/N</th>
                    <th>Account No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>BVN</th>
                </tr>
                </thead>
                <tfoot>

                </tfoot>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
    </div>
</div>

<script src="../jquery/jquery.min.js"></script>
<script src="../layout/scripts/bootstrap/bootstrap.min.js"></script>
<script src="../jquery/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function () {
    $('.list').attr('hidden', true);
    $('.sus').attr('hidden', true);
    $('#view').click(function () {
        var b = $(this).text();
        if (b == 'View') {
            $('.list').attr('hidden', false);
            $('.sus').attr('hidden', false);
            $(this).text('Collapse');
        } else {
            $('.list').attr('hidden', true);
            $('.sus').attr('hidden', true);
            $(this).text('View');
        }
    });

    $('#add').submit(function () {
        var n = $('#bank').text();
        n = n.toLowerCase();
        $.ajax({
            url: 'fetchbank.php',
            type: 'POST',
            data: {n: n},
            success: function (data) {
                if (data !== '') {
                    $('#list').html(data);
                    alert('updated');
                }
            }
        });
    });

    $('#kl').on('change', function () {
        var d = $('#kl option:selected').text();
        d = d.toLowerCase();
        $.ajax({
            url: 'fetchbank.php',
            type: 'POST',
            data: {d:d},
            success: function (data){
                if(data !== "") {
                    $('tbody').html(data);
                }
                else{
                    alert('No records for this Bank');
                }
            },
            error: function (dat) {
                window.alert('error');
            }
        });
    });

    $('.sus').on('click', function () {
        var f  = $(this).closest('div').find('li').text();

        $.ajax({
            url: 'fetchbank.php',
            type: 'POST',
            data: {f:f},
            success: function (data){
                if(data !== "") {
                    alert('Change was susccesful');
                    location.reload();

                }
                else{
                    alert('Change made!');
                }
            },
            error: function (dat) {
                window.alert('error');
            }
        });
    });

    $('.susd').on('click', function () {
        var g  = $(this).closest('div').find('li').text();

        $.ajax({
            url: 'fetchbank.php',
            type: 'POST',
            data: {g:g},
            success: function (data){
                if(data !== "") {
                    alert('Change was susccesful');
                    location.reload();
                }
                else{
                    alert('Change made!');
                }
            },
            error: function (dat) {
                window.alert('error');
            }
        });
    });
});
</script>
</body>
</html>