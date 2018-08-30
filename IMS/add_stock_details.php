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

    <link href="calendere/jquery-ui.css" rel="stylesheet">

    <link href="Knight/css/style.css" rel="stylesheet" type="text/css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="css/jquery-ui.css" rel="stylesheet" type="text/css">
    <link href="css/jquery-ui.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css" media="screen" title="no title" charset="utf-8" />
    <link rel="stylesheet" href="css/template.css" type="text/css" media="screen" title="no title" charset="utf-8" />
    <script src="js/jquery.min.js" type="text/javascript"></script>
    <script type='text/javascript' src='js/localdata.js'></script>
    <script type='text/javascript' src='js/jquery.autocomplete.js'></script>
    <script type='text/javascript' src='lib/jquery.ajaxQueue.js'></script>
    <script type='text/javascript' src='lib/thickbox-compressed.js'></script>


    <style>
        input:invalid {
        //  border-color: #a9180e;
        }
        input:valid {
            border: 1px solid rgb(200, 242, 250);
        }
    </style>
    <link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />
    <link rel="stylesheet" type="text/css" href="css/thickbox.css" />
    <script type='text/javascript' src='js/bootstrap.js'></script>
    <script type='text/javascript' src='lib/jquery.bgiframe.min.js'></script>
    <script type='text/javascript' src='js/jquery.autocomplete.js'></script>
    <link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />
    <script type="text/javascript" src="js/jquery-dynamic-form.js"></script>
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
            $("#suplier").autocomplete("supplier1.php", {
                width: 160,
                autoFill: true,
                selectFirst: false
            });

            $("#clear").click(function() {
                $(":input").unautocomplete();
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
                            <h1 class="panel-title"> Add Stock Details</h1>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <?php
                                if(isset($_POST['name']))
                                {
                                    $id=mysql_real_escape_string($_POST['id']);
                                    $name=mysql_real_escape_string($_POST['name']);
                                    $category=mysql_real_escape_string($_POST['category']);
                                    $buyingrate=mysql_real_escape_string($_POST['buyingrate']);
                                    $sellingrate=mysql_real_escape_string($_POST['sellingrate']);
                                    $suplier=mysql_real_escape_string($_POST['supplier']);
                                    $selected_date=$_POST['expire_date'];
                                    $selected_date=strtotime( $selected_date );
                                    $mysqldate = date( 'Y-m-d', $selected_date );
                                    $expire_date=$mysqldate;
                                    $count = $db->countOf("stock_details", "stock_id='$id'");
                                    if($count==1)
                                    {
                                        echo "<font color=red> Dublicat Entry. Please Verify</font>";
                                    }
                                    else
                                    {
                                        if($db->query("insert into stock_details(stock_id,stock_name,stock_quatity,supplier_id,company_price,selling_price,category,expire_date)
                                              values('$id','$name',0,'$suplier',$buyingrate,$sellingrate,'$category','$expire_date')"))
                                        {
                                            echo "<br><font color=green size=+1 > </font>" ;
                                            echo "<meta http-equiv='refresh' content='0;url=view_stock_details.php'>";
                                            $db->query("insert into stock_avail(name,quantity) values('$name',0)");
                                        }
                                        else
                                            echo "<br><font color=red size=+1 >Problem in Adding !</font>" ;
                                    }
                                }
                                ?>
                                <div class="col-lg-6 col-md-offset-3">
                                    <form role="form" name="form1" method="post" id="form1" action="" align="center">

                                        <div class="form-group">
                                            <label>ID</label>
                                            <?php
                                            $max = $db->maxOfAll("id", "stock_details");
                                            $max=$max+1;
                                            $autoid="SD".$max."";
                                            ?>
                                            <input class="form-control" name="id" type="text" id="id" readonly="" value="<?php echo $autoid; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Product Name</label>
                                            <input class="form-control" name="name" type="text" id="name" autocomplete="off" class="validate[required,length[0,100]] text-input" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Category</label>
                                            <input class="form-control" name="category" type="text" id="singleBirdRemote"  required aria-required="true"  >
                                        </div>
                                        <div class="form-group">
                                            <label>Buying Rate</label>
                                            <input class="form-control" name="buyingrate" type="text" id="buyingrate" autocomplete="off" class="validate[required,custom[onlyNumber],lengthCheck[6]] text-input"  required aria-required="true" pattern="[+0-9]+">
                                        </div>
                                        <div class="form-group">
                                            <label>Selling Rate</label>
                                            <input class="form-control" name="sellingrate" type="text" id="sellingrate" autocomplete="off"  class="validate[required,custom[onlyNumber],lengthCheck[6]] text-input"   required aria-required="true" pattern="[+0-9]+">
                                        </div>
                                        <div class="form-group">
                                            <label>Supplier Name</label>
                                            <input class="form-control" name="supplier" type="text" id="supplier" class="validate[optional,length[0,100]] text-input" autocomplete=""  required aria-required="true">
                                        </div>

                                        <div class="form-group">
                                            <label>Expire Date</label>
                                            <input class="form-control" name="expire_date" type="text" id="datepicker"  required aria-required="true">
                                        </div>

                                        <button type="submit" name="Submit" class="btn btn-primary">Submit </button>
                                        <button type="reset" name="Reset" value="Reset" class="btn btn-primary">Reset </button>

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
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>

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



    $( "#datepicker" ).datepicker({
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
    <?php
}

?>