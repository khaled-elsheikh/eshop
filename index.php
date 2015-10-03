<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>eshop</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/shop-homepage.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">eshop</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php
                        if(isset($_SESSION['user'])){
                            echo "<li><a href=\"user.php\">$_SESSION[user]</a></li>";
                            echo "<li><a href=\"cart.php\">Cart</a></li>";
                            echo "<li><a href=\"history.php\">History</a></li>";
                            echo "<li><a href=\"logout.php\">Logout</a></li>";
                        }else{
                            echo "<li><a href=\"Login.php\">login</a></li>";
                            echo "<li><a href=\"Sign_up.php\">Sign up</a></li>";
                        }
                    ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-md-9">


                <div class="row">
                    <?php
                        $con = mysql_connect("localhost:3306","root","");
                        if (!$con)
                          {
                          die('Could not connect: ' . mysql_error());
                          }
                         
                        mysql_select_db("eshop", $con);
                        $result=mysql_query("SELECT name as name , quantity as quantity , price as price , image as image , product_id as product  from objects",$con);
                        while($data = mysql_fetch_assoc($result))
                        {

                        echo "
                        <div class=\"ol-sm-4 col-lg-4 col-md-4\">
                        <div class=\"thumbnail\">
                            <img src=\"$data[image]\" alt=\"\">
                            <div class=\"caption\">
                            <form action=\"#\" method=\"POST\">
                                <h4><a href=\"#\">$data[name]</a></h4>
                                 <h4 class=\"pull-right\">$data[price]</h4>
                                <h4><a href=\"#\">price</a></h4>";
                                if($data['quantity'] == 0){
                                    echo "<h4 class=\"pull-right\">OUT OF STOCK</h4>";
                                }else{
                                    echo "<h4 class=\"pull-right\">$data[quantity]</h4>
                                    <h4><a href=\"#\">quantity</a></h4>";
                                echo "
                                <input name=\"pid\" id=\"pid\" type=\"hidden\" value=$data[product]>
                                <input name=\"Button\" type=\"submit\" value=\"add to cart\">";
                               
                                if(isset($_POST['Button'])){
                                if(isset($_SESSION['user'])){
                                  
                                }else{
                                    header('Location: Login.php');
                                }
                                }
                            }
                                echo "
                            </form>
                            </div>
                            
                        </div>
                    </div>";
                    }
                    if(isset($_POST['Button'])){
                                if(isset($_SESSION['user'])){
                                   $res=mysql_query("INSERT INTO cart (product_id , quantity , user ) VALUES ('$_POST[pid]','1','$_SESSION[user]')",$con);

                                }
                            }

                    ?>
                    

                    
                </div>

            </div>

        </div>

    </div>
    <!-- /.container -->

    <div class="container">

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
