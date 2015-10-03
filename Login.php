<?php session_start();
?>

<html>
  <head>
    <title>Log in</title>
  </head>
  <body>
    <center>
      <h2>Log in</h2>
      <form action="#" method="POST">
        Username: <input type="text" name="uname"><br>
        Password: <input type="text" name="pw"><br>
        <input name = "submit" type="submit" value="Submit">
        <?php
        $con = mysql_connect("localhost:3306","root","");
        if (!$con)
          {
          die('Could not connect: ' . mysql_error());
          }
         
        mysql_select_db("eshop", $con);
        if(isset($_POST['submit'])){
        $result=mysql_query("SELECT COUNT(*) as total FROM users WHERE username LIKE '$_POST[uname]' AND password LIKE '$_POST[pw]'", $con);
        if (!$result)
          {
          die('Error: ' . mysql_error());
          }else{
            $data=mysql_fetch_assoc($result);
            if( $data['total'] == 1){
                 $_SESSION['user'] = $_POST[uname];
                 echo "1 record found";
                 header('Location: index.php');    
                

              }
          }
        }
        
         
        mysql_close($con)
        ?>
        
      </form>
    </center>
  </body>

</html>