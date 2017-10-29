<?php session_start(); ?>

<?php
  include("connect_database.php");
  if(isset($_SESSION['login_account'])){
    unset($_SESSION['login_account']);
  }
  if(isset($_SESSION['login_account'])){
    unset($_SESSION['login_account']);
  }
  if(isset($_SESSION['login_account'])){
    unset($_SESSION['login_account']);
  }


  if(isset($_SESSION['account'])){//check is_admin
    if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] != 1){
?>     
      <div class="transport">      
        <p class="alert">Permission denied, only administrator can use this page</p>
        <meta http-equiv=REFRESH CONTENT=2;url=member.php>
      </div>
<?php
    }
    else{
/*******************regist*part*start*************************************************/
      if(isset($_POST['account'])){//regist part start
        $account=$_POST['account'];//for sql
        $password=$_POST['password'];
        $name=$_POST['name'];
        $email=$_POST['email'];
        $is_admin=$_POST['is_admin'];
        $_SESSION['regist_account']=$_POST['account'];//for reinput's value
        $_SESSION['regist_is_admin']=$_POST['is_admin'];
        $_SESSION['regist_name']=$_POST['name'];
        $_SESSION['regist_email']=$_POST['email']; 

        $needto_reinput = 0;
      
        $sql_find_account="SELECT account FROM people WHERE account='$account'";
        $find_rs=$db->prepare($sql_find_account);
        $find_rs->execute();
        $num=$find_rs->rowCount();
        $table=$find_rs->fetch();
      
        ?><div class="transport"><?php
          if($account == null){
            ?><p class="alert">account can not be null</p><?php
            $needto_reinput=1;
          }
          if($num != 0){
            ?><p class="alert">account is already been used</p><?php
            $needto_reinput=1;
          }
          if(preg_match('/\s/', $account)){//if $account have " "
            ?><p class="alert">account can not use whitespace</p><?php
            $needto_reinput=1;
          }
          if($password == null){
            ?><p class="alert">password can not be null</p><?php
            $needto_reinput=1;
          }
          if($is_admin == null){
            ?><p class="alert">is_admin can not be null</p><?php
            $needto_reinput=1;
          }
          else{
            if($is_admin != '1' && $is_admin != '0'){
              ?><p class="alert">is_admin must be 0 or 1</p><?php
              $needto_reinput=1;
            }
          }
          if($name == null){
            ?><p class="alert">name can not be null</p><?php
            $needto_reinput=1;
          }
          if(!filter_var($email, FILTER_VALIDATE_EMAIL)){//check email
            ?><p class="alert">email is invalid</p><?php
            $needto_reinput=1;
          }
          if($needto_reinput == 1){
            ?><p class="alert">Regist failed :(</p>
            <meta http-equiv=REFRESH CONTENT=2;url=admin.php><?php
          }	  
          else{
            $hash_password=hash('sha256',$password);
            $sql_to_adduser="INSERT INTO people (account, password, is_admin, name, email) VALUES ('$account', '$hash_password', $is_admin, '$name', '$email')";
            //$db->query($sql_to_adduser);
            $rs=$db->prepare($sql_to_adduser);
            $rs->execute();
            unset($_SESSION['regist_is_admin']);
            unset($_SESSION['regist_account']);
            unset($_SESSION['regist_name']);
            unset($_SESSION['regist_email']);       
            ?><p class="notice">Regist success!<p>
            <meta http-equiv=REFRESH CONTENT=2;url=admin.php><?php
          }
        ?></div><?php
      }
/*******************regist*part*end***************************************************/

/*******************delete*part*start*************************************************/
      if(isset($_POST['delete_account'])){//delete part start
        $_SESSION['delete_account']=$_POST['delete_account'];
        if($_POST['delete_account'] != $_SESSION['account']){
          $account=$_POST['delete_account'];
          unset($_SESSION['delete_account']); 
          $sql="DELETE FROM people WHERE account='$account'";
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
/*******************delete*part*end***************************************************/

/*******************upgrade*part*start************************************************/

      if(isset($_POST['upgrade_account'])){
        $account=$_POST['upgrade_account'];
        $sql_find_account="UPDATE people SET is_admin=1 WHERE account='$account'";
        $rs=$db->prepare($sql_find_account);
        $rs->execute();
?>
        <div class="transport">
          <p class="notice">already upgrade</p>
          <meta http-equiv=REFRESH CONTENT=1;url=admin.php>
        </div>
<?php  
      }
/*******************upgrade*part*end**************************************************/

      $my_account = $_SESSION['account'];//for sql;
      $sql_find_account = "SELECT * FROM people WHERE account='$my_account'";
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
        
        <form name="update_or_build" method="post" action="admin.php">        
        <table class="noshadow">
          <tbody>
            <tr>
              <td>account</td>
              <td><input name="account" type="text" value="<?php if(isset($_SESSION['regist_account'])){echo $_SESSION['regist_account'];} ?>"></td>
            </tr>
            <tr>
              <td>password</td>
              <td><input name="password" type="password"></td>
            </tr>
            <tr>
              <td>is_admin</td>
              <td><input name="is_admin" type="text" value="<?php if(isset($_SESSION['regist_is_admin'])){echo $_SESSION['regist_is_admin'];} ?>"></td>
            </tr>
            <tr>
              <td>name</td>
              <td><input name="name" type="text" value="<?php if(isset($_SESSION['regist_name'])){echo $_SESSION['regist_name'];} ?>"></td>
            </tr>
            <tr>
              <td>email</td>
              <td><input name="email" type="text" value="<?php if(isset($_SESSION['regist_email'])){echo $_SESSION['regist_email'];} ?>"></td>
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
        <form name="delete_user" method="post" action="admin.php">
          <p>account:
            <input name="delete_account" type="text">
          </p>
      
          <p>
            <input name="button_to_submit" type="submit" value="delete">
          </p>
        </form>
      </div>
      
      <div id="upgrade">
        <h3>Upgrade</h3>
        <p>let user be an  administrator</p>
        <form name="upgrade_user" method="post" action="admin.php">
          <p>account:
            <input name="upgrade_account" type="text">
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
