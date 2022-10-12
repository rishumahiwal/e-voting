
<input type="button" Onclick="delete()">

function delete(){
var result = confirm("Are you want to delete");
if (result) {
<?php
   $cid = $_GET['id'];
   $link = mysqli_connect("localhost","root","Rishu@9155","votingdb");
   $qry = "delete from candidate where c_id=$cid";
   mysqli_query($link,$qry);
   mysqli_close($link);
   header("location:candidate.php");
    
?>
}
}