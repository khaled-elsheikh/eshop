<?php
session_start();
?>

<html>
	<head></head>
	<body>
		<h2>Cart</h2>
		<?php
		$con = mysql_connect("localhost:3306","root","");
            if (!$con)
            {
            die('Could not connect: ' . mysql_error());
            }
            mysql_select_db("eshop", $con);
            $res=mysql_query("SELECT c.quantity as quant , o.product_id as product , o.name as pname , o.price as price  from objects o inner join cart c on c.product_id = o.product_id AND c.user = '$_SESSION[user]' AND c.isbought = '0' ",$con);
            
            if($res === FALSE) { 
              die(mysql_error()); // TODO: better error handling
            }
            $total = 0;
            while($data = mysql_fetch_assoc($res)){
            	$total = $total + ($data['price'] * $data['quant']);
                $pr = $data['price'] * $data['quant'];
            	


                echo "
                        
                            
                            
                            <form action=\"#\" method=\"POST\">
                                <h4><a href=\"#\"> $data[pname]</a></h4>
                                 <center>$pr</center>";
                                 
                                echo "
                                <input type=\"text\" name=\"q\" value=\"$data[quant]\"><br>
                                <input name=\"qn\" id=\"qn\" type=\"hidden\" value=$data[quant]>
                                <input name=\"pid\" id=\"pid\" type=\"hidden\" value=$data[product]>
                                <input name=\"changeq\" type=\"submit\" value=\"change quantity\">
                               <input name=\"removeObject\" type=\"submit\" value=\"remove from cart\">";

                                if(isset($_POST['Button'])){
                                if(isset($_SESSION['user'])){
                                  
                                }else{
                                    header('Location: Login.php');
                                }
                                }
                            
                                echo "
                            </form>";





            }
            if(isset($_POST['changeq'])){
                if(isset($_SESSION['user'])){
                    $qq = "UPDATE cart SET quantity = $_POST[q] WHERE product_id = $_POST[pid] AND isbought = '0'";
                   
                    $qchange = mysql_query($qq, $con);
                    header('Location: cart.php');

                }else{
                     header('Location: Login.php');
                }
            }

            if(isset($_POST['removeObject'])){
                if(isset($_SESSION['user'])){
                    $removeOb = mysql_query("DELETE FROM cart WHERE product_id = $_POST[pid] AND isbought = '0'" , $con);
                    header('Location: cart.php');
                }else{
                     header('Location: Login.php');
                }
            }


            echo "---------------------------------------------------------------------------------------------------<br>";
            echo "total";
            echo "<center>$total</center>";
            echo "<form action=\"#\" method=\"POST\">
		        <input name=\"checkout\" type=\"submit\" value=\"checkout\">";
		        if(isset($_POST['checkout'])){
		        
		        $res=mysql_query("SELECT o.quantity as quantity , c.quantity as qn , o.product_id as product_i from objects o inner join cart c on c.product_id = o.product_id AND c.user = '$_SESSION[user]' AND c.isbought = '0' ",$con);
            	$checkout = mysql_query("UPDATE cart SET isbought = '1' WHERE user LIKE '$_SESSION[user]'",$con);
                if($res === FALSE) { 
              		die(mysql_error()); // TODO: better error handling
            	}


            	while($data2 = mysql_fetch_assoc($res)){
                    echo "-------->>" + $data2['qn'];
                    if($data2['qn'] >  $data2['quantity']){
                        echo "<script>window.alert(\"the maximum quantity in the stock is \" + $data2[quantity])</script>";
                        
                    }else{
            		$quantity = $data2['quantity'] - $data2['qn'];
                    
		        	$checkout2 = mysql_query("UPDATE objects SET quantity = $quantity WHERE product_id = $data2[product_i] ",$con);
                    echo $checkout2;
                     $checkout = mysql_query("UPDATE cart SET isbought = '1' WHERE user LIKE '$_SESSION[user]'",$con);
                      echo "<script>window.alert(\"your purchase is successful\")</script>";
		    	}}	
		        if($checkout === FALSE) { 
             		 die(mysql_error()); // TODO: better error handling
            	}
               
               
                echo "</form>";
                
		    }
            echo "<form action=\"#\" method=\"POST\">
                <input name=\"back\" type=\"submit\" value=\"back\">
                </form>";

                if(isset($_POST['back'])){
                    header('Location: index.php');
                }
                
		?>
	</body>
</html>