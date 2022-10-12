<?php
session_start();
$msg = "";
if (isset($_POST['btnreg'])) {
    $name = $_POST['cname'];
    $path = "";
    if ($_FILES['cimage']['error'] == 0) {
        $from = $_FILES['cimage']['tmp_name'];
        $to = $_SERVER['DOCUMENT_ROOT'] . "/e-Voting/pics/" . $_FILES['cimage']['name'];
        move_uploaded_file($from, $to);
        $path = "pics/" . $_FILES['cimage']['name'];
    }
    $catg = $_POST['category'];
    $pid = $_POST['pid'];
    $link = mysqli_connect("localhost", "root", "Rishu@9155", "votingdb");
    $qry = "insert into candidate(c_name,c_image,cid,pid)values('$name','$path','$catg','$pid')";
    mysqli_query($link, $qry);
    if (mysqli_affected_rows($link) > 0) {
        $msg = "Candidate registered Successfully !!!!";
    } else {
        $msg = "Error in Registration .....";
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
        <title>e-Voting </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
    <body class="bg-primary">
        <?php
        include("navbar.php");
        ?>

        <div class="Container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3>&nbsp;Candidate Form</h3>
                    <hr align="center" width ="99%" size="1px" color="white">
                    <form method="post" enctype="multipart/form-data">
                        <input type="hidden" name="pid" value="<?php echo $_GET['id']; ?>">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3" align="center" style="margin-top:10px;">
                                    <div style="padding:7px;"><label for="voterid" >Candidate Name</label></div>
                                </div>

                                <div class="col-sm-9">
                                    <div style="padding:5px;">
                                        <input type="text" required name="cname" class="form-control" id="vid">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3" align="center" style="margin-top:10px;">
                                    <div><label for="voterid" >Candidate Image</label></div>
                                </div>

                                <div class="col-sm-9">
                                    <div style="padding:5px;">
                                        <input type="file" required id="myFile" class="form-control" name="cimage">
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3" align="center" style="margin-top:10px;">
                                    <div ><label for="voterid" >Select Category</label></div>
                                </div>

                                <div class="col-sm-9">
                                    <div class="form-group" style="padding:5px;">
                                        <select class="form-control" id="sel1" name="category">
                                            <?php
                                            $link = mysqli_connect("localhost", "root", "Rishu@9155", "votingdb");
                                            $qry = "select * from category";
                                            $resultset = mysqli_query($link, $qry);
                                            if (mysqli_num_rows($resultset) > 0) {

                                                while ($r = mysqli_fetch_array($resultset)) {
                                                    echo "<option>";

                                                    echo "$r[0]. $r[1]";

                                                    echo "</option>";
                                                }
                                            } else {
                                                echo "<h2 style='color:white; text-align:center'>NO Record Found !!!!</h2>";
                                            }
                                            mysqli_close($link);
                                            ?>
                                        </select>
                                    </div>
                                    <div style="padding:5px;">
                                        <input type="submit" name="btnreg" id="vid2" value="Save" style="background-color:red;border:0;">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo $msg; ?>
                    </form>
                </div>
                <div class="col-sm-6">
                    <h3>View Candidate</h3>
                    <hr align="center" width ="99%" size="1px" color="white">
                    <?php
                    $link = mysqli_connect("localhost", "root", "Rishu@9155", "votingdb");
                    $qry = "select * from candidate";
                    $resultset = mysqli_query($link, $qry);
                    if (mysqli_num_rows($resultset) > 0) {
                        echo "<div class='table-reponsive'>";
                        echo "<table border='1' style='border-color:white;' class='table table-reponsive>";
                        echo "<tr style='color:red;'>";
                        echo "<th>Id</th><th>Name</th><th>image</th><th>cid</th><th>pid</th><th></th>";
                        echo "</tr>";
                        while ($r = mysqli_fetch_array($resultset)) {
                            echo "<tr style='color:black;'>";
                            echo "<td>$r[0]</td>";
                            echo "<td>$r[1]</td>";
                            echo "<td><img src='$r[2]' alt='image' style='width:50px;height:60px;'></td>";
                            echo "<td>$r[3]</td>";
                            echo "<td>$r[4]</td>";
                            echo "<td><a class='btn btn-danger' href='deleteCandidate.php?id=$r[0]' onclick='return confirm(\"Are you sure to delete this record?\")'>Delete Record</a></td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                        echo "</div>";
                    } else {
                        echo "<h2 style='color:white; text-align:center'>NO Record Found !!!!</h2>";
                    }
                    mysqli_close($link);
                    ?>
                </div>
            </div>
        </div>

    </body>
</html>
