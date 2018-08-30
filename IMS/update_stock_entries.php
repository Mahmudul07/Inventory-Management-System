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
        <link href="css/jquery-ui.css" rel="stylesheet" type="text/css">
        <link href="css/jquery-ui.min.css" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css" media="screen" title="no title" charset="utf-8" />
        <link rel="stylesheet" href="css/template.css" type="text/css" media="screen" title="no title" charset="utf-8" />
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="js/jquery.date_input.js"></script>
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="js/jquery.date_input.js"></script>

        <link rel="stylesheet" href="css/date_input.css" type="text/css">
        <script type="text/javascript" src="js/jquery.date_input.js"></script>
        <script type="text/javascript">$(function() {
                $("#datefield").date_input();
        </script>

        <style>
            input:invalid {
            //  border-color: #a9180e;
            }
            input:valid {
                border: 1px solid rgb(200, 242, 250);
            }
        </style>

        <script type="text/javascript">
            $().ready(function() {

                function log(event, data, formatted) {
                    $("<li>").html( !data ? "No match!" : "Selected: " + formatted).appendTo("#result");
                }

                function formatItem(row) {
                    return row[0] + " (<strong>id: " + row[1] + "</strong>)";
                }
                function formatResult(row) {
                    return row[0].replace(/(<.+?>)/gi, '');
                }



                $("#singleBirdRemote").autocomplete("stock.php", {
                    width: 160,
                    autoFill: true,
                    selectFirst: false
                });
                $("#supplier").autocomplete("supplier1.php", {
                    width: 160,
                    autoFill: true,
                    selectFirst: false
                });
                $("#category").autocomplete("category.php", {
                    width: 160,
                    autoFill: true,
                    selectFirst: false
                });
                $("#uom").autocomplete("uom.php", {
                    width: 160,
                    autoFill: true,
                    selectFirst: false
                });


                $("#clear").click(function() {
                    $(":input").unautocomplete();
                });
            });


        </script>

        <script>





            $(document).ready(function() {
                // SUCCESS AJAX CALL, replace "success: false," by:     success : function() { callSuccessFunction() },
                $("#singleBirdRemote").focus();
                $("#singleBirdRemote").blur(function()
                {

                    $.post('check_stock_details.php', {stock_name: $(this).val() },
                        function(data){

                            // if(data=='no') //if username not avaiable
                            // {
                            //  $("#category").focus();
                            // }
                            $("#category").val(data.category);
                            $("#supplier").val(data.supplier);
                            $("#buyingrate").val(data.buyingrate);
                            $("#sellingrate").val(data.sellingprice);
                            $("#uom").val(data.uom);
                            $("#available").val(data.available);
                            $("#quantity").focus();
                        }, 'json');





                });

            });
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
                                <h1 class="panel-title"> Update Stock Availability</h1>
                            </div>
                            <div class="panel-body">
                                <div class="row">
    <?php
    if(isset($_POST['name']))

    {
        $sid=$_POST['id'];
        $pid=$_POST['pid'];
        $name=mysql_real_escape_string($_POST['name']);
        $category=mysql_real_escape_string($_POST['category']);
        $buyingrate=mysql_real_escape_string($_POST['buyingrate']);
        $sellingrate=mysql_real_escape_string($_POST['sellingrate']);
        $suplier=mysql_real_escape_string($_POST['suplier']);
        $quantity=mysql_real_escape_string($_POST['quantity']);
        $selected_date=$_POST['date'];
        $selected_date=strtotime( $selected_date );
        $mysqldate = date('Y-m-d H:i:s', $selected_date );
        $username = $_SESSION['username'];
        $total = $db->queryUniqueValue("SELECT quantity FROM stock_avail WHERE name='$name'");
        $previous = $db->queryUniqueValue("SELECT quantity FROM stock_entries WHERE stock_id='$sid'");
        $opening_stock = $db->queryUniqueValue("SELECT quantity FROM stock_entries WHERE stock_id='$sid'");
        if($quantity < $previous)
        {
            $difference = $previous - $quantity;
            $total = $total - $difference;
            $result=$db->query("SELECT * FROM stock_entries where id >= $pid");
            while ($line1 = $db->fetchNextObject($result)) {
                $osd=$line1->opening_stock - $difference;
                $csd=$line1->closing_stock - $difference;
                $cid=$line1->id;
                $db->execute("UPDATE stock_entries SET opening_stock=".$osd.",closing_stock=".$csd." WHERE id=$cid");
            }
        }
        if($quantity > $previous)
        {
            $difference = $quantity - $previous;
            $total = $total + $difference;
            $result=$db->query("SELECT * FROM stock_entries where id >= $pid");
            while ($line2 = $db->fetchNextObject($result)) {
                $osd=$line2->opening_stock + $difference;
                $csd=$line2->closing_stock + $difference;
                $cid=$line2->id;
                $db->execute("UPDATE stock_entries SET opening_stock=".$osd.",closing_stock=".$csd." WHERE id=$cid");
            }
        }
        $db->execute("UPDATE stock_avail SET quantity=$total WHERE name='$name'");
        $db->execute("UPDATE stock_entries SET stock_name='$name',stock_supplier_name='$suplier',category='$category',quantity=$quantity,company_price=$buyingrate,selling_price=$sellingrate,date='$mysqldate',username='$username' WHERE stock_id='$sid'");
        echo "<br><font color=green size=+1 > [$name] Stock Entry Updated !</font>" ;
    }
    if(isset($_GET['id']))
    {
        $id=$_GET['id'];
        $line = $db->queryUniqueObject("SELECT * FROM stock_entries WHERE id=$id");
        ?>
                                    <div class="col-lg-6 col-md-offset-3">
                                        <form role="form" name="form1" method="post" id="form1" action="">
                                                <input class="form-control" name="pid" type="hidden" value="<?php echo $_GET['id']; ?>">
                                            <div class="form-group">
                                                <label>ID</label>
                                                <input class="form-control" name="id" type="text" id="id" readonly=""value="<?php echo $line->stock_id;?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Date</label>
                                                <input class="form-control" type="text" id="datefield" name="date" class="date_input" value="<?php
                                                $mysqldate=$line->date;
                                                $phpdate = strtotime( $mysqldate );
                                                $phpdate = date("d-m-Y",$phpdate);
                                                echo $phpdate;
                                                ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input class="form-control" type="text" id="singleBirdRemote" class="validate[required,length[0,100]] text-input" value="<?php echo $line->stock_name ;?>" >
                                            </div>
                                            <div class="form-group">
                                                <label>Category</label>
                                                <input class="form-control" type="text" id="singleBirdRemote" class="validate[required,length[0,100]] text-input" value="<?php echo $line->category ;?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Supplier Name</label>
                                                <input class="form-control" name="suplier" type="text" id="supplier" class="validate[optional,length[0,100]] text-input" value="<?php echo $line->stock_supplier_name ;?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Buying Rate</label>
                                                <input class="form-control"  name="buyingrate" type="text" id="buyingrate"  class="validate[required,custom[onlyNumber],lengthCheck[6]] text-input"  value="<?php echo $line->company_price ;?>">
                                            </div>

                                            <div class="form-group">
                                                <label>Selling Price</label>
                                                <input class="form-control" name="sellingrate" type="text" id="sellingrate"  class="validate[required,custom[onlyNumber],lengthCheck[6]] text-input" value="<?php echo $line->selling_price ;?>" >
                                            </div>
                                            <div class="form-group">
                                                <label>Quantity</label>
                                                <input class="form-control" name="quantity" type="text" id="quantity"  class="validate[required,custom[onlyNumber],lengthCheck[6]] text-input" value="<?php echo $line->quantity ;?>" >
                                            </div>
                                            <div class="form-group">
                                                <label>Available Quantity</label>
                                                <input class="form-control"  name="available" type="text" id="available" value="<?php
                                                $availquantity = $db->queryUniqueValue("SELECT quantity FROM stock_avail WHERE name='".$line->stock_name."'");
                                                echo  $availquantity;?>"  readonly="">
                                            </div>

                                            <button type="submit" name="Submit" class="btn btn-default">Submit </button>
                                            <button type="reset" name="Reset" value="Reset" class="btn btn-default">Reset </button>

                                        </form>

                                        <?php
                                        }
                                        else
                                            echo "Error in processing the stock Entry updation";
                                        ?>
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
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    </body>
    </html>
    <?php
}

?>