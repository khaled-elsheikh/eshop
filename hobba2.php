<?php
        $con = mysql_connect("localhost:3306","root","");
        if (!$con)
          {
          die('Could not connect: ' . mysql_error());
          }
         
        mysql_select_db("eshop", $con);
         
        $sql="INSERT INTO users (username, password , firstname , lastname , Mobilenumber )
        VALUES
        ('$_POST[uname]','$_POST[pw]','$_POST[fname]','$_POST[lname]','$_POST[mn]')";
         
        if (!mysql_query($sql,$con))
          {
          die('Error: ' . mysql_error());
          }
        header('Location: index.php');    
        mysql_close($con);
        ?>