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
?>
    <div class="transport">
      <p class="notice"><?php echo "$who"; ?> login successed</p>
      <meta http-equiv=REFRESH CONTENT=1;url=<?php echo "$who" ?>.php>
    </div>
<?php
  }
  else{
?>
    <div class="transport">
      <p class="alert">login failed</p>
      <meta http-equiv=REFRESH CONTENT=2;url=index.php>
    </div>
<?php
  }
?>
<link rel="stylesheet" href="all.css">
