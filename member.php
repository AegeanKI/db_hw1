<?php session_start(); ?>

<?php
  include("connect_database.php");
  
  $my_account = $_SESSION['account'];

  if($my_account != null){
    if($_SESSION['is_admin'] != 1){
      $sql_find_account = "SELECT * FROM people WHERE account='$my_account'";
      //$people_rs = $db->query($sql_find_account);
      $people_rs = $db->prepare($sql_find_account);
      $people_rs->execute();
      $table = $people_rs->fetch();
      echo "my account = $table[0]<br>";
      echo "my name = $table[3]<br>";
      echo "my email = $table[4]<br>";

      ?>
        <input type="button" onclick="location.href='logout.php'" value="logout"></input><br>
      <?php
    }
    else{
      echo "this account is admin, here is not belong to you<br>";
      echo '<meta http-equiv=REFRESH CONTENT=2;url=admin.php>';
    }
  }
  else{
    echo 'please login<br>';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
  }
?>
<link rel="stylesheet" href="all.css">
