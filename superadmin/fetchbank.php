<?php
/**
 * Created by PhpStorm.
 * User: oyetola
 * Date: 1/27/2018
 * Time: 3:58 PM
 */
require '../conn.php';

if (isset($n)){
    $n= $_POST['n'];
    $fr = $cn->query("SELECT * FROM bank");
    while($res=$fr->fetch_assoc()){
        echo "<li>".$res['bank']."</li>";
    }
}



    if (isset($_POST['d'])) {
    try {
        $d = $_POST['d'];
        $i = 0;
        $res = $cn->query("SELECT * FROM $d");
        if ($res->num_rows > 0) {
            while ($dat = $res->fetch_assoc()) {
                $i=$i + 1;
                echo "<tr>";
                echo "<td>" . $i . "</td>";
                echo "<td>" . $dat['acct_no'] . "</td>";
                echo "<td>" . $dat['name'] . "</td>";
                echo "<td>" . $dat['email'] . "</td>";
                echo "<td>" . $dat['bvn'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo '<tr><b>' . 'No record(s) found' . '</b></tr>';

        }
    }
    catch (Exception $e){
        echo $e->getMessage();
        die( "No record detected for this bank");
    }
}

if (isset($_POST['f'])) {
    try {
        $f = $_POST['f'];
        $res = $cn->query("UPDATE banks SET `status`= 0 WHERE `banks`= '$f'");
        if ($res->num_rows > 0) {
            echo "Successful";
        }
    }
    catch (Exception $e){
        echo $e->getMessage();
        die( "No record detected for this bank");
    }
}

if (isset($_POST['g'])) {
    try {
        $g = $_POST['g'];
        $res = $cn->query("UPDATE banks SET `status`= '1' WHERE `banks`= '$g'");
        if ($res->num_rows > 0) {
            echo "Successful";
        }
    }
    catch (Exception $e){
        echo $e->getMessage();
        die( "No record detected for this bank");
    }
}