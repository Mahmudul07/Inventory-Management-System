<?php
session_start();
if(!isset($_SESSION['username']) || $_SESSION['usertype'] !='admin'){
    header("location:indexx.php?msg=Please%20login%20to%20access%20admin%20area%20!");
}
else {
    include_once "db/db.php";
    error_reporting(E_ALL ^ E_NOTICE);
    ?>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Admin dashboard</title>
        <link href="Knight/css/style.css" rel="stylesheet" type="text/css">
        <link rel="icon" href="Knight/favicon.png" type="image/png">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/sb-admin.css" rel="stylesheet">
        <link href="css/plugins/morris.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <script src=""></script>
        <script src=""></script>
    </head>
    <body>
    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="collapse navbar-collapse" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"></a>
                <img align="right" src="images/inventory.png" alt="">
                <img align="left" src="images/s.gif" width="90px" height="55px">
            </div>
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="logout.php" class="dropdown-toggle" ><i class="fa fa-fw fa-power-off"></i> Log Out </a>
                </li>
                </ul>
                <?php
                include "link.php";
                ?>
        </nav>
        <div id="page-wrapper">
            <div class="container-fluid" style="margin-bottom: auto">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Company Performance Page
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Stock Details Chart</h3>
                            </div>
                            <div>
                                <?php
                                include 'bargraph.php';
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Product Notish Chart</h3>
                            </div>
                            <div>
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Stock Name</th>
                                        <th>Available Stock</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sqlStr = "SELECT name, quantity FROM stock_avail WHERE quantity < '50'";
                                    $query = mysql_query($sqlStr);
                                    $sl = 1;
                                    while($row = mysql_fetch_array($query)){
                                        ?>
                                        <tr>
                                            <td><?php echo $sl;?></td>
                                            <td><?php echo $row['name'];?></td>
                                            <td><?php echo $row['quantity'];?></td>
                                        </tr>
                                        <?php
                                        $sl++;
                                    }//while
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i> Company Product Price Chart</h3>
                            </div>
                            <div class="panel-body">
                                <div>
                                    <?php
                                    include 'linegraph.php';
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Transactions Panel</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                        <tr>
                                            <th>Operation Name</th>
                                            <th>Operation</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Total Number of Stocks</td>
                                            <td><?php echo $count = $db->countOfAll("stock_avail"); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Tatal Sales Transactions</td>
                                            <td><?php echo  $count = $db->countOfAll("stock_sales");?></td>
                                        </tr>
                                        <tr>
                                            <td>Total number of Suppliers</td>
                                            <td><?php echo $count = $db->countOfAll("supplier_details");?></td>

                                        </tr>
                                        <tr>
                                            <td>Total Number of Customers</td>
                                            <td><?php echo $count = $db->countOfAll("customer_details");?></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-right">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer" >
            <div class="container">
                <div class="footer-logo"><a href="#"><img src="" alt=""></a></div>
                <span class="copyright">Copyright © SCDB | <a href="#">Inventory Management System</a> </span>
            </div>
        </footer>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    </body>
    </html>
    <?php
}
    ?>