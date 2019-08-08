<!DOCTYPE html>
<?php
  include  $_SERVER['DOCUMENT_ROOT']."/db.php";
    include $_SERVER['DOCUMENT_ROOT']."/password.php"; /* db load */
?>

<html>
<head>
  <meta charset="UTF-8" />
  <title>SLOTTET</title>
  <link rel="stylesheet" href="/css/bootstrap.min.css" />
  <script src='/js/jquery-1.10.2.js' type="text/javascript"></script>
  <script src='/js/jquery-ui.custom.min.js' type="text/javascript"></script>
</head>
<body>

  <!-- <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="Home.html"><img src = castle.png style="wideth:50px; height:50px;border:0;" alt="Slottet" />&nbsp;SLOTTET</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item ">
            <a class="nav-link" href="Home.html">Home</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#">Event<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Schedule.html">Schedule</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>



    <div class="jumbotron">
      <h1 class="display-4 text-right">Velkommen, Slottet!</h1>
      <p class="lead text-right">Come in, enjoy-!</p>
      <hr class="my-4">
      <p class="text-right">This is our homepage.<br /> if you want to open the door, push the below button.<br /> Velkommen til Slottet :)</p>
      <a class="btn btn-primary btn-lg" href="#" role="button">Open</a>
    </div>
  </div> -->
  <div class="dropdown-menu">
  <a class="dropdown-item" href="Home.html">Home</a>
  <a class="dropdown-item disabled" href="#" tabindex="-1" aria-disabled="true">Disabled link</a>
  <a class="dropdown-item" href="Schedule.html">Schedule</a>
  <a class="dropdown-item" href="Maps.html">Map</a>
</div>

 <div class="container">
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Name</th>
          <th scope="col">Date</th>
          <th scope="col">Hit</th>

        </tr>
      </thead>

    <?php
        if(isset($_GET['page'])){
          $page = $_GET['page'];
            }else{
              $page = 1;
            }
              $sql = mq("select * from board");
              $row_num = mysqli_num_rows($sql); //게시판 총 레코드 수
              $list = 10; //한 페이지에 보여줄 개수
              $block_ct = 5; //블록당 보여줄 페이지 개수

              $block_num = ceil($page/$block_ct); // 현재 페이지 블록 구하기
              $block_start = (($block_num - 1) * $block_ct) + 1; // 블록의 시작번호
              $block_end = $block_start + $block_ct - 1; //블록 마지막 번호

              $total_page = ceil($row_num / $list); // 페이징한 페이지 수 구하기
              if($block_end > $total_page) $block_end = $total_page; //만약 블록의 마지박 번호가 페이지수보다 많다면 마지박번호는 페이지 수
              $total_block = ceil($total_page/$block_ct); //블럭 총 개수
              $start_num = ($page-1) * $list; //시작번호 (page-1)에서 $list를 곱한다.

              $sql2 = mq("select * from board order by idx desc limit $start_num, $list");
              while($board = $sql2->fetch_array()):

              $title=$board["title"];
                if(strlen($title)>30)
                {
                  $title=str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]);
                }
                $sql3 = mq("select * from reply where con_num='".$board['idx']."'");
                $rep_count = mysqli_num_rows($sql3);
              ?>
  <tbody>
    <tr>
      <td width="70"><?php echo $board['idx']; ?></td>
      <td width="500"><?php
    $lockimg = "<img src='lock.png' alt='lock' title='lock' width='20' height='20' />";
    if($board['lock_post']=="1")
      { ?><a href='/board/ck_read.php?idx=<?php echo $board["idx"];?>'><?php echo $title, $lockimg;
        }else{

                    $boardtime = $board['date']; //$boardtime변수에 board['date']값을 넣음
                    $timenow = date("Y-m-d"); //$timenow변수에 현재 시간 Y-M-D를 넣음

                    if($boardtime==$timenow){?>
                    <span class="badge badge-info">NEW</span>
                  <?php  }else{
                      $img ="";
                    }
                    ?>

    <a href='/board/read.php?idx=<?php echo $board["idx"]; ?>'><?php echo $title; }?><span class="re_ct">[<?php echo $rep_count; ?>]</span></a></td>
      <td width="120"><?php echo $board['name']?></td>
      <td width="100"><?php echo $board['date']?></td>
      <td width="100"><?php echo $board['hit']; ?></td>
    </tr>
  </tbody>
<?php endwhile; ?>
</table>
</div>
<div class="container">
  <ul class="pagination justify-content-center">
    <?php
      if($page <= 1)
      { //만약 page가 1보다 크거나 같다면
        echo "<li class='page-item disabled'><a class='page-link' tabindex='-1' aria-disabled='true'><<</a></li>"; //처음이라는 글자에 빨간색 표시
      }else{
        echo "<li class='page-item'><a class='page-link' href='?page=1'><<</a></li>"; //알니라면 처음글자에 1번페이지로 갈 수있게 링크
      }
      if($page <= 1)
      { //만약 page가 1보다 크거나 같다면 빈값

      }else{
      $pre = $page-1; //pre변수에 page-1을 해준다 만약 현재 페이지가 3인데 이전버튼을 누르면 2번페이지로 갈 수 있게 함
        echo "<li class='page-item'><a class='page-link' href='?page=$pre'><</a></li>"; //이전글자에 pre변수를 링크한다. 이러면 이전버튼을 누를때마다 현재 페이지에서 -1하게 된다.
      }
      for($i=$block_start; $i<=$block_end; $i++){
        //for문 반복문을 사용하여, 초기값을 블록의 시작번호를 조건으로 블록시작번호가 마지박블록보다 작거나 같을 때까지 $i를 반복시킨다
        if($page == $i){ //만약 page가 $i와 같다면
          echo "<li class='page-item disabled'><a class='page-link' tabindex='-1' aria-disabled='true'>$i</a></li>"; //현재 페이지에 해당하는 번호에 굵은 빨간색을 적용한다
        }else{
          echo "<li class='page-item'><a class='page-link' href='?page=$i'>$i</a></li>"; //아니라면 $i
        }
      }
      if($block_num >= $total_block){ //만약 현재 블록이 블록 총개수보다 크거나 같다면 빈 값
      }else{
        $next = $page + 1; //next변수에 page + 1을 해준다.
        echo "<li class='page-item'><a class='page-link' href='?page=$next'>></a></li>"; //다음글자에 next변수를 링크한다. 현재 4페이지에 있다면 +1하여 5페이지로 이동하게 된다.
      }
      if($page >= $total_page){ //만약 page가 페이지수보다 크거나 같다면
        echo "<li class='page-item disabled'><a class='page-link' tabindex='-1' aria-disabled='true' >>></a></li>"; //마지막 글자에 긁은 빨간색을 적용한다.
      }else{
        echo "<li class='page-item'><a class='page-link'href='?page=$total_page'>>></a></li>"; //아니라면 마지막글자에 total_page를 링크한다.
      }
    ?>
  </ul>
</div>



<div class="container">
<div align="right">
  <a href="/board/write.php"><button class="btn btn-primary" style="margin:50px" >Wirte</button></a>
</div>
</div>





</body>
</html>
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.js"></script>
