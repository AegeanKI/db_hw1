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
      echo "<div id=\"member\"><h3>Member Info</h3><table><tr><th>account</th><td>$table[0]";
      echo "</td></tr><tr><th>name</th><td>$table[3]</td></tr>";
      echo "<tr><th>email</th><td>$table[4]</td></tr></table>";

      ?>
        <p><input type="button" onclick="location.href='logout.php'" value="logout"></input></p></div>
      <?php
    }
    else{
      echo "this account is admin, you DON'T belong here<br>";
      echo '<meta http-equiv=REFRESH CONTENT=2;url=admin.php>';
    }
  }
  else{
    echo 'please login<br>';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
  }
?>
<link rel="stylesheet" href="all.css">
