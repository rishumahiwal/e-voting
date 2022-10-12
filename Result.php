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
                    <h3>&nbsp;&nbsp;Result</h3>
                    <hr align="center" width ="99%" size="1px" color="white">
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6">
                            <form method="post" class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top:18px;">Choose Election</label>
                                    <div class="col-sm-6" style="padding:10px;">
                                        <select class="form-control"  name="etype">
                                            <option value="false">Choose Election Type</option>
                                            <?php
                                            $link = mysqli_connect("localhost", "root", "Rishu@9155", "votingdb");
                                            $qry = "select * from election";
                                            $result = mysqli_query($link, $qry);
                                            while ($r = mysqli_fetch_array($result)) {
                                                echo "<option value='$r[0]'>$r[1]</option>";
                                            }
                                            mysqli_close($link);
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-3" style="padding:10px;">
                                        <input type="submit" name="btnshow" value="Show" class="btn btn-danger">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4">
                            <?php
                            if (isset($_POST['btnshow'])) {
                                $link = mysqli_connect("localhost", "root", "Rishu@9155", "votingdb");
                                $qry = "select x,y, cname from (Select count(voting_result.c_id) as x,(select c_name from candidate where c_id=voting_result.c_id) as y, (select cid from candidate where c_id=voting_result.c_id) as z from voting_result where pid=$_POST[etype] GROUP BY c_id) xy join category on category.cid=xy.z  ;";
                                $result = mysqli_query($link, $qry);
                                echo "<table class='table' style='background-color:tomato'>";
                                echo "<tr><th>Candidate Name</th><th>Total Votes</th><th>Category</th></tr>";
                                while ($r = mysqli_fetch_array($result)) {
                                    echo "<tr>";
                                    echo "<td>$r[1]</td>";
                                    echo "<td>$r[0]</td>";
                                    echo "<td>$r[2]</td>";
                                    echo "</tr>";
                                }
                                echo "</table>";
                                mysqli_close($link);
                            }
                            ?>
                        </div>
                        <div class="col-sm-4"></div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
