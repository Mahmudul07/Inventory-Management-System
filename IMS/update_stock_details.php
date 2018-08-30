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

        <link href="calendere/jquery-ui.css" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/sb-admin.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="calendere/jquery-ui.css" rel="stylesheet">
        <link href="css/jquery-ui.css" rel="stylesheet" type="text/css">
        <link href="css/jquery-ui.min.css" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css" media="screen" title="no title" charset="utf-8" />
        <link rel="stylesheet" href="css/template.css" type="text/css" media="screen" title="no title" charset="utf-8" />
        <script src=""></script>
        <style>
            input:invalid {
            //    border-color: #a9180e;
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



                $("#singleBirdRemote").autocomplete("category.php", {
                    width: 160,
                    autoFill: true,
                    selectFirst: false
                });
                $("#supplier").autocomplete("supplier1.php", {
                    width: 160,
                    autoFill: true,
                    selectFirst: false
                });


                $("#clear").click(function() {
                    $(":input").unautocomplete();
                });
            });


        </script>

        <script src="js/jquery.validationEngine-en.js" type="text/javascript"></script>
        <script src="js/jquery.validationEngine.js" type="text/javascript"></script>
        <script src="js/jquery.hotkeys-0.7.9.js"></script>
   

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
                                <h1 class="panel-title">Update Stock Details</h1>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-offset-3">

                        <?php
                        if(isset($_POST['stock_name'])) {
                            $id = $_POST['id'];
                            $id = mysql_real_escape_string($_POST['id']);
                            $sid = mysql_real_escape_string($_POST['stock_id']);
                            $name = mysql_real_escape_string($_POST['stock_name']);
                            $category = mysql_real_escape_string($_POST['category']);
                            $buyingrate = mysql_real_escape_string($_POST['company_price']);
                            $sellingrate = mysql_real_escape_string($_POST['selling_price']);
                            $suplier = mysql_real_escape_string($_POST['supplier_id']);
                            $uom = mysql_real_escape_string($_POST['uom']);
                       //    $expiry = mysql_real_escape_string($_POST['expire_date']);


                            $selected_date=$_POST['expire_date'];
                            $selected_date=strtotime( $selected_date );
                            $mysqldate = date( 'Y-m-d', $selected_date );
                            $expire_date=$mysqldate;

                            $db->execute("UPDATE stock_details SET stock_id='$sid',stock_name='$name',supplier_id='$suplier',company_price=$buyingrate,
                                          selling_price=$sellingrate,category='$category',expire_date='$expire_date' WHERE id='$id' ");
                                echo "<meta http-equiv='refresh' content='0;url=view_stock_details.php'>";
                              //  exit(0);
                        }
                        ?>
                        <?php
                        if(isset($_GET['sid']))
                            $id=$_GET['sid'];
                        $line = $db->queryUniqueObject("SELECT * FROM stock_details WHERE id=$id");
                        ?>

                            <form role="form" name="form1" method="POST" id="form1" action=""  align="center">
                                <input name="id" type="hidden" value="<?php echo $_GET['sid']; ?>">
                                <div class="form-group">
                                    <label>ID</label>
                                    <input class="form-control" name="stock_id" type="text" id="id" readonly="" value="<?php echo $line->stock_id; ?>"  >
                                </div>
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input class="form-control" name="stock_name" type="text" id="name" class="validate[required,length[0,100]] text-input" value="<?php echo $line->stock_name; ?>" >
                                </div>


                                <div class="form-group">
                                    <label>Category</label>
                                    <input class="form-control" name="category" type="text" id="singleBirdRemote" value="<?php echo $line->category; ?>" >
                                </div>

                                <div class="form-group">
                                    <label>Buying Rate</label>
                                    <input class="form-control" name="company_price" type="text" id="buyingrate"  class="validate[required,custom[onlyNumber],lengthCheck[6]]text-input"  value="<?php echo $line->company_price; ?>">
                                </div>

                                <div class="form-group">
                                    <label>Selling Rate</label>
                                    <input class="form-control" name="selling_price" type="text" id="sellingrate"  class="validate[required,custom[onlyNumber],lengthCheck[6]] text-input" value="<?php echo $line->selling_price; ?>">
                                </div>

                                <div class="form-group">
                                    <label>Supplier</label>
                                    <input class="form-control"name="supplier_id" type="text" id="supplier" class="validate[optional,length[0,100]] text-input" value="<?php echo $line->supplier_id; ?>">
                                </div>

                                <div class="form-group">
                                    <label>Expaire Date</label>
                                    <input class="form-control" name="expire_date" type="text" id="expiry" class="validate[optional,length[0,100]] text-input" value="<?php
                                    $phpdate = strtotime( $line->expire_date );
                                    $phpdate = date("d-m-Y",$phpdate);
                                    echo $phpdate; ?>"">

                                </div>

                                <div>
                                <input type="submit" name="Submit" class="btn btn-primary" value="Update">
                                    <input type="button" name="cancel" value="Cancel" onClick="javascript:location.href='view_stock_details.php';" class="btn btn-primary">
                           </div>
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
            <span class="copyright">Copyright © SCDB | <a href="#">Inventory Management System</a> </span>
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



        $( "#expiry" ).datepicker({
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