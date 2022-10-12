<?php
session_start();
?>
<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>e-Voting</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
    <body class="bg-primary">
        <?php
        include("navbar.php");
        ?>
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <h2>View Register Voters</h2>
                    <hr>
                    <br>
                    <?php
                    if (isset($_SESSION['utype'])) {
                        if ($_SESSION['utype'] == 'admin') {
                            $link = mysqli_connect("localhost", "root", "Rishu@9155", "votingdb");
                            $qry = "select * from voter";
                            $resultset = mysqli_query($link, $qry);
                            if (mysqli_num_rows($resultset) > 0) {
                                echo "<div class='table-responsive'>";
                                echo "<table border='1' style='border-color:white;' class='table'>";
                                echo "<tr style='color:red;'>";
                                echo "<th>Voter Id</th><th>Name</th><th>Password</th><th>Aadhar No</th><th>Gender</th><th>Type</th><th></th>";
                                echo "</tr>";
                                while ($r = mysqli_fetch_array($resultset)) {
                                    echo "<tr style='color:black;'>";
                                    echo "<td>$r[0]</td>";
                                    echo "<td>$r[1]</td>";
                                    echo "<td>$r[2]</td>";
                                    echo "<td>$r[3]</td>";
                                    echo "<td>$r[4]</td>";
                                    echo "<td>$r[5]</td>";
                                    echo "<td><a class='btn btn-danger' href='deleteVoter.php?id=$r[0]' onclick='return confirm(\"Are you sure to delete this record?\")'>Delete Record</a></td>";
                                    echo "</tr>";
                                }
                                echo "</table>";
                                echo "</div>";
                            } else {
                                echo "<h2 style='color:white; text-align:center'>NO Record Found !!!!</h2>";
                            }
                            mysqli_close($link);
                        }
                        
                    } else {
                        echo "<div style='text-align:center;'><a class='btn btn-danger' href='index.php' >Login to continue</a></div>";
                    }
                    ?>
                </div>
            </div>
        </div>


    </body>
</html>
