<?php
session_start();
if(!isset($_SESSION['username']) || $_SESSION['usertype'] !='admin'){
    header("location:indexx.php?msg=Please%20login%20to%20access%20admin%20area%20!");
}
else {
    include_once "db/db.php";
    error_reporting(E_ALL ^ E_NOTICE);
    ?>
    <html>
    <head>
        <title>Inventory Management System</title>
        <link rel="icon" href="Knight/favicon.png" type="image/png">
        <link href="Knight/css/style.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <link href="css/sb-admin.css" rel="stylesheet">
        <script src="lib/jquery.ajaxQueue.js"></script>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script src="js/jquery.min.js" type="text/javascript"></script>


        <script type="text/javascript">$(function() {
                $("#datefield").date_input();
                $("#due").date_input();});
        </script>
        <script type='text/javascript' src='js/bootstrap.js'></script>
        <script type='text/javascript' src='lib/jquery.bgiframe.min.js'></script>
        <script type='text/javascript' src='js/jquery.autocomplete.js'></script>
        <link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />
        <script type="text/javascript" src="js/jquery-dynamic-form.js"></script>


        <script type="text/javascript">
            $(document).ready(function(){
                $("#duplicate").dynamicForm("#plus", "#minus", {limit:50, createColor: 'yellow',removeColor: 'green'});
            });
        </script>



        <link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />
        <link rel="stylesheet" type="text/css" href="lib/thickbox.css" />
        <script type="text/javascript" src="js/jquery-dynamic-form.js"></script>

        <script type="text/javascript" src="js/jquery.date_input.js"></script>
        <link rel="stylesheet" href="css/date_input.css" type="text/css">
        <script type="text/javascript">$(function() {
                $("#from_sales_date").date_input();
                $("#to_sales_date").date_input();
                $("#from_purchase_date").date_input();
                $("#to_purchase_date").date_input();
                $("#from_sales_purchase_date").date_input();
                $("#to_sales_purchase_date").date_input();
                $("#from_stock_sales_date").date_input();
                $("#to_stock_sales_date").date_input();

            });
            function sales_report_fn()
            {
                window.open("sales_report.php?from_sales_date="+$('#from_sales_date').val()+"&to_sales_date="+$('#to_sales_date').val(),"myNewWinsr","width=620,height=800,toolbar=0,menubar=no,status=no,resizable=yes,location=no,directories=no,scrollbars=yes");
            }
            function purchase_report_fn()
            {
                window.open("purchase_report.php?from_purchase_date="+$('#from_purchase_date').val()+"&to_purchase_date="+$('#to_purchase_date').val(),"myNewWinsr","width=620,height=800,toolbar=0,menubar=no,status=no,resizable=yes,location=no,directories=no,scrollbars=yes");
            }
            function sales_purchase_report_fn()
            {
                window.open("all_report.php?from_sales_purchase_date="+$('#from_sales_purchase_date').val()+"&to_sales_purchase_date="+$('#to_sales_purchase_date').val(),"myNewWinsr","width=620,height=800,toolbar=0,menubar=no,status=no,resizable=yes,location=no,directories=no,scrollbars=yes");
            }
            function stock_sales_report_fn()
            {
                window.open("sales_stock_report.php?from_stock_sales_date="+$('#from_stock_sales_date').val()+"&to_stock_sales_date="+$('#to_stock_sales_date').val(),"myNewWinsr","width=620,height=800,toolbar=0,menubar=no,status=no,resizable=yes,location=no,directories=no,scrollbars=yes");
            }
        </script>
        <script src="js/jquery.validationEngine.js" type="text/javascript"></script>
        <script src="js/jquery.hotkeys-0.7.9.js"></script>
        <script type='text/javascript' src='lib/jquery.ajaxQueue.js'></script>


    </head>
    <body>
    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"></a>
                <img src="images/inventory.png" alt="">
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
            <div class="container-fluid" style="padding-bottom: 20%">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 align="center" class="page-header">
                            <small></small>
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class="panel panel-primary">
                            <div class="panel-heading" align="center">
                                <h1 class="panel-title">Report</h1>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-8 col-md-offset-2">
                                        <table align="center">
                                        <tr>
                                        <form role="form"action="sales_report.php" method="post" name="sales_report" id="sales_report" target="myNewWinsr">
                                           <div class="form-group-md">

                                                   <td><strong>Sales Report: </strong></td>
                                                   <td></td>
                                                   <td><input class="form-control" name="from_sales_date" type="text" id="from_sales_date" placeholder="Form" style="width:90px;"></td>
                                                   <td></td>
                                                   <td><input class="form-control" name="to_sales_date" type="text" id="to_sales_date" placeholder="To" style="width:90px;"></td>
                                                   <td></td>
                                                   <td><input class="form-control" name="submit" type="button" value="Show" onClick='sales_report_fn();'></td>

                                           </div>
                                        </form>
                                        </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                        <tr>
                                            <div class="form-group-md">
                                            <form action="purchase_report.php" method="post" name="purchase_report" target="_blank">
                                                <td><strong>Purchase Report: </strong></td>
                                                <td></td>
                                                <td><input class="form-control" name="from_purchase_date" type="text" id="from_purchase_date" placeholder="From" style="width:90px;"></td>
                                                <td></td>
                                                <td><input class="form-control" name="to_purchase_date" type="text" id="to_purchase_date" placeholder="To" style="width:90px;"></td>
                                                <td></td>
                                                <td><input class="form-control" name="submit" type="button" value="Show" onClick='purchase_report_fn();'></td>
                                            </form>
                                                </div>
                                        </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                        <tr>
                                          <div class="form-group-md">
                                            <form action="all_report.php" method="post" name="sales_purchase_report" target="_blank">
                                                <td><strong>Purchase Stocks: </strong></td>
                                                <td></td>
                                                <td><input class="form-control" name="from_sales_purchase_date" type="text" id="from_sales_purchase_date" placeholder="From" style="width:90px;"></td>
                                                <td></td>
                                                <td><input class="form-control" name="to_sales_purchase_date" type="text" id="to_sales_purchase_date" placeholder="To" style="width:90px;"></td>
                                                <td></td>
                                                <td><input class="form-control" name="submit" type="button" value="Show" onClick='sales_purchase_report_fn();'></td>
                                            </form>
                                          </div>
                                        </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <div class="form-group-md">
                                                    <form action="sales_stock_report.php" method="post" name="stock_sales_report" target="_blank">
                                                        <td><strong>Stock Report: </strong></td>
                                                        <td></td>
                                                        <td><input class="form-control" name="from_stock_sales_date" type="text" id="from_stock_sales_date" placeholder="From" style="width:90px;"></td>
                                                        <td></td>
                                                        <td><input class="form-control" name="to_stock_sales_date" type="text" id="to_stock_sales_date" placeholder="To" style="width:90px;"></td>
                                                        <td></td>
                                                        <td><input class="form-control" name="submit" type="button" value="Show" onClick='stock_sales_report_fn();'></td>
                                                    </form>
                                                </div>
                                            </tr>
                                    </table>

                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>

                                        <table class="table table-bordered table-hover table-striped" align="center">
                                            <tr>
                                                <td>Total Number of Stocks  </td>
                                                <td><strong><?php echo  $count = $db->countOfAll("stock_avail");?>&nbsp;</strong></td>
                                                <td>Payment Pending:</td>
                                                <td><strong><?php echo $db->queryUniqueValue("select sum(balance) FROM  stock_entries where count1=1 and type='entry'"); ?></strong></td>
                                            </tr>
                                            <tr>
                                                <td>Tatal Sales:</td>
                                                <td><strong><?php echo  $age = $db->queryUniqueValue("SELECT sum(subtotal) FROM stock_sales where count1=1 ");?></strong></td>
                                                <td>Outstanding Amount: </td>
                                                <td><strong><?php echo $db->queryUniqueValue("select sum(balance) FROM  stock_sales where count1=1"); ?></strong></td>

                                            </tr>

                                            <tr>
                                                <td>Total number of Suppliers </td>
                                                <td><strong><?php echo $count = $db->countOfAll("supplier_details");?></strong></td>
                                                <td>Total Number of Customers </td>
                                                <td><strong><?php echo $count = $db->countOfAll("customer_details");?></strong></td>

                                            </tr>
                                      </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <div class="footer-logo"><a href="#"><img src="" alt=""></a></div>
            <span class="copyright">Copyright © SCDB | <a href="#">Inventory Management System</a> </span>
        </div>

    </footer>

    <link rel="stylesheet" href="css/date_input.css" type="text/css">
    <script type="text/javascript" src="js/jquery.date_input.js"></script>
    <script type="text/javascript" src="js/jquery.date_input.min.js"></script>

    </body>
    </html>
    <?php
}

?>