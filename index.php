<?php session_start(); ?>

<?php
  $_SESSION['account']=null;
?> 
<html>
<head>
  <link rel="stylesheet" href="all.css" >
  <title>need_to_login</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body>
  <form name="login" method="post" action="can_login.php">
    <p>account:
      <input name="account" type="text">
    </p>

    <p>password:
      <input name="password" id = "password" type="password">
    </p>

    <p>
      <input name="button_to_submit" type="submit" value="login">&nbsp;&nbsp;
    <input type="button" onclick="location.href='regist.php'" value="regist"></input>
    </p>

    
    <!--p align="center">account:
      <input name="account" type="text">
    </p>
    <br>    

    <p align="center">password:
      <input name="password" id = "password" type="password">
    </p>
    <br>

    <p align="center">
      <input name="button_submit" type="submit" value="login">&nbsp;&nbsp;
      <a href="regist.php">regist new user</a>
    </p>
    <br-->
  </form>
</body>
</html>
