<body bgcolor="brown">
<form enctype="multipart/form-data" method="post" role="form">
<div class="form-group">
<label for="exampleInputFile"><b>File Upload </b></label>
<input type="file" name="file" id="file" size="65535">
</div>
<br>
<button type="submit" class="btn btn-default" name="Import"
value="Import">Upload</button>
</form>
</body>
<?php
if(isset($_POST["Import"]))
{
$host='localhost';
$db_user= 'root';
$db_password= '';
$db= 'marks';
$con=mysqli_connect($host,$db_user,$db_password) or die
(mysqli_error($con));
mysqli_select_db($con,$db) or die (mysqli_error($con));
$filename=$_FILES["file"]["tmp_name"];
if($_FILES["file"]["size"] > 0)
{
$file = fopen($filename, "r");
$count = 0;
while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
{
$count++;
if($count>0){
$sql = "INSERT into reportcard(ID,Name,Rollno,Totalmark,Grade) values ('$emapData[0]','$emapData[1]','$emapData[2]','$emapData[3]','$emapData[4]')";
mysqli_query($con,$sql);
}
}
fclose($file);
$sql = "SELECT * FROM reportcard";
$result = mysqli_query($con,$sql);
if ($result->num_rows > 0) {
?>

<style>
table {
font-size: large;
border: 1px solid black;
}
td {
border: 1px solid black;
}
th, td {
font-weight: bold;
border: 1px solid black;
padding: 10px;
text-align: center;
}
td {
font-weight: lighter;
}
</style>
<body bgcolor="#ffffff">
<table>
<tr>
<th>ID</th>
<th>NAME</th>
<th>ROLLNUMBER</th>
<th>TOTAL MARKS</th>
<th>GRADE</th>
</tr>
<?php
while($row = $result->fetch_assoc())
{
?>
<tr>
<td><?php echo $row['ID'];?></td>
<td><?php echo $row['Name'];?></td>
<td><?php echo $row['Rollno'];?></td>
<td><?php echo $row['Totalmark'];?></td>
<td><?php echo $row['Grade'];?></td>
</tr>
<?php
}
?>
</table>
</body>
<?php
}
else
{
echo "0 results";
}
}
}
?>
