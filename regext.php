<?php 
require 'conn.php';
if (isset($_POST['d']) && isset($_POST['c'])){
$d = $_POST['d'];
$c = $_POST['c'];
    $fr = $cn->query("SELECT * FROM $c where acct_no='$d'");
    while($res=$fr->fetch_assoc()){
        echo $res['name'];
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