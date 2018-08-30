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
        $SQL = "SELECT * FROM  customer_details";
        if(isset($_POST['Search']) AND trim($_POST['searchtxt'])!="")
        {
            $SQL = "SELECT * FROM  customer_details WHERE customer_name LIKE '%".$_POST['searchtxt']."%' OR customer_address LIKE '%".$_POST['searchtxt']."%' OR customer_contact1 LIKE '%".$_POST['searchtxt']."%' OR customer_contact2 LIKE '%".$_POST['searchtxt']."%'";
        }
        $tbl_name="customer_details";
        $adjacents = 3;
        $query = "SELECT COUNT(*) as num FROM $tbl_name";
        if(isset($_POST['Search']) AND trim($_POST['searchtxt'])!="")
        {
            $query = "SELECT COUNT(*) as num FROM  customer_details WHERE customer_name LIKE '%".$_POST['searchtxt']."%' OR customer_address LIKE '%".$_POST['searchtxt']."%' OR customer_contact1 LIKE '%".$_POST['searchtxt']."%' OR customer_contact2 LIKE '%".$_POST['searchtxt']."%'";
        }
        $total_pages = mysql_fetch_array(mysql_query($query));
        $total_pages = $total_pages[num];
        $targetpage = "view_customer_details.php";
        $limit = 10;
        if(isset($_GET['limit']))
            $limit=$_GET['limit'];
        $page = $_GET['page'];
        if($page)
            $start = ($page - 1) * $limit;
        else
            $start = 0;
        $sql = "SELECT * FROM customer_details LIMIT $start, $limit ";
        if(isset($_POST['Search']) AND trim($_POST['searchtxt'])!="")
        {
            $sql= "SELECT * FROM  customer_details WHERE customer_name LIKE '%".$_POST['searchtxt']."%' OR customer_address LIKE '%".$_POST['searchtxt']."%' OR customer_contact1 LIKE '%".$_POST['searchtxt']."%' OR customer_contact2 LIKE '%".$_POST['searchtxt']."%'  LIMIT $start, $limit";
        }
        $result = mysql_query($sql);
        if ($page == 0) $page = 1;
        $prev = $page - 1;
        $next = $page + 1;
        $lastpage = ceil($total_pages/$limit);
        $lpm1 = $lastpage - 1;
        $pagination = "";
        if($lastpage > 1)
        {
            $pagination .= "<div class=\"pagination\">";
            if ($page > 1)
                $pagination.= "<a href=\"$targetpage?page=$prev&limit=$limit\"> <span class='glyphicon glyphicon-fast-backward' >  </span></a>";
            else
                $pagination.= "<span class=\"disabled\"> <span class='glyphicon glyphicon-fast-backward'> </span></span>";
            if ($lastpage < 7 + ($adjacents * 2))
            {
                for ($counter = 1; $counter <= $lastpage; $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<span class=\"current\">$counter</span>";
                    else
                        $pagination.= "<a href=\"$targetpage?page=$counter&limit=$limit\">$counter</a>";
                }
            }
            elseif($lastpage > 5 + ($adjacents * 2))	
            {
                if($page < 1 + ($adjacents * 2))
                {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                    {
                        if ($counter == $page)
                            $pagination.= "<span class=\"current\">$counter</span>";
                        else
                            $pagination.= "<a href=\"$targetpage?page=$counter&limit=$limit\">$counter</a>";
                    }
                    $pagination.= "...";
                    $pagination.= "<a href=\"$targetpage?page=$lpm1&limit=$limit\">$lpm1</a>";
                    $pagination.= "<a href=\"$targetpage?page=$lastpage&limit=$limit\">$lastpage</a>";
                }
                elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
                {
                    $pagination.= "<a href=\"$targetpage?page=1&limit=$limit\">1</a>";
                    $pagination.= "<a href=\"$targetpage?page=2&limit=$limit\">2</a>";
                    $pagination.= "...";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                    {
                        if ($counter == $page)
                            $pagination.= "<span class=\"current\">$counter</span>";
                        else
                            $pagination.= "<a href=\"$targetpage?page=$counter&limit=$limit\">$counter</a>";
                    }
                    $pagination.= "...";
                    $pagination.= "<a href=\"$targetpage?page=$lpm1&limit=$limit\">$lpm1</a>";
                    $pagination.= "<a href=\"$targetpage?page=$lastpage&limit=$limit\">$lastpage</a>";
                }
                else
                {
                    $pagination.= "<a href=\"$targetpage?page=1&limit=$limit\">1</a>";
                    $pagination.= "<a href=\"$targetpage?page=2&limit=$limit\">2</a>";
                    $pagination.= "...";
                    for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
                    {
                        if ($counter == $page)
                            $pagination.= "<span class=\"current\">$counter</span>";
                        else
                            $pagination.= "<a href=\"$targetpage?page=$counter&limit=$limit\">$counter</a>";
                    }
                }
            }
            if ($page < $counter - 1)
                $pagination.= "<a href=\"$targetpage?page=$next&limit=$limit\"><span class='glyphicon glyphicon-fast-forward'></span></a>";
            else
                $pagination.= "<span class=\"disabled\"><span class='glyphicon glyphicon-fast-forward'></span></span>";
            $pagination.= "</div>\n";
        }
        ?>
        <div id="page-wrapper">
            <div class="container-fluid" style="margin-bottom: 25%">
                <div class="row">
                    <div class="col-lg-12">
                      <div class="col-lg-12">
                          <div class="panel-body">
                              <form action="" method="post" name="search" class="navbar-form navbar-left">
                                  <div class="form-group">
                                      <input name="searchtxt" type="text" class="form-control" placeholder="Search">
                                  </div>
                                  <button name="Search" class="btn btn-primary dropdown-toggle" type="submit">Search</button>
                              </form>
                                <form class="navbar-form navbar-left" action="" method="get" name="page">
                                        Page per Record<input class="form-control" name="limit" type="text"  style="margin-left:5px;" value="<?php if(isset($_GET['limit'])) echo $_GET['limit']; else echo "10"; ?>" size="3" maxlength="3">
                                        <input class="btn btn-primary dropdown-toggle" name="go" type="submit" value="Go">
                                        <input class="btn btn-primary dropdown-toggle" type="button" name="selectall" value="SelectAll" onClick="checkAll()"  style="margin-left:5px;"/>
                                        <input class="btn btn-primary dropdown-toggle" type="button" name="unselectall" value="DeSelectAll" onClick="uncheckAll()" style="margin-left:5px;" />
                                        <input class="btn btn-primary dropdown-toggle" name="dsubmit" type="button" value="Delete Selected" style="margin-left:5px;" onclick="return confirmDeleteSubmit()"/>
                                </form>
                            </div>
                      </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <form role="form" name="deletefiles" action="deleteselected.php" method="post" >
                            <input name="table" type="hidden" value="customer_details">
                            <input name="return" type="hidden" value="view_customer_details.php">
                        <div class="panel panel-primary">
                            <div class="panel-heading" align="center">
                                <h1 class="panel-title"> View Customers Details</h1>
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
                                                                <th>Customer Name</th>
                                                                <th>Customer Address</th>
                                                                <th>Customer Contact1</th>
                                                                <th>Customer Contact2</th>
                                                                <th>View/Edit</th>
                                                                <th>Delete</th>
                                                                <th>Select</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                            while($row = mysql_fetch_array($result))
                                                            {
                                                                $mysqldate=$row['date'];
                                                                $phpdate = strtotime( $mysqldate );
                                                                $phpdate = date("d/m/Y",$phpdate);
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $row['customer_name']; ?></td>
                                                                    <td><?php echo $row['customer_address']; ?></td>
                                                                    <td><?php echo $row['customer_contact1']; ?></td>
                                                                    <td><?php echo $row['customer_contact2']; ?></td>
                                                                    <td align="center"> <a href="update_customer_details.php?sid=<?php echo $row['id'];?>"><span class=" glyphicon glyphicon-pencil"></span></a></td>
                                                                    <td align="center"><a onclick="return confirmSubmit()" href="delete.php?id=<?php echo $row['id']; ?>&table=customer_details&return=view_customer_details.php"><span class="glyphicon glyphicon-trash"></span></a></td>
                                                                    <td align="center" ><input  type="checkbox" value="<?php echo $row['id']; ?>" name="checklist[]" /></td>
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