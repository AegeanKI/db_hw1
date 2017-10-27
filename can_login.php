<?php session_start(); ?>

<?php
  include("connect_database.php");
  $account=$_POST['account'];
  $password=$_POST['password'];
  $hash_password=hash('sha256', $password);
  $sql_find_account = "SELECT * FROM people WHERE account='$account'";
  //$people_rs = $db->query($sql_find_account);
  $people_rs = $db->prepare($sql_find_account);
  $people_rs->execute();
  $table = $people_rs->fetch();
  
  if($account != null && $password != null && $table[0] == $account && $table[1] == $hash_password){
    $_SESSION['account'] = $account;
    $_SESSION['is_admin'] = $table[2];
    if($table[2] == 0){
      $who = "member";
    }
    else{
      $who = "admin";
    }
    echo "$who login successed";
    echo "<meta http-equiv=REFRESH CONTENT=1;url='$who'.php>";
  }
  else{
    echo "login failed";
    echo "<meta http-equiv=REFRESH CONTENT=2;url=index.php>";
  }
?>

<link rel="stylesheet" href="all.css">
