<?php
session_start();
?>

<html>
	<head></head>
	<body>
		<h2>History</h2>
		<?php
		$con = mysql_connect("localhost:3306","root","");
            if (!$con)
            {
            die('Could not connect: ' . mysql_error());
            }
            mysql_select_db("eshop", $con);
            $res=mysql_query("SELECT c.quantity as quan ,  name as pname , price as price from objects o inner join cart c on c.product_id = o.product_id AND c.user = '$_SESSION[user]' AND c.isbought = '1' ",$con);
            if($res === FALSE) { 
              die(mysql_error()); // TODO: better error handling
            }
            while($data = mysql_fetch_assoc($res)){
            	echo $data['pname'];
            	echo "<center>$data[price]</center>";
                  echo "quantity : $data[quan] <br><br>";
                  
            }
            echo "<form action=\"#\" method=\"POST\">
		        <input name=\"back\" type=\"submit\" value=\"back\">";
		        if(isset($_POST['back'])){
		          header('Location: index.php');
		    }
		?>
	</body>
</html>