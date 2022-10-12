<input type="button" Onclick="delete()">

function delete(){
var result = confirm("Are you want to delete");
if (result) {
<?php
   $eid = $_GET['id'];
   $link = mysqli_connect("localhost","root","Rishu@9155","votingdb");
   $qry = "delete from election where pid=$eid";
   mysqli_query($link,$qry);
   mysqli_close($link);
   header("location:Voting_list.php");
    
?>
}
}