<?php 
    $name = $_POST['name'];
    $address1 = $_POST['add1'];
    $address2 = $_POST['add2'];
    $city = $_POST['city'];
    $feedback = $_POST['feedback'];
    $con = mysqli_connect("localhost","root","");
if (!($con)) {
	die("error while connecting to the database");
}
else{
	print("Connection was successfull <br />");
}
$db = mysqli_select_db($con,"feedback");
$query ="create table feed(Name char(20), Address1 char(20), Address2 char(20), City char(20), Feedback char(200));";
mysqli_query($con,$query);
$query = "insert into feed values('$name','$address1','$address2','$city', '$feedback');";
mysqli_query($con,$query);
$result = mysqli_query($con,"select * from feed");
mysqli_close($con);
/*echo"<a href = 'http://localhost/C:/xampp/htdocs/feedback/Mini Project/webpage1.html'>";
echo"click here";
echo"</a>";*/
?>