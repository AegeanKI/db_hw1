<?php session_start(); ?>

<?php
  include("connect_database.php");
  
  $my_account = $_SESSION['account'];

  if($my_account != null){
    if($_SESSION['is_admin'] != 1){
?>     
      <div class="transport">      
        <p class="alert">Permission denied, only administrator can use this page</p>
        <meta http-equiv=REFRESH CONTENT=2;url=member.php>
      </div>
<?php
    }
    else{
      $sql_find_account = "SELECT * FROM people WHERE account='$my_account'";
      //$this_rs = $db->query($sql_find_account);
      $this_rs = $db->prepare($sql_find_account);
      $this_rs->execute();
      $table = $this_rs->fetch();
?>
      <div id="welcome"><h1>Welcome to the Adim page!</h1></div>
      <div id="personinfo">
        <p>Hello, <?php echo "$table[0]"; ?> ! </p>
        
        <table>
          <tbody>
            <tr>
              <th colspan="2">info</th>
            </tr>
            <tr>
              <td>name</td>
              <td><?php echo "$table[3]"; ?></td>
            </tr>
            <tr>
              <td>email</td>
              <td><?php echo "$table[4]"; ?></td>
            </tr>
          </tbody>
        </table>
        
        <p>
          <input type="button" onclick="location.href='logout.php'" value="logout"></input>
        </p>
      </div>
<?php
      $sql_find_all = "SELECT * FROM people";
      //$people_rs = $db->query($sql_find_all);
      $people_rs = $db->prepare($sql_find_all);
      $people_rs->execute();
?>
      <div id="table">
        <table>
          <h3>All users</h3>
          <tr>
            <th>user</th>
            <th>name</th>
            <th>email</th>
            <th>admin</th>
          </tr>
<?php 
      while($table = $people_rs->fetchObject()){ 
?>
          <tr>
	          <td><?php echo $table->account; ?></td>
            <td><?php echo $table->name; ?></td>
            <td><?php echo $table->email; ?></td>
	          <td class="adminis<?php echo $table->is_admin; ?>" > <?php if ($table->is_admin == 1) echo 'O' ?></td>
          </tr>  
<?php
      }
?>
        </table>
      </div>

      <div id="create">
        <h3>Update</h3> 
        <p>update or create user or administrator</p>
        
        <form name="update_or_build" method="post" action="can_regist.php">        
        <table class="noshadow">
          <tbody>
            <tr>
              <td>account</td>
              <td><input name="account" type="text"></td>
            </tr>
            <tr>
              <td>password</td>
              <td><input name="password" type="password"></td>
            </tr>
            <tr>
              <td>is_admin</td>
              <td><input name="is_admin" type="text"></td>
            </tr>
            <tr>
              <td>name</td>
              <td><input name="name" type="text"></td>
            </tr>
            <tr>
              <td>email</td>
              <td><input name="email" type="text"></td>
            </tr>
          </tbody>
        </table>
        
        <p>
          <input name="button_to_submit" type="submit" value="create">
        </p>
        </form>
      </div>
      <div id="delete">
        <h3>Delete</h3>
        <p>delete user or administrator</p>
        <form name="delete_user" method="post" action="delete.php">
          <p>account:
            <input name="account" type="text">
          </p>
      
          <p>
            <input name="button_to_submit" type="submit" value="delete">
          </p>
        </form>
      </div>
      
      <div id="upgrade">
        <h3>Upgrade</h3>
        <p>let user be an  administrator</p>
        <form name="upgrade_user" method="post" action="upgrade.php">
          <p>account:
            <input name="account" type="text">
          </p>
      
          <p>
            <input name="button_to_submit" type="submit" value="upgrade">
          </p>
        </form>
      </div>
<?php
    }
  }
  else{
?>
    <div class="transport">
      <p class="alert">Please login!</p>
      <meta http-equiv=REFRESH CONTENT=2;url=index.php>
    </div>
<?php
  }
?>
<link rel="stylesheet" href="all.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
