<html>
<head>
  <meta charset="UTF-8" />
  <title>SLOTTET</title>
  <link rel="stylesheet" href="/css/bootstrap.min.css" />
	<script src='/js/jquery-1.10.2.js' type="text/javascript"></script>
	<script src='/js/jquery-ui.custom.min.js' type="text/javascript"></script>
	<script type="text/javascript" src="/js/common.js"></script>
	<script src="/js/jquery.js"></script>
	<script src="/js/bootstrap.js"></script>


</head>
<style>
     #jb-container {
       width: 940px;
       margin: 10px auto;
       padding: 20px;
       border: 1px solid #bcbcbc;
     }
     #jb-header {
       padding: 20px;
       margin-bottom: 20px;
       border: 1px solid #bcbcbc;
     }
     #jb-content {
       width: 580px;
       padding: 20px;
       margin-bottom: 20px;
       float: left;
       border: 1px solid #bcbcbc;
     }
     #jb-sidebar {
       width: 260px;
       padding: 20px;
       margin-bottom: 20px;
       float: right;
       border: 1px solid #bcbcbc;
     }
     #jb-footer {
       clear: both;
       padding: 20px;
       border: 1px solid #bcbcbc;
     }
     @media ( max-width: 480px ) {
       #jb-container {
         width: auto;
       }
       #jb-content {
         float: none;
         width: auto;
       }
       #jb-sidebar {
         float: none;
         width: auto;
       }
     }
   </style>
<body>

  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#"><img src = /castle.png style="wideth:50px; height:50px;border:0;" alt="Slottet" />&nbsp;SLOTTET</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="../Home.html">Home<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Event</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Schedule.html">Schedule</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" id="re_bt" type="submit">Search</button>
        </form>
      </div>
    </nav>
		</html>
<?php
	include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */
  include $_SERVER['DOCUMENT_ROOT']."/password.php"; /* db load */

?>
<!doctype html>
<head>

<title>Board</title>

</head>
<body>
	<?php
		$bno = $_GET['idx']; /* bno함수에 idx값을 받아와 넣음*/
		$hit = mysqli_fetch_array(mq("select * from board where idx ='$bno'"));
		$hit = $hit['hit'] + 1;
		$fet = mq("update board set hit = '".$hit."' where idx = '".$bno."'");
		$sql = mq("select * from board where idx='".$bno."'"); /* 받아온 idx값을 선택 */
		$board = $sql->fetch_array();
	?>
<!-- 글 불러오기 -->

<div class="container">
	<h2><?php echo $board['title']; ?></h2>
<table class="table" style="margin:auto; text-align:center;">
	<thead class="thead-dark">

	<tr>
			<th scope="col">Writer</th>
			<td scope="col"><?php echo $board['name']; ?></td>

	</tr>
	<tr>
		<th scope="col">Date</th>
		<td scope="col"><?php echo $board['date']; ?></td>

	</tr>
	<tr>
		<th scope="col">Hit</th>
		<td scope="col"><?php echo $board['hit']; ?></td>
	</tr>
</thead>
</table>
<table class="table" style="margin:auto; text-align:center;">
	<thead class="thead-dark">
	<tr>
		<th style="width:50px; margin:auto; text-align:center;">
			contents
		</th>
		<td style="margin:auto; text-align:left; height:300px;"><?php echo $board['content'] ?></td>
		</tr>

		<tr>
		<th>FILE</th>
		<td>
		<a href="/upload/<?php echo $board['file'];?>" download><?php echo $board['file']; ?></a>
		</td>
	</tr>
	</thead>
</table>

	<!-- 목록, 수정, 삭제 -->
	<ul class="pagination  pagination-sm justify-content-end">
		  <li class="page-item"><a class="page-link"href="/Event.php">목록으로</a></li>
			  <li class="page-item"><a class="page-link" href="modify.php?idx=<?php echo $board['idx']; ?>">Edit</a></li>
			  <li class="page-item"><a class="page-link" href="delete.php?idx=<?php echo $board['idx']; ?>">Delete</a></li>
		</ul>

	<!--- 댓글 불러오기 -->

<div class="container">

	<div class="reply_view">
	<h3>Comments</h3>

</div>

		<?php
			$sql3 = mq("select * from reply where con_num='".$bno."' order by idx desc");
			while($reply = $sql3->fetch_array()):
		?>
    <div class="container">

		<div class="dap_lo">
			<div><b><?php echo $reply['name'];?></b></div>
			<?php echo nl2br("$reply[content]"); ?>
			<?php echo $reply['date']; ?></div>
			<div class="rep_me rep_menu">
			<!-- <a class="dat_edit_bt" href="#">수정</a> -->
			<a id="dat_delete_bt" href="#">삭제</a>
      <br>
		</div>
</div>

			<!-- 댓글 수정 폼 dialog -->
<!-- <div class="dat_edit">
				<form method="post" action="rep_modify_ok.php">
					<input type="hidden" name="rno" value="<?php echo $reply['idx']; ?>" /><input type="hidden" name="b_no" value="<?php echo $bno; ?>">
					<input type="password" name="pw" class="dap_sm" placeholder="비밀번호" />
					<textarea name="content" class="dap_edit_t"><?php echo $reply['content']; ?></textarea>
					<input type="submit" value="수정하기" class="re_mo_bt">
				</form>
</div> -->
			<!-- 댓글 삭제 비밀번호 확인 -->
<!-- <div class='dat_delete'>
				<form action="reply_delete.php" method="post">
					<input type="hidden" name="rno" value="<?php echo $reply['idx']; ?>" /><input type="hidden" name="b_no" value="<?php echo $bno; ?>">
			 		<p>password<input type="password" name="pw" /> <input type="submit" value="확인"></p>
				 </form>
</div> -->
	<?php endWhile; ?>
	<!--- 댓글 입력 폼 -->
  <div class="container">

  	<form method="post" name = "reply_form" class="reply_form">
			<input type="hidden" name="bno" value="<?php echo $bno; ?>">
			<input type="text" class="form-control" name="dat_user" id="dat_user" size="5" style="width:80px; float:left;" placeholder="ID">
			<input type="password" class="form-control" name="dat_pw" id="dat_pw" size="5"  style="width:80px;" placeholder="Password"><br>
			<textarea name="content" class="form-control" id="re_content"></textarea><br>
			<input type="button" class="re_bt" value="comment"></button>
		</form>
  </div>

<!--- 댓글 불러오기 끝 -->
<div id="foot_box"></div>
</div>
</body>

<script type="text/javascript">
$(function(){
	/* re_bt클래스 클릭시 동작(댓글입력) */
	$(".re_bt").click(function(){
		var params = $("form").serialize();
				$.ajax({
					type: "post",
					url: "reply_ok.php?=<?php echo $board['idx'];?>",
					data : params,
					dataType : "html",
					success: function(data){

						$(".reply_view").html(data);
						$(".reply_content").val('');
					}
				});
		});

	$("#dat_edit_bt").click(function(){

		/* dat_edit_bt클래스 클릭시 동작(댓글 수정) */
			//var obj = $(this).closest(".dap_lo").find(".dat_edit");

			#dat_delete_bt.dialog({
				modal:true,
				width:650,
				height:200,
				title:"댓글 수정"});
		});


	$(".dat_delete_bt").click(function(){
		/* dat_delete_bt클래스 클릭시 동작(댓글 삭제) */
		var obj = $(this).closest(".dap_lo").find(".dat_delete");
		obj.dialog({
			modal:true,
			width:400,
			title:"댓글 삭제확인"});
		});

	});
	</script>

</html>
