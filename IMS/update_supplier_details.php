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

        <title>Update Customers Details</title>
        <link rel="icon" href="Knight/favicon.png" type="image/png">
        <link href="Knight/css/style.css" rel="stylesheet" type="text/css">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/sb-admin.css" rel="stylesheet">
        <link href="css/plugins/morris.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <script src=""></script>
        <script src=""></script>
        <style>
            input:invalid {
                border-color: #a9180e;
            }

            input:valid {
                border: 1px solid rgb(200, 242, 250);
            }
        </style>
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
                                <h1 class="panel-title"> Update Supplier Details</h1>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-offset-3">
                                        <?php
                                        if(isset($_POST['id']))
                                        {
                                            $id=mysql_real_escape_string($_POST['id']);
                                            $name=mysql_real_escape_string($_POST['name']);
                                            $address=mysql_real_escape_string($_POST['address']);
                                            $contact1=mysql_real_escape_string($_POST['contact1']);
                                            $contact2=mysql_real_escape_string($_POST['contact2']);
                                            $db->query("UPDATE supplier_details  SET supplier_name='$name',supplier_address='$address',supplier_contact1='$contact1',supplier_contact2='$contact2' where id=$id");
                                            echo "<meta http-equiv='refresh' content='0;url=view_supplier_details.php'>";
                                            exit(0);
                                        }
                                        ?>
                                        <?php
                                        if(isset($_GET['sid']))
                                            $id=$_GET['sid'];
                                        $line = $db->queryUniqueObject("SELECT * FROM supplier_details WHERE id=$id");

                                        ?>
                                        <form role="form" name="form1" method="post" id="form1" action="" align="center">
                                            <input name="id" type="hidden" value="<?php echo $_GET['sid']; ?>">
                                            <div class="form-group">
                                                <label>Supplier Name</label>
                                                <input class="form-control" name="name" type="text" id="name"  class="validate[required,length[0,100]] text-input" required aria-required="true" pattern="[A-Za-z]+\[A-Za-z]+" value="<?php echo $line->supplier_name; ?>">
                                            </div>

                                            <div class="form-group">
                                                <label>Address</label>
                                                <textarea class="form-control" rows="3" name="address" cols="15" required aria-required="true" pattern="[A-Za-z-0-9]+\s[A-Za-z-'0-9]+"><?php echo $line->supplier_address;?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Contact1</label>
                                                <input class="form-control" name="contact1" type="text" id="buyingrate"  class="validate[optional,custom[onlyNumber],length[6,15]] text-input" required aria-required="true" pattern="[+0-9]+" value="<?php echo $line->supplier_contact1;?>" >
                                            </div>

                                            <div class="form-group">
                                                <label>Contact2</label>
                                                <input class="form-control" name="contact2" type="text" id="sellingrate"  class="validate[optional,custom[onlyNumber],length[6,15]] text-input" required aria-required="true" pattern="[+0-9]+" value="<?php echo $line->supplier_contact2;?>" >
                                            </div>

                                            <button type="submit" name="Submit" class="btn btn-primary">Update </button>
                                            <a href="view_supplier_details.php"><button class="btn btn-primary">Cancle </button></a>

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
    </body>
    </html>
    <?php
}

?>