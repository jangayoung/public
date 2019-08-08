<?php
    #Host : EC2의 dns를 입력한다
    // $host = 'ayoung.ch6vqaurrmle.eu-west-2.rds.amazonaws.com';
    // #user : EC2에 설치된 mysql의 사용자를 입력한다
    // $user = 'ayoung';
    // #pw: EC2에 설치된 mysql의 사용자의 암호를 입력한다
    // $pw = '00000000';
    // #dbName : EC2에 설치된 mysql에서 사용할 DB이름을 입력한다
    // $dbName = 'web';
    //
    // $conn = new mysqli($host, $user, $pw, $dbName);
    //
    // if($conn){
    //     echo "MySQL Success<br>";
    // }else{
    //     echo "MySQL Fail<br>";
    // }
	session_start();
	header('Content-Type: text/html; charset=utf-8'); // utf-8인코딩

	$db = new mysqli('ayoung.ch6vqaurrmle.eu-west-2.rds.amazonaws.com','ayoung','00000000','web');
	$db->set_charset("utf8");

	function mq($sql)
	{
		global $db;
		return $db->query($sql);
	}

?>
