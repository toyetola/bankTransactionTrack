<?php
/**
 * Created by PhpStorm.
 * User: oyetola
 * Date: 1/24/2018
 * Time: 4:46 AM
 */
session_start();
 if(!isset($_SESSION['username'])){
    header('location:index.php');
 }

require '../conn.php';
if(isset($_POST['log'])){
    $acct = $_POST['acctNo'];
    $trc = $_POST['trc'];
    $id= $_POST['id'];
    $typ = $_POST['typ'];
    $amt = $_POST['amount'];
    $date = $_POST['date'];
    $bank = $_POST['bank'];
    $dat = new DateTime('now', new DateTimeZone('Africa/Lagos'));
    $dat = $dat->format('d/m/Y h:m:s');
    $r = $cn->query("SELECT * FROM transaction where transactionNumber = '$trc' AND email='$id'");
    if ($r->num_rows ==  0 ) {
        $fr = $cn->query("INSERT INTO transaction(`transactionNumber`, `bank`,`transactionType`, `amount`, `date`,`acct_no`, `email`) VALUES ('$trc','$bank','$typ','$amt','$date','$acct','$id')");
        if ($fr){
            echo "<script>alert('Transaction Successfully logged')</script>";
            //echo "<script>window.location.href='index.php';</script>";
        }
    }else{
        echo "<script>alert('STOP! Your transaction has been logged already *Smiles*');</script>";

    }
}

