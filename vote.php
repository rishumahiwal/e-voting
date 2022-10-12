<?php
session_start();
//if(!isset($_SESSION['vid']))
//{
//    header("location:index.php");
//}
$msg = "";
if (isset($_POST['btnvote'])) {
    $vp = $_POST['p1'];
    $gs = $_POST['p2'];
    $p = $_POST['p3'];
    $js = $_POST['p4'];
    $qry1 = "insert into voting_result(voter_id,c_id,pid) values($_SESSION[vid],$vp,$_SESSION[pid])";
    $qry2 = "insert into voting_result(voter_id,c_id,pid) values($_SESSION[vid],$gs,$_SESSION[pid])";
    $qry3 = "insert into voting_result(voter_id,c_id,pid) values($_SESSION[vid],$p,$_SESSION[pid])";
    $qry4 = "insert into voting_result(voter_id,c_id,pid) values($_SESSION[vid],$js,$_SESSION[pid])";
    $link = mysqli_connect("localhost", "root", "Rishu@9155", "votingdb");
    mysqli_query($link, $qry1);
    mysqli_query($link, $qry2);
    mysqli_query($link, $qry3);
    mysqli_query($link, $qry4);
    if (mysqli_affected_rows($link) > 0)
        $msg = "<font color='white'>Your Vote is Successfully Casted !!!!!</font>";
    else {
        $msg = "<font color='white'>Error in Cast the Election !!!!!</font>";
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
                    <h3>&nbsp;&nbsp;Cast Your Vote</h3>
                    <hr align="center" width ="99%" size="1px" color="white">
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6">
                            <form method="post" class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top:18px;">Choose Election</label>
                                    <div class="col-sm-6" style="padding:10px;">
                                        <select class="form-control" name="etype">
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
                                    <?php
                                    if (isset($_SESSION['utype'])) {
                                        echo "<div 'col-sm-3' style='padding:10px;'>";
                                        echo "<input type='submit' name='btnshow' value='Show' class='btn btn-danger'>";
                                        echo "</div>";
                                    } else {
                                        echo "<div style='padding:10px;'>";
                                        echo "<a class='btn btn-danger' href='index.php'>Login to continue</a>";
                                        echo "</div>";
                                    }
                                    ?>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-3"></div>
                    </div>
                </div>
                <form method="post">
                    <?php
                    echo $msg;
                    if (isset($_POST['btnshow'])) {
                        $id = $_POST['etype'];
                        $_SESSION['pid'] = $id;
                        $link = mysqli_connect("localhost", "root", "Rishu@9155", "votingdb");
                        $res = mysqli_query($link, "Select * from voting_result where voter_id=$_SESSION[vid] and pid=$id");
                        if (mysqli_num_rows($res) == 0) {
                            $qry = "select * from candidate where pid=$id and cid=(select cid from category where cname='Vice-President')";
                            $result = mysqli_query($link, $qry);
                            echo "<div class='row'><div class='col-sm-12 text-center'><h3 style='color:yellow;'>Vice-President</h3></div></div>";
                            echo "<div class='row text-center'>";
                            echo "<div class = 'col-sm-1'></div>";
                            while ($r = mysqli_fetch_array($result)) {
                                echo "<div class = 'col-sm-2'>";
                                echo "<div class = 'row'><div class = 'col-sm-12'>";
                                echo "<img src = '$r[2]' alt = 'image' style = 'width:50px;height:60px;'>";
                                echo "</div></div>";
                                echo "<div class = 'row'><div class = 'col-sm-12'>";
                                echo "<label>$r[1]</label>";
                                echo "</div></div>";
                                echo "<div class = 'row'><div class = 'col-sm-12'>";
                                echo "<input type = 'radio' name = 'p1' value = '$r[0]'/>";
                                echo "</div></div>";
                                echo "</div>";
                            }
                            echo "</div>";

                            $qry = "select * from candidate where pid=$id and cid=(select cid from category where cname='General Secretary')";
                            $result = mysqli_query($link, $qry);
                            echo "<div class='row'><div class='col-sm-12 text-center'><h3 style='color:yellow;'>General Secretary</h3></div></div>";
                            echo "<div class='row text-center'>";
                            echo "<div class = 'col-sm-1'></div>";
                            while ($r = mysqli_fetch_array($result)) {
                                echo "<div class = 'col-sm-2'>";
                                echo "<div class = 'row'><div class = 'col-sm-12'>";
                                echo "<img src = '$r[2]' alt = 'image' style = 'width:50px;height:60px;'>";
                                echo "</div></div>";
                                echo "<div class = 'row'><div class = 'col-sm-12'>";
                                echo "<label>$r[1]</label>";
                                echo "</div></div>";
                                echo "<div class = 'row'><div class = 'col-sm-12'>";
                                echo "<input type = 'radio' name = 'p2' value = '$r[0]'/>";
                                echo "</div></div>";
                                echo "</div>";
                            }
                            echo "</div>";

                            $qry = "select * from candidate where pid=$id and cid=(select cid from category where cname='President')";
                            $result = mysqli_query($link, $qry);
                            echo "<div class='row'><div class='col-sm-12 text-center'><h3 style='color:yellow;'>President</h3></div></div>";
                            echo "<div class='row text-center'>";
                            echo "<div class = 'col-sm-1'></div>";
                            while ($r = mysqli_fetch_array($result)) {
                                echo "<div class = 'col-sm-2'>";
                                echo "<div class = 'row'><div class = 'col-sm-12'>";
                                echo "<img src = '$r[2]' alt = 'image' style = 'width:50px;height:60px;'>";
                                echo "</div></div>";
                                echo "<div class = 'row'><div class = 'col-sm-12'>";
                                echo "<label>$r[1]</label>";
                                echo "</div></div>";
                                echo "<div class = 'row'><div class = 'col-sm-12'>";
                                echo "<input type = 'radio' name = 'p3' value = '$r[0]'/>";
                                echo "</div></div>";
                                echo "</div>";
                            }
                            echo "</div>";

                            $qry = "select * from candidate where pid=$id and cid=(select cid from category where cname='Joint Secretary')";
                            $result = mysqli_query($link, $qry);
                            echo "<div class='row'><div class='col-sm-12 text-center'><h3 style='color:yellow;'>Joint Secretary</h3></div></div>";
                            echo "<div class='row text-center'>";
                            echo "<div class = 'col-sm-1'></div>";
                            while ($r = mysqli_fetch_array($result)) {
                                echo "<div class = 'col-sm-2'>";
                                echo "<div class = 'row'><div class = 'col-sm-12'>";
                                echo "<img src = '$r[2]' alt = 'image' style = 'width:50px;height:60px;'>";
                                echo "</div></div>";
                                echo "<div class = 'row'><div class = 'col-sm-12'>";
                                echo "<label>$r[1]</label>";
                                echo "</div></div>";
                                echo "<div class = 'row'><div class = 'col-sm-12'>";
                                echo "<input type = 'radio' name = 'p4' value = '$r[0]'/>";
                                echo "</div></div>";
                                echo "</div>";
                            }
                            echo "</div>";
                            echo "<input type='submit' class='btn btn-danger' style='margin-left:175px;margin-top:20px;'  name='btnvote' value='Give Vote'/>";
                        }
                        else
                            echo "You already cast your vote!!";
                        mysqli_close($link);
                    }
                    ?>
                </form>
            </div>
        </div>
    </body>
</html>
