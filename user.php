<?php
session_start();
if(!isset($_SESSION['email'])){
    header('location:index.php');
}
require 'conn.php';
if(isset($_POST['logit'])){
    $acct = $_POST['acct'];
    $trc = $_POST['slip'];
    $id= $_SESSION['email'];
    $typ = $_POST['typ'];
    $amt = $_POST['amt'];
//    $date = $_POST['date'];
    $bank = $_POST['bank'];
    $dat = new DateTime('now', new DateTimeZone('Africa/Lagos'));
    $dat = $dat->format('d/m/Y');
    $r = $cn->query("SELECT * FROM transaction where transactionNumber = '$trc' AND email='$id'");
    if ($r->num_rows ==  0 ) {
        $fr = $cn->query("INSERT INTO transaction(`transactionNumber`, `bank`,`transactionType`, `amount`, `date`,`acct_no`, `email`) VALUES ('$trc','$bank','$typ','$amt','$dat','$acct','$id')");
        if ($fr){
            echo "<script>alert('Transaction Successfully logged')</script>";
            //echo "<script>window.location.href='index.php';</script>";
        }
    }else{
        echo "<script>alert('STOP! Your transaction has been logged already *Smiles*');</script>";

    }
}

if (isset($_POST['send']) && !empty($_POST['send'])){
    $p= $_SESSION['email'];
    $rep = $_POST['rep'];
    $tck = $_POST['ticket'];
    $dat = new DateTime('now', new DateTimeZone('Africa/Lagos'));
    $dat = $dat->format('d/m/Y h:m:s');
    $qr = $cn->query("INSERT INTO messages (email, ticket_no, message, messageTime) VALUES('$p', '$tck', '$rep', '$dat')");
    if($qr){
        echo "<div class='alert alert-success' style='text-align: center'><i class='fa fa-close pull-right close'></i>Message sent</div>";
    }else{
        echo "<div class='alert alert-danger' style='text-align: center'><i class='fa fa-close pull-right close'></i>Message not sent</div>";
    }
}
/**
 * Created by PhpStorm.
 * User: oyetola
 * Date: 1/22/2018
 * Time: 5:38 PM
 */?>
<!DOCTYPE html>
<html>
<head>
    <title>E-Track</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
    <link rel="stylesheet" href="layout/styles/bootstrap/bootstrap.css">
<!--    <link rel="stylesheet" href="layout/styles/bootstrap/bootstrap.min.css">-->
    <link rel="stylesheet" href="layout/styles/framework.css">
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
                <li class="active"><a href="user.php.">Home</a></li>
                <li><a class="drop" href="#">Actions</a>
                    <ul>
                        <li><a href="logout.php">Logout</a></li>
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
            <h1><a href="#">E-TransactionTrack</a></h1>
        </div>
        <div id="quickinfo" class="fl_right">
            <ul class="nospace inline">
                <li><strong>Mobile no:</strong><br>
                    +234 123 456 7890</li>
                <li><strong>Phone no:</strong><br>
                    +234 123 456 7890</li>
                <li><a href="logout.php" class="btn-danger btn-sm">Logout</a></li>
            </ul>
        </div>
        <!-- ################################################################################################ -->
    </header>
<div class='row'>
    <div class="col-md-6 offset-1">
     <b id="em"> <?= $_SESSION['email']?></b>
    </div>
    <div class="col-md-6">
      <p id="oth"></p>

     </div>
    </div>

<div class="col-md-8 offset-md-2">
<!--    <div class="card ">-->
        <div class="card-header bg-dark">

        </div>
<!--        <div class="card-body">-->
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#vw">View all transactions</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#lg">Log new transaction</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#messge">Messages</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#messges">Make Complaints</a>
        </li>
    </ul>

            <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="vw">
<!--                    <div class="table-responsive">-->
                        <table id="myTable" class="table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Transaction No</th>
                                <th>Transaction Type</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Email</th>
                            </tr>
                            </thead>
                            <tfoot>

                            </tfoot>
                            <tbody>

                            <?php
                            $z = $_SESSION['email'];
                            $res = $cn->query("SELECT * FROM transaction WHERE email = '$z'");
                            $i =0;
                            if($res->num_rows > 0){
                                while ($dat = $res->fetch_assoc()) {
                                    $i = $i+1;
                                    echo "<tr>";
                                    echo "<td>".$i."</td>";
                                    echo "<td>".$dat['transactionNumber']."</td>";
                                    echo "<td>".$dat['transactionType']."</td>";
                                    echo "<td>".$dat['amount']."</td>";
                                    echo "<td>".$dat['date']."</td>";
                                    echo "<td>".$dat['email']."</td>";
                                    echo "</tr>";
                                }}
                            else{
                                echo '<tr>'. 'No record(s) found'.'</tr>';
                            }
                            ?>

                            </tbody>
                        </table>
