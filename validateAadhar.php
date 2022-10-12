<?php
    $aadhar = $_GET['aid'];
    $link = mysqli_connect("localhost", "root", "Rishu@9155", "votingdb");
    $qry = "select *from voter where voter_aadhar=$aadhar";
    $resultset = mysqli_query($link, $qry);
    if (mysqli_num_rows($resultset) == 0)
        echo "<font colour='white'>Available</font>";
    else
        echo "<font colour='red'>Already Exist !!!</font>";
?>