<?php session_start(); ?>

<?php
  include("connect_database.php");
  
  $my_account = $_SESSION['account'];

  if($my_account != null){
    if($_SESSION['is_admin'] != 1){
      echo "permission denied, only administrator can use this page<br>";
      echo '<meta http-equiv=REFRESH CONTENT=2;url=member.php>';
    }
    else{
      $sql_find_account = "SELECT * FROM people WHERE account='$my_account'";
      //$this_rs = $db->query($sql_find_account);
      $this_rs = $db->prepare($sql_find_account);
      $this_rs->execute();
      $table = $this_rs->fetch();
      echo "my account = $table[0]<br>";
      echo "my name = $table[3]<br>";
      echo "my email = $table[4]<br>";

      $sql_find_all = "SELECT * FROM people";
      //$people_rs = $db->query($sql_find_all);
      $people_rs = $db->prepare($sql_find_all);
      $people_rs->execute();
      echo '<br>all user:<br><table>';
      while($table = $people_rs->fetchObject()){
        ?>
          <tr>
	    <td><?php echo $table->account; ?></td>
            <td><?php echo $table->name; ?></td>
            <td><?php echo $table->email; ?></td>
	    <td><?php echo $table->is_admin; ?></td>
          </tr>  
        <?php
      }
      echo '</table><br>';

      echo 'update or create user or administrator:<br>';
      ?>
      <form name="update_or_build" method="post" action="can_regist.php">
        <p>account:
          <input name="account" type="text">
        </p>

        <p>password:
          <input name="password" type="password">
        </p>

        <p>is_admin:
          <input name="is_admin" type="text">
        </p>

        <p>name:
          <input name="name" type="text">
        </p>

        <p>email:
          <input name="email" type="text">
        </p>

        <p>
          <input name="button_to_submit" type="submit" value="create">
        </p>
      </form><?php

      echo 'delete user or administrator:<br>';
      ?>
      <form name="delete_user" method="post" action="delete.php">
        <p>account:
          <input name="account" type="text">
        </p>
      
        <p>
          <input name="button_to_submit" type="submit" value="delete">
        </p>
      </form><?php

      echo 'let user be an  administrator:<br>';
      ?>
      <form name="upgrade_user" method="post" action="upgrade.php">
        <p>account:
          <input name="account" type="text">
        </p>
      
        <p>
          <input name="button_to_submit" type="submit" value="upgrade">
        </p>
      </form><?php
    
      ?>
        <input type="button" onclick="location.href='logout.php'" value="logout"></input><br>
      <?php
    }
  }
  else{
    echo 'please login<br>';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
  }
?>
