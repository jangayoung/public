<?php
  header('Content-Type: text/html; charset=utf-8');
	include $_SERVER['DOCUMENT_ROOT']."/db.php";
    include $_SERVER['DOCUMENT_ROOT']."/password.php"; /* db load */


	$bno = $_GET['idx'];
	$sql = mq("delete from board where idx='$bno';");
?>
<script type="text/javascript">alert("삭제되었습니다.");</script>
<meta http-equiv="refresh" content="0 url=/" />
