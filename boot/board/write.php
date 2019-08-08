<!doctype html>
<?php
  include  $_SERVER['DOCUMENT_ROOT']."/db.php";
    include $_SERVER['DOCUMENT_ROOT']."/password.php"; /* db load */
      header('Content-Type: text/html; charset=utf-8');
?>

<html>
<head>
  <meta charset="UTF-8" />
  <title>SLOTTET</title>

  <link rel="stylesheet" href="/css/bootstrap.min.css" />
  <script src='/js/jquery-1.10.2.js' type="text/javascript"></script>
  <script src='/js/jquery-ui.custom.min.js' type="text/javascript"></script>
  <script src='/js/fullcalendar.js' type="text/javascript"></script>

</head>
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
            <a class="nav-link" href="Home.html">Home<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Event</a>
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


    <div id="container">
        <h1><a href="/Event.php">Board</a></h1>
        <table class="table table-bordered">
            <tr >
              <th colspan="2">
                SLOTTET Board
              </th>
            </tr>
                  <form class="needs-validation" novalidate action="write_ok.php" method="post"  enctype="multipart/form-data">
                    <tr>
                      <td>
                         <label for="validationTooltip01">Title</label>
                       </td>
                       <td>
                        <textarea class ="form-control" name="title" id="utitle" placeholder="title" maxlength="100" required></textarea><br><br>
                      </td>
                      </tr>
                      <tr>
                        <td>
                          <label for="validationTooltip01">Name</label>
                        </td>
                        <td>
                          <textarea class ="form-control" name="name" id="uname" placeholder="name" maxlength="100" required></textarea><br><br>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <label for="validationTooltip01">Contents</label>
                        </td>
                        <td>
                    <textarea class ="form-control" name="content" id="ucontent" placeholder="contents" style="width:100%" required></textarea><br><br>
                  </td>


                </tr>
                <tr>
                  <td>
                    <label for="validationTooltip01">Password</label>
                  </td>
                  <td>
                    <input type="password" class="form-control" name="pw" id="upw"  placeholder="password"/><br><br>
                    <input type="checkbox" class="form-check-input" value="1" name="lockpost" />해당글을 잠급니다.<br>
                  </td>
                </tr>
                <tr>
                  <td>
                    FILE
                  </td>
                  <td>
                    <input type="file"  value="1" name="b_file" />
                  </td>
                </tr>
              </table>

              <button type="submit" class="btn btn-outline-success my-2 my-sm-0">Ok</button>
            </form>
            </div>
        </div>
    </body>
</html>
<script src="/js/jquery.js"></script>
<script src="/js/bootstrap.js"></script>
