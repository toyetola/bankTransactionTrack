<?php 
require 'conn.php';
if (isset($_POST['d']) && isset($_POST['c'])) {
    $d = $_POST['d'];
    $c = $_POST['c'];
    try {
        $fr = $cn->query("SELECT * FROM $c where acct_no='$d'");
        If ($fr->num_rows > 0) {
            while ($res = $fr->fetch_assoc()) {
                echo $res['name'];
            }
        } else {
            echo "No name found; Record doesn't exist";
        }
    } catch (mysqli_sql_exception $e){
        die('No record(s) found'.$e->getMessage());
    }
}

if (isset($_POST['g']) && isset($_POST['f'])){
    $d = $_POST['g'];
    $c = $_POST['f'];
    $fr = $cn->query("SELECT email FROM $c where acct_no='$d'");
    while($res=$fr->fetch_assoc()){
        echo $res['email'];
    }
}

if (isset($_POST['bvn']) && isset($_POST['c'])){
    $bvn = $_POST['bvn'];
    $c = $_POST['c'];
    $fr = $cn->query("SELECT bvn FROM $c where bvn='$bvn'");
    while($res=$fr->fetch_assoc()){
        echo $res['bvn'];
    }
}