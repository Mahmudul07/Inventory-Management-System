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

        <title>Inventory Management System</title>
        <link rel="icon" href="Knight/favicon.png" type="image/png">
        <link href="Knight/css/style.css" rel="stylesheet" type="text/css">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/sb-admin.css" rel="stylesheet">
        <link href="css/plugins/morris.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="calendere/jquery-ui.css" rel="stylesheet">
        <script type="text/javascript" src="js/jquery.date_input.js"></script>
        <link rel="stylesheet" href="css/date_input.css" type="text/css">
        <script type="text/javascript">$(function() {
                $("#due").date_input();
            });
        </script>
        <script src=""></script>
        <style>
            input:invalid {
            //    border-color: #a9180e;
            }

            input:valid {
                border: 1px solid rgb(200, 242, 250);
            }
        </style>

        <script src="js/jquery.validationEngine-en.js" type="text/javascript"></script>
        <script src="js/jquery.validationEngine.js" type="text/javascript"></script>
        <script src="js/jquery.hotkeys-0.7.9.js"></script>
        <script>
            function balanceCalc()
            {		if(parseFloat($("#newpayment").val()) > parseFloat($("#balance").val()))
                $("#newpayment").val(parseFloat($("#balance").val()));
            }
            </script>
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
            <div class="container-fluid" style="padding-bottom: 10%">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 align="center" class="page-header">

                            <small></small>
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading" align="center">
                                <h1 class="panel-title"> Add Stock Sales Customer Payment</h1>
                            </div>
                            <div class="panel-body">
                                <div class="row">

                                    <?php
                                    if(isset($_POST['id']))
                                    {
                                        $id=mysql_real_escape_string($_POST['id']);
                                        $balance=mysql_real_escape_string($_POST['balance']);
                                        $payment=mysql_real_escape_string($_POST['payment']);
                                        $customer=mysql_real_escape_string($_POST['customer']);
                                        $subtotal=mysql_real_escape_string($_POST['subtotal']);
                                        $newpayment=mysql_real_escape_string($_POST['newpayment']);
                                        $selected_date=$_POST['due'];
                                        $selected_date=strtotime( $selected_date );
                                        $mysqldate = date( 'Y-m-d H:i:s', $selected_date );
                                        $due=$mysqldate;
                                        $balance= (int) $balance - (int) $newpayment;
                                        $payment= (int) $payment + (int) $newpayment;
                                        $max = $db->maxOfAll("id", "transactions");
                                        $receiptid="RCPT".$max;
                                        if($db->query("UPDATE stock_sales SET balance=$balance,payment=$payment,due='$due' where transactionid='$id'"))
                                        {
                                            $db->query("INSERT INTO transactions (type,customer,subtotal,payment,balance,due,rid)
                                            VALUES('Sales','$customer','$subtotal','$newpayment','$balance','$due','$receiptid')");

                                            $max = $db->maxOfAll("id", "transactions");
                                          //  echo "<br><font color=green size=+1 > [ $id ] Customer Details Updated!</font>" ;
                                            echo "<script>window.open('payment_receipt_print.php?sid=$max','myNewWinsr','width=620,height=800,toolbar=0,menubar=no,status=no,resizable=yes,location=no,directories=no');</script>";
                                            echo "<meta http-equiv='refresh' content='0;url=view_stock_sales_payments.php'>";
                                        }
                                        else
                                            echo "<br><font color=red size=+1 >Problem in Updation !</font>" ;
                                    }
                                    ?>
                                    <?php
                                    if(isset($_GET['eid']))
                                        $id=$_GET['eid'];
                                    $line = $db->queryUniqueObject("SELECT * FROM stock_sales WHERE transactionid='$id'");
                                    ?>

                                    <div class="col-lg-6 col-md-offset-3">
                                        <form role="form" name="form1" method="post" id="form1" action="" align="center">
                                            <input name="id" type="hidden" value="<?php echo $_GET['eid']; ?>">

                                            <div class="form-group">
                                                <label>Sales ID</label>
                                                <input class="form-control" name="eid" type="text" id="eid"  value="<?php echo $line->transactionid; ?>" readonly="">
                                            </div>

                                            <div class="form-group">
                                                <label>Supplier</label>
                                                <input class="form-control" name="customer" type="text" id="customer"  value="<?php echo $line->customer_id; ?>" readonly="">
                                            </div>

                                            <div class="form-group">
                                                <label>Total</label>
                                                <input class="form-control" name="total" type="text" id="total"   value="<?php echo $line->subtotal; ?>" readonly="">
                                            </div>

                                            <div class="form-group">
                                                <label>Paid</label>
                                                <input class="form-control" name="payment" type="text" id="payment"  c value="<?php echo $line->payment;?>" readonly="">
                                            </div>

                                            <div class="form-group">
                                                <label>Balance</label>
                                                <input class="form-control" name="balance" type="text" id="balance"   value="<?php echo $line->balance;?>" readonly="">
                                            </div>

                                            <div class="form-group">
                                                <label>Next Due</label>
                                                <input class="form-control" name="due" type="text" id="due"   value="<?php
                                                $phpdate = strtotime(  $line->due );
                                                $phpdate = date("d-m-Y",$phpdate);
                                                echo $phpdate; ?>" >
                                            </div>

                                            <div class="form-group">
                                                <label>New Payment</label>
                                                <input class="form-control" name="newpayment" type="text" id="newpayment"  class="validate[optional,custom[onlyNumber],length[0,100]] text-input"
                                                       value="" onKeyUp="balanceCalc()" required>
                                            </div>
                                            <button type="submit" name="Submit" class="btn btn-primary">Submit </button>
                                            <a href="view_stock_sales_payments.php"><input type="button" name="Reset" value="Cancle" class="btn btn-primary"></a>
                                        </form>
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
            <span class="copyright">Copyright © 2016 | <a href="#">Inventory Management System</a> </span>
        </div>
    </footer>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="calendere/external/jquery/jquery.js"></script>
    <script src="calendere/jquery-ui.js"></script>
    <script>

        $( "#accordion" ).accordion();



        var availableTags = [
            "ActionScript",
            "AppleScript",
            "Asp",
            "BASIC",
            "C",
            "C++",
            "Clojure",
            "COBOL",
            "ColdFusion",
            "Erlang",
            "Fortran",
            "Groovy",
            "Haskell",
            "Java",
            "JavaScript",
            "Lisp",
            "Perl",
            "PHP",
            "Python",
            "Ruby",
            "Scala",
            "Scheme"
        ];
        $( "#autocomplete" ).autocomplete({
            source: availableTags
        });



        $( "#button" ).button();
        $( "#button-icon" ).button({
            icon: "ui-icon-gear",
            showLabel: false
        });



        $( "#radioset" ).buttonset();



        $( "#controlgroup" ).controlgroup();



        $( "#tabs" ).tabs();



        $( "#dialog" ).dialog({
            autoOpen: false,
            width: 400,
            buttons: [
                {
                    text: "Ok",
                    click: function() {
                        $( this ).dialog( "close" );
                    }
                },
                {
                    text: "Cancel",
                    click: function() {
                        $( this ).dialog( "close" );
                    }
                }
            ]
        });

        // Link to open the dialog
        $( "#dialog-link" ).click(function( event ) {
            $( "#dialog" ).dialog( "open" );
            event.preventDefault();
        });



        $( "#due" ).datepicker({
            inline: true
        });



        $( "#slider" ).slider({
            range: true,
            values: [ 17, 67 ]
        });



        $( "#progressbar" ).progressbar({
            value: 20
        });



        $( "#spinner" ).spinner();



        $( "#menu" ).menu();



        $( "#tooltip" ).tooltip();



        $( "#selectmenu" ).selectmenu();


        // Hover states on the static widgets
        $( "#dialog-link, #icons li" ).hover(
            function() {
                $( this ).addClass( "ui-state-hover" );
            },
            function() {
                $( this ).removeClass( "ui-state-hover" );
            }
        );
    </script

    </body>
    </html>
    <?php
}

?>