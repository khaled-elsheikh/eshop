<?php session_start();
$con = mysql_connect("localhost:3306","root","");
                        if (!$con)
                          {
                          die('Could not connect: ' . mysql_error());
                          }
                         
                        mysql_select_db("eshop", $con);

$res=mysql_query("INSERT INTO cart (product_id , quantity , user ) VALUES ('$_SESSION[product]','1','$_SESSION[user]')",$con);
?>