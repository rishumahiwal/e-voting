<?php
session_start();
$msg = "";
if (isset($_POST['btnctg'])) {
    $name = $_POST['namectg'];
    $link = mysqli_connect("localhost", "root", "Rishu@9155", "votingdb");
    $qry = "insert into category(cname)values('$name')";
    mysqli_query($link, $qry);
    if (mysqli_affected_rows($link) > 0) {
        $msg = "Category Added Successfully !!!!";
    } else {
        $msg = "Error in Adding Category .....";
    }
    mysqli_close($link);
}
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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
    <body class="bg-primary">
        <?php
        include("navbar.php");
        ?>
        <div class="Container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3>&nbsp;Add New Category</h3>
                    <hr align="center" width ="99%" size="1px" color="white">
                    <form method="post">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3"  align="center" style="margin-top:10px;">
                                    <label for="voterid" " >Category Name</label>
                                </div>
                                <div class="col-sm-9">
                                    <div style="padding:5px;">
                                        <input type="text" required name="namectg" class="form-control" id="vid">
                                    </div>
                                    <?php
                                    if (isset($_SESSION['utype'])) {
                                        if ($_SESSION['utype'] == 'admin') {
                                            echo "<div style='padding:5px;'>";
                                            echo "<input type='submit' name='btnctg' id='vid2' value='Add Category' style='background-color:red;border:0;'>";
                                            echo "</div>";
                                        } else {
                                            echo "<div style='padding:5px;'>";
                                            echo "<font class='btn btn-danger'>You are not a Admin</font>";
                                            echo "</div>";
                                        }
                                    } else {
                                        echo "<div style='padding:5px;'>";
                                        echo "<a class='btn btn-danger' href='index.php'>Login to continue</a>";
                                        echo "</div>";
                                    }
                                    ?>
                                    <?php echo $msg; ?>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-6">
                    <h3>Category Lists</h3>
                    <hr align="center" width ="99%" size="1px" color="white">
                    <?php
                    if (isset($_SESSION['utype'])) {
                        if ($_SESSION['utype'] == 'admin') {
                        $link = mysqli_connect("localhost", "root", "Rishu@9155", "votingdb");
                        $qry = "select * from category";
                        $resultset = mysqli_query($link, $qry);
                        if (mysqli_num_rows($resultset) > 0) {
                            echo "<div class='table-responsive'>";
                            echo "<table border='1' style='border-color:white;' class='table'>";
                            echo "<tr style='color:red;'>";
                            echo "<th>Category Id</th><th>Category Name</th><th></th>";
                            echo "</tr>";
                            while ($r = mysqli_fetch_array($resultset)) {
                                echo "<tr style='color:black;'>";
                                echo "<td>$r[0]</td>";
                                echo "<td>$r[1]</td>";
                                echo "<td><a class='btn btn-danger' href='deleteCategory.php?id=$r[0]' onclick='return confirm(\"Are you sure to delete this record?\")'>Delete Record</a></td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                            echo "</div>";
                        } else {
                            echo "<h2 style='color:white; text-align:center'>NO Record Found !!!!</h2>";
                        }
                        mysqli_close($link);
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
