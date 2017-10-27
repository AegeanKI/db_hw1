<?php session_start(); ?>

<?php
  $_SESSION['account']=null;
  $_SESSION['is_admin']=20;
?> 
<html>
<head>
  <link rel="stylesheet" href="all.css" >
  <title>need_to_login</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body>
<div>
  <h1>Welcome to HW1</h1>
</div>
<div id="index" >  
  <h1>Login</h1>
  <form name="login" method="post" action="can_login.php">
    <table id="login" class="noshadow">
    <tr>
      <td>account</td>
      <td><input name="account" type="text"></td>
    </tr>
    <tr>
      <td>password</td>
      <td><input name="password" id = "password" type="password"></td>
    </tr>
    </table>
    <p>
      <input name="button_to_submit" type="submit" value="login">&nbsp;&nbsp;
    <input type="button" onclick="location.href='regist.php'" value="regist"></input>
    </p>
</div>
   </form>
</body>
</html>
