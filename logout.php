<input type="button" Onclick="delete()">

function delete(){
var result = confirm("Are you want to logout?");
if (result) {
<?php
    session_start();
    session_destroy();
    header("location:index.php");

?>
}