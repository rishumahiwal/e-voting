<?php
session_start();
$msg = "";
if (isset($_POST['btnreg'])) {
    $name = $_POST['txtname'];
    $pwd = $_POST['txtpwd'];
    $aadhar = $_POST['exampleInputAadharCard'];
    $gen = $_POST['gender'];
    $type = $_POST['usertype'];
    $link = mysqli_connect("localhost", "root", "Rishu@9155", "votingdb");
    $qry = "insert into voter(voter_name,voter_pwd,voter_aadhar,voter_gender,voter_type)values('$name','$pwd',$aadhar,'$gen','$type')";
    mysqli_query($link, $qry);
    if (mysqli_affected_rows($link) > 0) {
        $msg = "Voter Register Successfully !!!!";
    } else {
        $msg = "Error in Voter Registration .....";
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

        <script>
            function validateForm()
            {
                flag = true;
                pwd = document.getElementById("q1").value;
                if (pwd.length < 8) {
                    flag = false;
                    document.getElementById("a1").innerHTML = "password minimum contain 8 character";
                } else if (pwd.length >= 8)
                {
                    alph = 0;
                    digit = 0;
                    symbol = 0;
                    for (i = 0; i < pwd.length; i++) {
                        ch = pwd.charAt(i);
                        if ((ch >= 'A' && ch <= 'Z') || (ch >= 'a' && ch <= 'z'))
                            alph++;
                        else if (ch >= '0' && ch <= '9')
                            digit++;
                        else
                            symbol++;
                    }
                    if (digit >= 1 && alph >= 1 && symbol >= 1)
                    {
                        document.getElementById("a1").innerHTML = "";
                    } else
                    {
                        flag = false;
                        document.getElementById("a1").innerHTML = "Password contain atleast 1 character, 1 number, 1 symbol";

                    }
                } else {
                    document.getElementById("a1").innerHTML = "";
                }

                aadhar = document.getElementById("exampleInputAadharCard").value;
                if (aadhar.length !== 12) {
                    document.getElementById("message").innerHTML = "Invalid Aadhar Number";
                    flag = false;
                } else {
                    document.getElementById("message").innerHTML = "";
                }
                return flag;
            }
            function ValidateAadhar()
            {
                id = document.getElementById("exampleInputAadharCard").value;
                obj = new XMLHttpRequest();
                obj.open("get", "validateAadhar.php?aid=" + id, true);
                obj.send();
                obj.onreadystatechange=function(){
                    if (obj.readyState == 4 && obj.status == 200)
                    {
                        document.getElementById("message").innerHTML = obj.responseText;
                    }
                }
            }
        </script>
    </head>
    <body class="bg-primary">
<?php
include './navbar.php';
?>
        <div class="Container-fluid">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <h3>&nbsp;&nbsp;New Voter Registration</h3>
                    <hr align="center" width ="99%" size="1px" color="white">
                    <form  method="post" onsubmit="return validateForm()">
                        <div class="form-group">

                            <div class="row">
                                <div class="col-sm-3" align="center" style="margin-top:10px;">
                                    <div style="padding:7px;"><label for="voterid" >Name</label></div>
                                </div>

                                <div class="col-sm-9">
                                    <div style="padding:5px;">
                                        <input type="text" required name="txtname" class="form-control" id="vid">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3" align="center" style="margin-top:10px;">
                                    <div style="padding:7px;"><label for="voterid" >Password</label></div>
                                </div>

                                <div class="col-sm-9">
                                    <div style="padding:5px;">
                                        <input type="text" required name="txtpwd" class="form-control" id="q1">
                                        <label id="a1" style="color:red"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3" align="center" style="margin-top:10px;">
                                    <div style="padding:7px;"><label for="voterid" >Aadhar Number</label></div>
                                </div>

                                <div class="col-sm-9">
                                    <div style="padding:5px;">
                                        <input type="number" onchange="ValidateAadhar()" required id="exampleInputAadharCard"  name="exampleInputAadharCard" class="form-control">
                                        <label id="message" style="color:red"></label>
                                        <br>
                                        <button type="button" class="btn btn-danger" onclick="verify()">Verify</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3" align="center" style="margin-top:5px;">
                                    <div style="padding:4px;"><label for="voterid" >Gender</label></div>
                                </div>

                                <div class="col-sm-9">
                                    <div style="padding:5px;">
                                        <input type="Radio"  required name="gender" value="Male"><label>Male</label>
                                        <input type="Radio"  required name="gender" value="Female"><label>Female</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3" align="center" style="margin-top:10px;">
                                    <div><label for="voterid" >User Type</label></div>
                                </div>

                                <div class="col-sm-9">
                                    <div style="padding:5px;">
                                        <select name="usertype" class="form-control">
                                            <option value="voter">Voter</option>
                                            <option value ="admin">Admin</option>
                                        </select>
                                    </div>
<?php
if (isset($_SESSION['utype'])) {
    if ($_SESSION['utype'] == 'admin') {
        echo "<div style='padding:5px;'>";
        echo "<input type='submit' name='btnreg' id='vid4' value='Register' style='background-color:red;border:0;'>";
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
                <div class="col-sm-3"></div>
                <script type="text/javascript">
                    // multiplication table
                    const d = [
                        [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
                        [1, 2, 3, 4, 0, 6, 7, 8, 9, 5],
                        [2, 3, 4, 0, 1, 7, 8, 9, 5, 6],
                        [3, 4, 0, 1, 2, 8, 9, 5, 6, 7],
                        [4, 0, 1, 2, 3, 9, 5, 6, 7, 8],
                        [5, 9, 8, 7, 6, 0, 4, 3, 2, 1],
                        [6, 5, 9, 8, 7, 1, 0, 4, 3, 2],
                        [7, 6, 5, 9, 8, 2, 1, 0, 4, 3],
                        [8, 7, 6, 5, 9, 3, 2, 1, 0, 4],
                        [9, 8, 7, 6, 5, 4, 3, 2, 1, 0]
                    ]

                    // permutation table
                    const p = [
                        [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
                        [1, 5, 7, 6, 2, 8, 3, 0, 9, 4],
                        [5, 8, 0, 3, 7, 9, 6, 1, 4, 2],
                        [8, 9, 1, 6, 0, 4, 3, 5, 2, 7],
                        [9, 4, 5, 3, 1, 2, 6, 8, 7, 0],
                        [4, 2, 8, 6, 5, 7, 3, 9, 0, 1],
                        [2, 7, 9, 3, 8, 0, 6, 4, 1, 5],
                        [7, 0, 4, 6, 9, 1, 3, 2, 5, 8]
                    ]

                    // validates Aadhar number received as string
                    function validate(aadharNumber) {
                        var str = new String(aadharNumber);
                        if (str.length === 12)
                        {
                            let c = 0
                            let invertedArray = aadharNumber.split('').map(Number).reverse()

                            invertedArray.forEach((val, i) => {
                                c = d[c][p[(i % 8)][val]]
                            })

                            return (c === 0)
                        }
                    }

                    function verify() {
                        var message = document.getElementById("message");
                        var aadharNo = document.getElementById("exampleInputAadharCard").value;
                        if (validate(aadharNo)) {
                            message.innerHTML = 'Aadhar number verified';
                        } else {
                            message.innerHTML = 'Aadhar number is not valid';
                        }
                    }
                </script>
                </body>
                </html>
