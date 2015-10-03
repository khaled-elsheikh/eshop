<?php
session_start();
?>
<html>
	<head></head>
	<body>
		<?php
			$con = mysql_connect("localhost:3306","root","");
            if (!$con)
            {
            die('Could not connect: ' . mysql_error());
            }
            mysql_select_db("eshop", $con);
            $res=mysql_query("SELECT firstname as fname , lastname as lname , Mobilenumber as mn , username as uname , image as avatar  from users WHERE username LIKE '$_SESSION[user]'",$con);
            if($res === FALSE) { 
              die(mysql_error()); // TODO: better error handling
            }
            while($data = mysql_fetch_assoc($res)){
            echo "<h2>$data[uname]</h2>";

            echo "<form action=\"#\" method=\"POST\">
		        firstname: <h1>$data[fname]</h1>
		        change firstname: <input type=\"text\" name=\"fn\"><br>
		        <input name=\"changefn\" type=\"submit\" value=\"change\">";
		        if(isset($_POST[changefn])){
		        $fnamechange = mysql_query("UPDATE users SET firstname = '$_POST[fn]' WHERE username LIKE '$_SESSION[user]'",$con);
		        header('Location: user.php');    
		   		}
		   echo "
		      </form>";

		    echo "<form action=\"#\" method=\"POST\">
		        lastname: <h1>$data[lname]</h1>
		        change lastname: <input type=\"text\" name=\"ln\"><br>
		        <input name=\"changeln\" type=\"submit\" value=\"change\">";
		        if(isset($_POST[changeln])){
		        $lnamechange = mysql_query("UPDATE users SET lastname = '$_POST[ln]' WHERE username LIKE '$_SESSION[user]'",$con);
		        header('Location: user.php'); 
		   		}
		   echo "
		      </form>";


		    echo "<form action=\"#\" method=\"POST\">
		        mobilenumber: <h1>$data[mn]</h1>
		        change mobilenumber: <input type=\"text\" name=\"mnc\"><br>
		        <input name=\"changemn\" type=\"submit\" value=\"change\">";
		        if(isset($_POST[changemn])){
		        $fnamechange = mysql_query("UPDATE users SET Mobilenumber = '$_POST[mnc]' WHERE username LIKE '$_SESSION[user]'",$con);
		        header('Location: user.php'); 
		   		}
		   echo "
		      </form>";

		      echo "<form action=\"#\" method=\"POST\">
		        avatar: <img src=\"$data[avatar]\" alt=\"\">
		        change avatar: <input type=\"text\" name=\"avtr\"><br>
		        <input name=\"changeavtr\" type=\"submit\" value=\"change\">";
		        if(isset($_POST[changeavtr])){
		        $fnamechange = mysql_query("UPDATE users SET image = '$_POST[avtr]' WHERE username LIKE '$_SESSION[user]'",$con);
		        header('Location: user.php'); 
		   		}
		   echo "
		      </form>";



		      echo "<form action=\"#\" method=\"POST\">
		        password: <h1>$data[pw]</h1>
		        change password: <input type=\"text\" name=\"pwc\"><br>
		        <input name=\"changepw\" type=\"submit\" value=\"change\">";
		        if(isset($_POST[changepw])){
		        $fnamechange = mysql_query("UPDATE users SET password = '$_POST[pwc]' WHERE username LIKE '$_SESSION[user]'",$con);
		        header('Location: user.php'); 
		   		}
		   echo "
		      </form>";
        }
		?>

		
	</body>
</html>