if (isset($_POST['send'])){
  $rep = $_POST['rep'];
  $tck = $_POST['ticket'];
    $dat = new DateTime('now', new DateTimeZone('Africa/Lagos'));
    $dat = $dat->format('d/m/Y h:m:s');
   $qr = $cn->query("INSERT INTO replies(ticketNo_id, reply, replyTime) VALUES('$tck', '$rep', '$dat')");
   if($qr){
       echo "<div class='alert alert-success'><i class='fa fa-close pull-right close'></i>Message sent</div>";
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
    <!--<link rel="stylesheet" href="../layout/styles/bootstrap/bootstrap.min.css">-->
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
                <li class="active"><a href="index.php">Home</a></li>
                <li><a class="drop" href="#">Actions</a>
                    <ul>
                        <li><a href="logout.php">Logout</a></li>
                        <li><a href="#"></a></li>

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
            <h1><a href="#">E-TransactionTrack</a></h1>
        </div>
        <div id="quickinfo" class="fl_right">
            <ul class="nospace inline">
                <li><strong>Mobile no:</strong><br>
                    +234 123 456 7890</li>
                <li><strong>IN ACTIVE SESSSION:</strong><br>
                    Admin</li>
                <li><a href="logout.php" class="btn-danger btn-sm">Logout</a></li>
            </ul>
        </div>
        <!-- ################################################################################################ -->
    </header>
    <div class='row'>
        <div class="col-md-6 offset-1">
            <p id="em">Welcome  <b><?= $_SESSION['username']?></b></p>
        </div>
        <div class="col-md-6">
            <p id="oth"></p>
        </div>
    </div>

    <ul class="nav nav-tabs col-md-6 k">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#view">View all transactions</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#log">Log new transaction</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#messages">Messages</a>
        </li>
    </ul>

            <div class="tab-content col-md-6" id="l">
                <div role="tabpanel" class="tab-pane fade in active" id="view">
        <table id="myTable" class="table-responsive table-bordered table-striped ">
            <thead>
            <tr>
                <th>S/N</th>
                <th>Transaction No</th>
                <th>Transaction Type</th>
                <th>Amount</th>
                <th>Date</th>
                <th class>Account Number Involved</th>
                <th>Bank</th>
                <th>Email</th>
            </tr>
            </thead>
            <tfoot>

            </tfoot>
            <tbody>

            <?php
            //$z = $_SESSION['email'];
            $res = $cn->query("SELECT * FROM transaction");
            if($res->num_rows > 0){
                $i = 0 ;
                while ($dat = $res->fetch_assoc()) {
                     $i = $i + 1;
                    echo "<tr>";
                    echo "<td>".$i."</td>";
                    echo "<td>".$dat['transactionNumber']."</td>";
                    echo "<td>".$dat['transactionType']."</td>";
                    echo "<td>".$dat['amount']."</td>";
                    echo "<td>".$dat['date']."</td>";
                    echo "<td>".$dat['acct_no']."</td>";
                    echo "<td>".$dat['bank']."</td>";
                    echo "<td>".$dat['email']."</td>";
                    echo "</tr>";
                }}
            else{
                echo 'No record(s) found';
            }
            ?>

            </tbody>
        </table>
                </div>


<!--    <h1>Log a Transaction</h1>-->
<!--    <hr>-->

    <div role="tabpanel" class="tab-pane fade" id="log">
        <h1>Log a Transaction</h1>
        <div class="dropdown-divider"></div>
        <div>
    <form method="post" action="aminhome.php">
        <div class="form-group">
        <select class="form-control" id="kl" name="bank">
            <option selected>Select Bank</option>
            <?php $r = $cn->query('SELECT * FROM banks WHERE status=1');
            while ($res = $r->fetch_assoc()) {
                echo "<option>".$res['banks']."</option>";
            }
            ?>
        </select>
        </div>

        <div class="form-group">
            <input type="text" class="form-control" placeholder="Customer's account Number" id="accNo" name="acctNo" required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" readonly id="nam" name="id" required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Transaction Slip ID" id="nm" name="trc" required>
        </div>

        <div class="form-group">
            <select name="typ" id="typ" class="form-control">
                <option selected>Select Transaction Type</option>
                <option>Deposit</option>
                <option>Withdrawal</option>
            </select>
        </div>
        <div class="form-group">
            <label>Amount</label>
            <input type="number" class="form-control"  name="amount" required>
        </div>
        <div class="form-group">
            <input type="date" class="form-control" name="date">
        </div>
        <div><input type="submit" class=" btn-success form-control" value="Log this transaction" name="log"></div>
    </form>
        </div></div>

        <div role="tabpanel" class="tab-pane fade" id="messages">
    <h1>Messages</h1>
    Messages<?php
    $r = $cn->query("SELECT * FROM messages");
    while($res = $r->fetch_assoc()){
        echo "<div class='card-header bg-secondary'><input type=text id='ticket' name='ticket' value='".$res['ticket_no']."'></div>";
        echo "<div class='text-info'>Message</div>";
       echo "<div class='card-body'>".$res['message']."<span class='pull-right'>".$res['messageTime']."</span></div>";
        echo "<div class='text-info'>Replies</div>";
       $c = $res['ticket_no'];
        $v = $cn->query("SELECT * FROM replies WHERE ticketNo_id= '$c'");
        while ($re = $v->fetch_assoc()){
            echo "<div class='dropdown-divider'></div><div class='card-body'>".$re['reply']."</div>";
        }
        echo "<button class='btn-primary btn-sm makereply' id='makereply'>Reply this message</button>";
        echo "<form method='post' action='aminhome.php'>";
        echo "<input type=hidden id='ticket' name='ticket' value='".$res['ticket_no']."'>";
       echo "<div class='form-group'>";
        echo "<textarea id='rep' name='rep' class='form-control rep'>
       </textarea>";
       echo "</div>";
       echo "<input type='submit' class='btn-success btn-sm send' name='send' value='Send Message' id='send'></form>";

    }
    ?>
</div>
</div>
    <div class="container" style="height: 10vh">

    </div>
</div>
<script src="../jquery/jquery.min.js"></script>
<script src="../jquery/jquery.dataTables.min.js"></script>
<script src="../layout/scripts/bootstrap/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    $('.rep').hide();
    $('.send').attr('hidden', true);
    $('.makereply').on('click', function (){
        var fg = $(this).text();
        if( fg == 'Reply this message'){
            $('.rep').show();
            $(this).text('Cancel');
            $(this).addClass('btn-danger');
            $('.send').attr('hidden', false);}
        else{
            $('.rep').hide();
            $('.send').attr('hidden', true);
            $('.makereply').text('Reply this message');
            $(this).removeClass('btn-danger');
        }
    });
    $('#nam').hide();
    var f;
    $('#kl').on('change',function(){
    f = $('#kl option:selected').text();
    f = f.toLowerCase();
});
    $('#accNo').on('change', function () {
        var g = $(this).val();
        $.ajax({
            url: '../regext.php',
            type: 'POST',
            data: {g:g, f:f},
            success: function (data){
                if(data !== "") {
                    $('#nam').show();
                    $('#nam').val(data);
                    $('#nam').focus();
                }
                else{
                    alert('Wrong account Number');
                    $(this).css('border-color', 'red');
                    $(this).focus();
                }
            },
            error: function (dat) {
                window.alert('error');
            }
        });
    });


var table = $('#myTable').DataTable({
"columnDefs": [{
"visible": false,
"targets": 2
}],
"order": [
[2, 'asc']
],
"displayLength": 25,
"drawCallback": function(settings) {
var api = this.api();
var rows = api.rows({
page: 'current'
}).nodes();
var last = null;
api.column(2, {
page: 'current'
}).data().each(function(group, i) {
if (last !== group) {
$(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
last = group;
}
});
}
});



// Order by the grouping
/*$('#myTable tbody').on('click', 'tr.group', function() {
var currentOrder = table.order()[0];
if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
table.order([2, 'desc']).draw();
} else {
table.order([2, 'asc']).draw();
}
});*/
});
/*$('#example23').DataTable({
dom: 'Bfrtip',
buttons: [
'copy', 'csv', 'excel', 'pdf', 'print'
]
});*/

</script>
</body>
</html>