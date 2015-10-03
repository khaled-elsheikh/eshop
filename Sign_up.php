<?php session_start();?>
<html>
  <head>
    <title>Sign up</title>
  </head>
  <body>
    <center>
      <h2>Sign up</h2>
      <form action="#" method="POST">
        First name: <input type="text" name="fname"><br>
        Last name: <input type="text" name="lname"><br>
        Username: <input type="text" name="uname"><br>
        Password: <input type="text" name="pw"><br>
        Mobile number: <input type="text" name="mn"><br>
        Avatar :<input type="text" name="avatar"><br>
        <input name = "submit" type="submit" value="Submit">
        <?php
        $con = mysql_connect("localhost:3306","root","");
        if (!$con)
          {
          die('Could not connect: ' . mysql_error());
          }
         
        mysql_select_db("eshop", $con);
         if(isset($_POST['submit'])){
        $sql="INSERT INTO users (username, password , firstname , lastname , Mobilenumber , image )
        VALUES
        ('$_POST[uname]','$_POST[pw]','$_POST[fname]','$_POST[lname]','$_POST[mn]' , '$_POST[avatar]')";
         
        if (!mysql_query($sql,$con))
          {
          die('Error: ' . mysql_error());
          }
         $_SESSION['user'] = $_POST[uname];
         echo "1 record found";
         header('Location: index.php');
         }     
        mysql_close($con);
        ?>
      </form>
    </center>
  </body>

</html>