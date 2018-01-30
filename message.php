<?php
/**
 * Created by PhpStorm.
 * User: oyetola
 * Date: 1/23/2018
 * Time: 7:10 PM
 */
require 'conn.php';
if (isset($_POST['sub'])){
    $ident = $_POST['identity'];
    $rand = $_POST['rand'];
    $message = $_POST['comment'];
        $fr = $cn->query("INSERT INTO messages(`email`, `ticket_no`, `message`) VALUES ('$ident','$rand','$message')");
        if ($fr){
            echo "<script>alert('Complaints received.Your ticket number is".$rand.". We will get back to you.');</script>";
            echo "<script>window.location.href='user.php';</script>";
        }

}