<?php
/**
 * Created by PhpStorm.
 * User: oyetola
 * Date: 1/23/2018
 * Time: 7:10 PM
 */
require 'conn.php';
if (isset($_POST['sub']) && !empty($_POST['comment'])){
    try {
        $ident = $_POST['identity'];
        $rand = $_POST['rand'];
        $message = $_POST['comment'];
        $dat = new DateTime('now', new DateTimeZone('Africa/Lagos'));
        $dat = $dat->format('d/m/Y h:m:s');
        $fr = $cn->query("INSERT INTO messages(`email`, `ticket_no`, `message`, `messageTime`) VALUES ('$ident','$rand','$message', '$dat')");
        if ($fr) {
            echo "<script>alert('Complaints received.Your ticket number is" . $rand . ". We will get back to you.');</script>";
            echo "<script>window.location.href='user.php';</script>";
        } else {
            echo "<script>alert('There was a problem. Try again!');</script>";
            echo "<script>window.location.href='user.php';</script>";
        }
    } catch(Exception $e){
        die("It is a query error".$e->getmessage());
    }
}