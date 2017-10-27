<?php session_start(); ?>

<?php
  include("connect_database.php");

  $account=$_POST['account'];
  $password=$_POST['password'];
  $name=$_POST['name'];
  $email=$_POST['email']; 

  $needto_reinput = 0;
  
  
  
  $sql_find_account="SELECT account FROM people WHERE account='$account'";
  //$find_rs=$db->query($sql_find_account);
  $find_rs=$db->prepare($sql_find_account);
  $find_rs->execute();
  $table=$find_rs->fetch();
?>
  <div class="transport">
<?php
    if($account == null){
?>
      <p class="alert">account can not be null</p>
<?php
      $needto_reinput=1;
    }
    if($table[0] != null){
?>
      <p class="alert">account is already been used</p>
<?php
      $needto_reinput=1;
    }
    if(preg_match('/\s/', $account)){//if $account have " "
?>
      <p class="alert">account can not use whitespace</p>
<?php
      $needto_reinput=1;
    }
    if($password == null){
?>
      <p class="alert">password can not be null</p>
<?php
      $needto_reinput=1;
    }
    if($_SESSION['is_admin'] == 1){
      $is_admin=$_POST['is_admin'];
      if($is_admin != '1' && $is_admin != '0'){      
?>
        <p class="alert">is_admin must be 0 or 1</p>
<?php
         $needto_reinput = 1;
      }
    }
    else{
      $is_admin=0;
    }
    if($name == null){
?>
      <p class="alert">name can not be null</p>
<?php
      $needto_reinput=1;
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){//check email
?>
      <p class="alert">email is invalid</p>
<?php
      $needto_reinput=1;
    }
    if($needto_reinput == 1){
?>
      <p class="alert">Regist failed :(</p>
      <p class="notice">Try to regist again</p>
<?php	  
      if($_SESSION['account'] != null){
?>  
         <meta http-equiv=REFRESH CONTENT=2;url=admin.php>
<?php    
      }
      else{  
        $_SESSION['regist_failed']=1;
?>
        <meta http-equiv=REFRESH CONTENT=2;url=regist.php>
<?php
    }
  
    }	  
    else{
	    $hash_password=hash('sha256',$password);
      $sql_to_adduser="INSERT INTO people (account, password, is_admin, name, email) VALUES ('$account', '$hash_password', $is_admin, '$name', '$email')";
      //$db->query($sql_to_adduser);
      $rs=$db->prepare($sql_to_adduser);
      $rs->execute();
?>
      <p class="notice">Regist success!<p>
<?php
      if($_SESSION['is_admin'] == 1){
?>
        <meta http-equiv=REFRESH CONTENT=1;url=admin.php>
<?php
      }
      else{
?>
        <p class="notice">Try to login!<p>
        <meta http-equiv=REFRESH CONTENT=2;url=index.php>
<?php
      }
?>
  </div>
<?php
  }
?>
<link rel="stylesheet" href="all.css">
