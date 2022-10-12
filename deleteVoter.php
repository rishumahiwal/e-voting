
<input type="button" Onclick="delete()">

function delete(){
var result = confirm("Are you want to delete");
if (result) {
<?php
$vid = $_GET['id'];
$link = mysqli_connect("localhost", "root", "Rishu@9155", "votingdb");
$qry = "delete from voter where voter_id=$vid";
mysqli_query($link, $qry);
mysqli_close($link);
header("location:Users.php");
?>
}
}