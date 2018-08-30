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
        <script src="js/bootstrap.min.js"></script>
        <script src="month_pic/jquery-1.12.1.min.js"></script>
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


        <!---------For Month Pic Start------->
        <link href="month_pic/jquery-ui.css" rel="stylesheet" type="text/css" />
        <link href="month_pic/MonthPicker.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="month_pic/examples.css" />


        <script src="month_pic/jquery-ui.min.js"></script>
        <script src="month_pic/jquery.maskedinput.min.js"></script>

        <script src="month_pic/MonthPicker.min.js"></script>
        <script src="month_pic/examples.js"></script>
        <!---------For Month Pic End------->

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
                    <div class="col-lg-12 "style="padding: 60px; margin-bottom: 200px">
                        <div class="panel panel-primary">
                            <div class="panel-heading" align="center">
                                <h1 class="panel-title">Report</h1>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-8 col-md-offset-2">
                                        <form role="form" action="purchase_report.php" method="post" name="purchase_report" target="_blank">
                                            <table style="width: 80%; text-align: center;margin-bottom: 50px;">
                                                <tr>
                                                    <td><strong>From Month: </strong><input id="from_month" name="from_month" class="Default" type="text" /></td>
                                                    <td><strong>To Month: </strong><input id="to_month" name="to_month" class="Default" type="text" /></td>
                                                    <td> <input class="btn btn-primary" name="submit" type="button" value="Show" onclick="return show_profit();"> </td>
                                                </tr>
                                            </table>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8 col-md-offset-2" id="display-data">
                                    <!----Ajax Call---->
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


    <script type="text/javascript">
        function show_profit() {
            var from_month = $("#from_month").val();
            var to_month = $("#to_month").val();

            $.ajax({
                type: "POST",
                url: "relation_setup.php",
                data: {from_month: $("#from_month").val(), to_month: $("#to_month").val()},
                dataType: "text",
                cache: false,
                success:
                    function(data) {
                        $("#display-data").html(data);

                    }
            });
            return false;
        }


    </script>

    </body>
    </html>
    <?php
}

?>