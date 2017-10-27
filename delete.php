<?php session_start(); ?>

<?php
  include("connect_database.php");

  if($_SESSION['account'] != null ){
    if($_SESSION['is_admin'] != 1){    
?>
      <div class="transport">
        <p class="alert">permission denied, only administrator can delete account</p>
        <meta http-equiv=REFRESH CONTENT=2;url=member.php>
      </div>
<?php
    }
    else if($_POST['account'] != $_SESSION['account']){
      $account=$_POST['account'];
  
      $sql="DELETE FROM people WHERE account='$account'";
      //$db->query($sql);
      $rs=$db->prepare($sql);
      $rs->execute();
?>
      <div class="transport">
        <p class="notice">already delete</p>
        <meta http-equiv=REFRESH CONTENT=1;url=admin.php>
      </div>
<?php
    }
    else{
?>
      <div class="transport">
        <p class="alert">can't delete this account by itself</p>
        <meta http-equiv=REFRESH CONTENT=1;url=admin.php>
      </div>
<?php
    }
  }
  else{
?>
    <div class="transport">
      <p class="alert">please login </p>
      <meta http-equiv=REFRESH CONTENT=1;url=index.php>
    </div>
<?php
  }
?>
<link rel="stylesheet" href="all.css">
