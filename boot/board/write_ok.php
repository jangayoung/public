qw	20o<?php

// include $_SERVER['DOCUMENT_ROOT']."/db.php";
include $_SERVER['DOCUMENT_ROOT']."/password.php"; /* db load */

$date = date('Y-m-d');
$userpw = password_hash($_POST['pw'], PASSWORD_DEFAULT);
if(isset($_POST['lockpost'])){
	$lo_post = '1';
}else{
	$lo_post = '0';
}
error_reporting(E_ALL);
ini_set("display_errors", 1);

$tmpfile =  $_FILES['b_file']['tmp_name'];

$o_name = $_FILES['b_file']['name'];

$filename =$_FILES['b_file']['name'];
$folder = "/upload/".$filename;

//move_uploaded_file($tmpfile,$folder);
$db = new mysqli('ayoung.ch6vqaurrmle.eu-west-2.rds.amazonaws.com','ayoung','00000000','web');
$db->set_charset("utf8");

$name= $_POST['name'];
$title=$_POST['title'];
$content=addslashes($_POST['content']);

$sql =
"INSERT INTO board
(name,pw,title,content,date,lock_post,file)VALUES(
  '$name',
  '$userpw',
  '$title',
  '$content',
  '$date',
  '$lo_post',
  '$o_name'
  )";
  mysqli_query($db,$sql) or die(mysqli_error($db));

?>

 <script type="text/javascript">alert("complete!"); </script>
<meta http-equiv="refresh" content="0 url=/Event.php" />
