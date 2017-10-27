<?php session_start(); ?>

<?php
  include("connect_database.php");

  if($_SESSION['account'] != null ){
    if($_SESSION['is_admin'] != 1){    
      echo "permission denied, only administrator can delete account<br>";
      echo '<meta http-equiv=REFRESH CONTENT=2;url=member.php>';
    }
    else if($_POST['account'] != $_SESSION['account']){
      $account=$_POST['account'];
  
      $sql="DELETE FROM people WHERE account='$account'";
      //$db->query($sql);
      $rs=$db->prepare($sql);
      $rs->execute();
      echo 'already delete<br>';
      echo '<meta http-equiv=REFRESH CONTENT=1;url=admin.php>';
    }
    else{
      echo "can't delete this account by itself<br>";
      echo '<meta http-equiv=REFRESH CONTENT=1;url=admin.php>';
    }
  }
  else{
    echo 'please login <br>';
    echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
  }
?>
<link rel="stylesheet" href="all.css">
