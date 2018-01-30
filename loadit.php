<?php
/**
 * Created by PhpStorm.
 * User: oyetola
 * Date: 1/22/2018
 * Time: 9:45 PM
 */
require 'conn.php';
$email = $_POST['emal'];
if (isset($email)){
    $fr = $cn->query("SELECT * FROM users where email='$email'");
    while($res=$fr->fetch_assoc()){
        echo '<div class="col-2">'.$res['name'].'<div>';
        echo '<div class="col-2">'.$res['acct_no'].'<div>';
        echo '<div class="col-2">'.$res['bvn'].'<div>';
    }
}