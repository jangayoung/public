<?php
	include $_SERVER['DOCUMENT_ROOT']."/db.php";
	include $_SERVER['DOCUMENT_ROOT']."/password.php";
  $bno = $_POST['bno'];
	$content=addslashes($_POST['content']);
	$userpw = password_hash($_POST['dat_pw'], PASSWORD_DEFAULT);
	$sql = mq("insert into reply(con_num,name,pw,content) values('$bno','".$_POST['dat_user']."','$userpw','$content')");

?>

<script type="text/javascript" src="/js/common.js"></script>
<meta http-equiv="refresh" content="0;url=read.php?idx=<?php echo $bno?>">