<!--                    </div>-->
        </div>

        <div role="tabpanel" class="tab-pane fade" id="lg">
            <div class="col-md-6" style="text-align: center">
                <h3>Enter a new transaction</h3>
            <form method="post" action="user.php">
                <div class="form-group">
                    <select class="form-control" id="kl" name="bank">
                        <option selected>Select Bank Involved</option>
                        <?php $r = $cn->query('SELECT * FROM banks WHERE status=1');
                        while ($res = $r->fetch_assoc()) {
                            echo "<option>".$res['banks']."</option>";
                        }
                        ?>
                    </select>
                </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Transaction Slip ID" name="slip">
                        </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Acct Number Involved" name="acct">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Amount" name="amt">
                </div>
                <div class="form-group">
                    <select name="typ" id="typ" class="form-control">
                        <option selected>Select Transaction Type</option>
                        <option>Deposit</option>
                        <option>Withdrawal</option>
                    </select>
                </div>

                <div class="form-group">
                    <input type="submit" value="Log this Transaction" class="form-control btn-success" name="logit">
                </div>
                    </form>
            </div>
        </div>

        <div role="tabpanel" class="tab-pane" id="messge">
            Messages<?php
            $p= $_SESSION['email'];
            echo "<div class='card-header'><input type=text id='ticket' name='ticket' value='" . $res['ticket_no'] . "'></div>";

            echo "<div class='card-body'>";
            $r = $cn->query("SELECT * FROM messages WHERE email='$p' ORDER BY messageTime ");
            while ($res = $r->fetch_assoc()) {
                echo "<div class='text-info'>Message</div>";
                    echo "<div>".$res['message']."<i class='pull-right'>".$res['messageTime']."</i></div>";
                echo "<div class='text-info'>Replies</div>";
                $c = $res['ticket_no'];
                $v = $cn->query("SELECT * FROM replies WHERE ticketNo_id= '$c' ORDER BY replyTime");
                while ($re = $v->fetch_assoc()) {
                    echo "<div class='dropdown-divider'></div><div>" . $re['reply']."<i class='pull-right'>".$re['replyTime']."</i></div>";
                }
                    }


//                echo "<button class='btn-primary btn-sm' id='makereply'>Reply this message</button>";
                    echo "<form method='post' action='user.php'>";
                    echo "<div class='card-header'><input type=hidden id='ticket' name='ticket' value='" . $res['ticket_no'] . "'></div>";
                    echo "<div class='form-group'>
       <textarea id='rep' name='rep' class='form-control'>
       </textarea>
       </div>";
                    echo "<input type='submit' class='btn-success btn-sm' name='send' value='Reply this Message' id='send'></form>";
echo "</div>";
                ?>
        </div>

                <div role="tabpanel" class="tab-pane" id="messges">
                    <div id="comment">
                        <h2>Type Your Message</h2>
                        <form action="message.php" method="post">
                            <div class="one_third first">
                                <label for="name">Email <span>*</span></label>
                                <input type="email" name="identity" class="form-control" id="name" value="" size="22" required readonly>
                            </div>
                            <div class="one_third">
                                <label for="email">Ticket Number <span>*</span></label>
                                <input type="text" class="form-control" name="rand" id="email" value="<?= mt_rand(100000, 999999)?>" size="22" readonly required>
                            </div>
<!--                            <div class="one_third">-->
<!--                                <label for="url">Website</label>-->
<!--                                <input type="url" name="url" id="url" value="" size="22">-->
<!--                            </div>-->
                            <div class="col-md-6">
                                <label for="comment">Your Complaint</label><br>
                                <textarea name="comment" id="comment" class="form-control" cols="5" rows="4"></textarea>
                            </div>
                            <br>
                            <div class="row">
                                <button type="button" class="btn-dark btn-sm" id="reset">Clear Message</button>
                                <input type="submit" class="btn-success btn-sm" name="sub" value="Send Message">
                            </div>
                        </form>
                    </div>
                </div>

            </div>

<!--        </div>-->
<!--</div>-->
    </div>
    <div class="row" style="height: 10vh"></div>
</div>

<script src="jquery/jquery.js"></script>
<script src="jquery/jquery.dataTables.min.js"></script>
<script src="layout/scripts/bootstrap/bootstrap.js"></script>


<script>
    var emal = $('#em').text();
       $('#name').val(emal);
    $.ajax({
        url:'loadit.php',
        type: 'POST',
        data: {emal:emal},
        success: function (data) {
            if(data !== ''){
        $('#oth').html(data);
    }}
    });
    $('#reset').click(function () {
        $('#comment').value = "";
    });
    $('.fa-close').click(function () {
        $(this).closest('div').remove();
    })
</script>
<script>


$(document).ready(function() {
//   $('#log').hide();
//    $('#h').click(function () {
//        $('#log').show();
//        $('#myTable').hide();
//    });
// $('#myTable').DataTable();
var table = $('#myTable').DataTable({
"columnDefs": [{
"visible": true,
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
$('#myTable tbody').on('click', 'tr.group', function() {
var currentOrder = table.order()[0];
if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
table.order([2, 'desc']).draw();
} else {
table.order([2, 'asc']).draw();
}
});
});
//$('#example23').DataTable({
//dom: 'Bfrtip',
//buttons: [
//'copy', 'csv', 'excel', 'pdf', 'print'
//]
//});
</script>
</body>
</html>