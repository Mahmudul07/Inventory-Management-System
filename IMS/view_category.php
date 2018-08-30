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
        <script src=""></script>
        <script src=""></script>
        <script LANGUAGE="JavaScript">
          
            function confirmSubmit()
            {
                var agree=confirm("Are you sure you wish to Delete this Entry?");
                if (agree)
                    return true ;
                else
                    return false ;
            }
            function confirmDeleteSubmit()
            {
                var agree=confirm("Are you sure you wish to Delete Seletec Record?");
                if (agree)

                    document.deletefiles.submit();
                else
                    return false ;
            }
            function checkAll()
            {

                var field=document.forms.deletefiles;
                for (i = 0; i < field.length; i++)
                    field[i].checked = true ;
            }

            function uncheckAll()
            {
                var field=document.forms.deletefiles;
                for (i = 0; i < field.length; i++)
                    field[i].checked = false ;
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

        <?php

        $sql = 'SELECT * FROM stock_details';
        $result = mysql_query($sql);
        ?>



        <div id="page-wrapper">
            <div class="container-fluid" style="margin-bottom: 5%">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <small></small>
                        </h1>
                    </div>

                    <div class="col-lg-6 col-md-offset-3">
                        <form role="form" name="deletefiles" action="deleteselected.php" method="post" >
                            <input name="table" type="hidden" value="customer_details">
                            <input name="return" type="hidden" value="view_customer_details.php">
                            <div class="panel panel-primary">
                                <div class="panel-heading" align="center">
                                    <h1 class="panel-title"> View Category</h1>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <form role="form" name="deletefiles" action="deleteselected.php" method="post" >
                                            <input name="table" type="hidden" value="customer_details">
                                            <input name="return" type="hidden" value="view_customer_details.php">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover table-striped">
                                                    <thead>
                                                    <tr>
                                                        <td align="center"><strong> Product Name</strong></td>
                                                        <td align="center"><strong>Category Name</strong></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                            <?php
                                                            while($row = mysql_fetch_array($result)) {
                                                            ?>
                                                            <tr>
                                                                <td align="center"><?php echo $row['stock_name'] ?></td>
                                                                <td align="center"><?php echo $row['category'] ?></td>

                                                                </td>
                                                            </tr>

                                                            <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div>

                                <div style="margin-left:20px;"><?php echo $pagination; ?></div>


                            </div>
                        </form>
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
    </body>
    </html>
    <?php
}

?>