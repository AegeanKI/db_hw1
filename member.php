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
?>
      <div id="member">
        <h3>Member Info</h3>
        
        <table>
          <tr>
            <th>account</th>
            <td><?php echo "$table[0]"; ?></td>
          </tr>
          <tr>
            <th>name</th>
            <td><?php echo "$table[3]"; ?></td>
          </tr>
          <tr>
            <th>email</th>
            <td><?php echo "$table[4]"; ?></td>
          </tr>
        </table>

        <p>
          <input type="button" onclick="location.href='logout.php'" value="logout"></input>
        </p>
      </div>
<?php
    }
    else{
?>
      <div class="transport">
        <p class="alert">this account is admin, you DON'T belong here</p>
        <meta http-equiv=REFRESH CONTENT=2;url=admin.php>
      </div>
<?php
    }
  }
  else{
?>
    <div class="transport">
      <p class="alert">please login</p>
      <meta http-equiv=REFRESH CONTENT=2;url=index.php>
    </div>
<?php
  }
?>
<link rel="stylesheet" href="all.css">
