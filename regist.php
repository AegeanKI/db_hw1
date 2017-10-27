<?php session_start(); ?>

<html>
<head>
  <link rel="stylesheet" href="all.css">
  <meta http-equiv="Content-Type" content="text/html charset=utf-8" />
</head>

<body>
  <div id="regist">
  <form name="regist" method="post" action="can_regist.php">
        <h3>Regist</h3> 
        <p>please registrate</p>
      <table class="noshadow"><tbody>
        <tr>
          <td>account</td>
          <td><input name="account" type="text"></td>
        </tr>
        <tr>
          <td>password</td>
          <td><input name="password" type="password"></td>
        </tr>
        <tr>
          <td>name</td>
          <td><input name="name" type="text"></td>
        </tr>
        <tr>
          <td>email</td>
          <td><input name="email" type="text"><td>
        </tr>
        </tbody></table> 
    <p>
      <input name="button_to_regist" type="submit" value="regist">
      <input type="button" onclick="location.href='index.php'" value="canecel"></input>
    </p>
  </form>
  </div>
</body>
</html>

<?php
  /*include("connect_database.php");

  $account=$_POST['account'];
  $password=$_POST['password'];
  $name=$_POST['name'];
  $email=$_POST['email']; 

  if($_SESSION['account'] != null){
    $is_admin=$_POST['is_admin'];
  }
  else{
    $is_admin=0;
  }
  
  $sql_find_account="SELECT account FROM people WHERE account='$account'";
  $find_rs=$db->query($sql_find_account);
  $table=$find_rs->fetch();

  $needto_reinput = 0;

  //if($account == null || $table[0] != null || strpos(trim("$account"), ' ') !== false){
  if($account == null || $table[0] != null || preg_match('/\s/', $account)){
    ?><p><?php echo 'account is not correct or been used'; ?><p><?php
    $needto_reinput=1;
  }
  if($account == null){
    ?><p><?php echo 'account can not be null'; ?><p><?php
    $needto_reinput=1;
  }
  if($table[0] != null){
    ?><p><?php echo 'account is already been used'; ?><p><?php
    $needto_reinput=1;
  }
  if(preg_match('/\s/', $account)){
    ?><p><?php echo 'account can not use whitespace'; ?><p><?php
    $needto_reinput=1;
  }
  if($password == null){
    ?><p><?php echo 'password can not be null'; ?><p><?php
    $needto_reinput=1;
  }
  if($name == null){
    ?><p><?php echo 'name can not be null'; ?><p><?php
    $needto_reinput=1;
  }
if($email == null || !filter_var($email, FILTER_VALIDATE_EMAIL)){
    ?><p><?php echo 'email is invalid'; ?><p><?php
    $needto_reinput=1;
  }
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    ?><p><?php echo 'email is invalid'; ?><p><?php
    $needto_reinput=1;
  }
  if($needto_reinput == 1){
    ?><p><?php echo 'regist failed'; ?><p><?php
    ?><p><?php echo 'try to regist again'; ?></p><?php	  
    if($_SESSION['account'] != null){
      echo '<meta http-equiv=REFRESH CONTENT=2;url=admin.php>';
    }
    else{  
      $_SESSION['regist_failed']=1;
      echo '<meta http-equiv=REFRESH CONTENT=2;url=regist.php>';
    }
  }	  
  else{
	  $hash_password=hash('sha256',$password);
    $sql_to_adduser="INSERT INTO people (account, password, is_admin, name, email) VALUES ('$account', '$hash_password', $is_admin, '$name', '$email')";
    $db->query($sql_to_adduser);
    ?><p><?php echo 'regist successed'; ?><p><?php
    if($_SESSION['account'] != null){
      echo '<meta http-equiv=REFRESH CONTENT=1;url=admin.php>';
    }
    else{
      ?><p><?php echo 'try to login!'; ?><p><?php
      echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
    }
  }*/
?>


