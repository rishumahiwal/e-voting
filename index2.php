<?php
session_start();
$msg = "";
if (isset($_POST['btnlogin'])) {
    $id = $_POST['txtvoterid'];
    $pwd = $_POST['txtvoterpwd'];
    $link = mysqli_connect("localhost","root","Rishu@9155","votingdb");
    $qry = "select * from voter where voter_id = $id and voter_pwd='$pwd'";
    $result = mysqli_query($link, $qry);
    if (mysqli_num_rows($result) > 0) {
        $r = mysqli_fetch_assoc($result);
        $_SESSION['uname']=$r['voter_name'];
        $_SESSION['utype']=$r['voter_type'];
        $_SESSION['vid']=$r['voter_id'];
        header("location:vote.php");
    } else {
        $msg = "<font colour='red'>Invalid Username and Password</font>";
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
        <!--<section id="main" class="bg-primary" >-->
            <div class="container" style="margin-top:50px;padding:30px;">
                <div class="row">
                    <!--<div class="col-sm-1" ></div>-->
                    <div class="col-sm-4" ><h2>Online Voting System</h2></div>
                    <div class="col-sm-8" ></div>
                </div>
                <div class="row">
                    <div class="col-sm-1" ></div>
                    <div class="col-sm-10" style="background-color:white;color:black;border-radius:10px;padding:36px;margin:40px;" >
                        <p style="text-align:justify">
                            In "ONLINE VOTING SYSTEM" a voter can his/her voting right online without any difficulty. He/She has to be 
                            registered first for him/her to vote. Registration is mainly done by the system administrator for security reasons. 
                            The system administrator registers the voters on a special site of the system visited by him only by simple filling a registration form
                            to register voters.</br>After registration, the voter is assigned a secret Voter ID with which he/she can use to log into the system and 
                            enjoy services provided by the system such as voting. If invalid/wrong details are submitted, then the citizen is not registered 
                            to vote.
                        </p>

                    </div>
                    <div class="col-sm-1" ></div>

                </div>
            </div>
        <!--</section>-->
    </body>
</html>
