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

        <link rel="stylesheet" href="css/date_input.css" type="text/css">
        <script type="text/javascript" src="js/jquery.date_input.js"></script>
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
                $("#customer").autocomplete("customer.php", {
                    width: 160,
                    autoFill: true,
                    selectFirst: false
                });
            });


        </script>

        <script src="js/jquery.validationEngine.js" type="text/javascript"></script>
        <script src="js/jquery.hotkeys-0.7.9.js"></script>
        <script type='text/javascript' src='lib/jquery.ajaxQueue.js'></script>
        <script>

            function callAutoComplete(idname)
            {

                $("#"+idname).autocomplete("stock.php", {
                    width: 160,
                    autoFill: true,
                    mustMatch: false,
                    selectFirst: false
                });
            }
            function checkDublicateName()
            {	var k=0;
                for (i=0;i<=400;i=i+5)
                {
                    if($("#0"+i).length>0)
                    {		$k=0;
                        for (j=0;j<=400;j=j+5)
                        {
                            if($("#0"+j).length>0 && $("#0"+i).val()==$("#0"+j).val())
                            {
                                $k++;
                            }
                        }
                        if($k>1)
                        {
                            alert("Dublicate stock Entry. please remove new and add stock in existing one !");
                        }
                    }
                }
            }
            function callAutoAsignValue(idname)
            {
                var name1 = parseInt(idname,10);
                var quantity1 = name1+1;
                var rate1 =  quantity1+1;
                var avail1 = rate1+1;
                var total1 = avail1+1;
                if(parseInt(idname)>0)
                {
                    quantity1="00"+quantity1;
                    rate1="000"+rate1;
                    avail1="0000"+avail1;
                    total1="00000"+total1;
                }
                else
                {
                    quantity1="00";
                    rate1="000";
                    avail1="0000";
                    total1="00000";
                }
                $.post('check_sales_details.php', {stock_name: $("#"+idname).val() },
                    function(data){
                        $("#"+rate1).val(data.rate);
                        $("#"+avail1).val(data.availstock);
                        $("#"+quantity1).focus();
                    }, 'json');
                checkDublicateName();
            }
            function callQKeyUp(Qidname)
            {
                var quantity = parseInt(Qidname,10);
                var rate =  quantity+1;
                var avail = rate+1;
                var total = avail+1;
                var rowcount = parseInt((total+1)/5);
                if(rowcount==0)
                    rowcount=1;
                if(parseInt(Qidname)>0)
                {
                    quantity="00"+quantity;
                    rate="000"+rate;
                    avail="0000"+avail;
                    total="00000"+total
                }
                else
                {
                    quantity="00";
                    rate="000";
                    avail="0000";
                    total="00000";
                }
                var result= parseFloat($("#"+quantity).val()) * parseFloat( $("#"+rate).val() );
                result=result.toFixed(2);
                $("#"+total).val(result);
                if(parseFloat($("#"+quantity).val()) > parseFloat($("#"+avail).val()))
                    $("#"+quantity).val(parseFloat($("#"+avail).val()));
                updateSubtotal();
            }
            function balanceCalc()
            {		if(parseFloat($("#payment").val()) > parseFloat($("#subtotal").val()))
                $("#payment").val(parseFloat($("#subtotal").val()));
                var result= parseFloat($("#subtotal").val()) - parseFloat( $("#payment").val() );
                result=result.toFixed(2);
                $("#balance").val(result);
            }
            function updateSubtotal()
            {
                var temp=0;
                for (i=4;i<=400;i=i+5)
                {
                    if($("#00000"+i).length>0)
                    {
                        temp=parseFloat(temp)+parseFloat($("#00000"+i).val());
                    }
                }
                var subtotal=parseFloat(temp);
                if($("#00000").length>0)
                {
                    var firstrowvalue=$("#00000").val();
                    subtotal=parseFloat(subtotal)+parseFloat(firstrowvalue);
                }
                subtotal=subtotal.toFixed(2);
                $("#subtotal").val(subtotal);
            }
            function callRKeyUp(Ridname)
            {
                var rate = parseInt(Ridname,10);
                var quantity =  rate-1;
                var avail = rate+1;
                var total = avail+1;
                if(parseInt(Ridname)>0)
                {
                    quantity="00"+quantity;
                    rate="000"+rate;
                    avail="0000"+avail;
                    total="00000"+total
                }
                else
                {
                    quantity="00";
                    rate="000";
                    avail="0000";
                    total="00000";
                }
                var result= parseFloat($("#"+quantity).val()) * parseFloat( $("#"+rate).val() );
                result=result.toFixed(2);
                $("#"+total).val(result);
                if(parseFloat($("#"+quantity).val()) > parseFloat($("#"+avail).val()))
                    $("#"+quantity).val(parseFloat($("#"+avail).val()));
                updateSubtotal();
            }
            $(document).ready(function() {
                // SUCCESS AJAX CALL, replace "success: false," by:     success : function() { callSuccessFunction() },
                $("#billnumber").focus();
                /*$("#"+quantity).keyup(function (e) {

                 $("#"+total).val( parseInt( $("#"+qunatity).val()) * parseInt( $("#"+rate).val() ));
                 if(parseInt($("#"+quantity).val()) > parseInt($("#"+avail).val()))
                 $("#"+quantity).val(parseInt($("#"+avail).val()));

                 });

                 $("#"+rate).keyup(function (e) {

                 $("#"+total).val( parseInt($("#"+quantity).val()) * parseInt($("#"+rate).val()) );
                 if(parseInt($("#"+quantity).val()) > parseInt($("#"+avail).val()))
                 $("#"+quatity).val(parseInt($("#"+avail).val()));

                 });
                 */

                $("#customer").blur(function()
                {
                    $.post('check_customer_details.php', {stock_name1: $(this).val() },
                        function(data){
                            $("#address").val(data.address);
                            $("#contact1").val(data.contact1);
                            $("#contact2").val(data.contact2);
                            if(data.address!=undefined)
                                $("#0").focus();
                        }, 'json');
                });
                $("#form1").validationEngine(),
                    jQuery(document).bind('keydown', 'Ctrl+s',function() {
                        $('#form1').submit();
                        return false;
                    });
                jQuery(document).bind('keydown', 'Ctrl+r',function() {
                    $('#form1').reset();
                    return false;
                });
                jQuery(document).bind('keydown', 'Ctrl+a',function() {
                    window.location = "add_stock_sales.php";
                    return false;
                });
                jQuery(document).bind('keydown', 'Ctrl+0',function() {
                    window.location = "admin.php";
                    return false;
                });
                jQuery(document).bind('keydown', 'Ctrl+1',function() {
                    window.location = "add_purchase.php";
                    return false;
                });
                jQuery(document).bind('keydown', 'Ctrl+2',function() {
                    window.location = "add_stock_sales.php";
                    return false;
                });
                jQuery(document).bind('keydown', 'Ctrl+3',function() {
                    window.location = "add_stock_details.php";
                    return false;
                });
                jQuery(document).bind('keydown', 'Ctrl+4',function() {
                    window.location = "add_category.php";
                    return false;
                });
                jQuery(document).bind('keydown', 'Ctrl+5',function() {
                    window.location = "add_supplier_details.php";
                    return false;
                });
                jQuery(document).bind('keydown', 'Ctrl+6',function() {
                    window.location = "add_customer_details.php";
                    return false;
                });
                jQuery(document).bind('keydown', 'Ctrl+7',function() {
                    window.location = "view_stock_entries.php";
                    return false;
                });
                jQuery(document).bind('keydown', 'Ctrl+8',function() {
                    window.location = "view_stock_sales.php";
                    return false;
                });
                jQuery(document).bind('keydown', 'Ctrl+9',function() {
                    window.location = "view_stock_details.php";
                    return false;
                });
                jQuery(document).bind('keyup', 'Ctrl+down',function() {
                    $('#plus').click();
                    return false;
                });
                //$.validationEngine.loadValidation("#date")
                //alert($("#formID").validationEngine({returnIsValid:true}))
                //$.validationEngine.buildPrompt("#date","This is an example","error")	 		 // Exterior prompt build example								 // input prompt close example
                //$.validationEngine.closePrompt(".formError",true)
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
                                <h1 class="panel-title">Edit Sales Entry</h1>
                            </div>
                            <div class="panel-body">
                                <div class="row">

                                    <?php
                                    if(isset($_POST['billnumber']))
                                    {
                                        $billnumber=mysql_real_escape_string($_POST['billnumber']);
                                        $autoid=mysql_real_escape_string($_POST['id']);
                                        $customer=mysql_real_escape_string($_POST['customer1']);
                                        $address=mysql_real_escape_string($_POST['address1']);
                                        $contact1=mysql_real_escape_string($_POST['contact1']);
                                        $contact2=mysql_real_escape_string($_POST['contact2']);
                                        $payment=mysql_real_escape_string($_POST['payment']);
                                        $balance=mysql_real_escape_string($_POST['balance']);
                                        $newvalue =$balance;
                                        $oldvalue = $db->queryUniqueValue("SELECT balance FROM customer_details WHERE customer_name='$customer'");
                                        $diff=$newvalue-$oldvalue;
                                        $temp_balance = (int) $temp_balance +  (int) $diff;
                                        $db->execute("UPDATE customer_details SET balance=$temp_balance WHERE customer_name='$customer'");
                                        $selected_date=$_POST['due'];
                                        $selected_date=strtotime( $selected_date );
                                        $mysqldate = date( 'Y-m-d H:i:s', $selected_date );
                                        $due=$mysqldate;
                                        $mode=mysql_real_escape_string($_POST['mode']);
                                        $description=mysql_real_escape_string($_POST['description']);
                                        $namet=$_POST['name'];
                                        $quantityt=$_POST['quanitity'];
                                        $ratet=$_POST['rate'];
                                        $totalt=$_POST['total'];
                                        $subtotal=mysql_real_escape_string($_POST['subtotal']);
                                        $username=$_SESSION['username'];
                                        $i=0;
                                        $j=1;
                                        foreach($namet as $name1)
                                        {
                                            $quantity=$_POST['quantity'][$i];
                                            $rate=$_POST['rate'][$i];
                                            $total=$_POST['total'][$i];
                                            $selected_date=$_POST['date'];
                                            $selected_date=strtotime( $selected_date );
                                            $mysqldate = date( 'Y-m-d H:i:s', $selected_date );
                                            $username = $_SESSION['username'];
                                            $count = $db->queryUniqueValue("SELECT count(*) FROM stock_avail WHERE name='$name1' and quantity >=$quantity");
                                            if($count == 1)
                                            {
                                                $old_quantity= $db->queryUniqueValue("SELECT quantity FROM stock_sales WHERE transactionid='$autoid' and count1=$i");
                                                $db->query("update stock_sales set  stock_name='$name1',selling_price=$rate,quantity=$quantity,amount=$total,date='$mysqldate',username='$username',customer_id='$customer',subtotal=$subtotal,payment=$payment,balance=$balance,due='$due',mode='$mode',description='$description',billnumber='$billnumber' where transactionid='$autoid' and count1=$j");
                                                $quantity_diff=$quantity-$old_quantity;
                                                $quantity=$quantity+$quantity_diff;
                                                $amount = $db->queryUniqueValue("SELECT quantity FROM stock_avail WHERE name='$name1'");
                                                $amount1 = $amount - $quantity;
                                                $db->query("update stock_entries set stock_id='$autoid',stock_name='$name1',quantity=$quantity,opening_stock=$amount,closing_stock=$amount1,date='$mysqldate',username='$username',type='sales',salesid='$billnumber',total=$total,selling_price=$rate,billnumber='$billnumber' where salesid='$autoid' and count1=$j");
                                                //echo "<br><font color=green size=+1 >New Sales Added ! Transaction ID [ $autoid ]</font>" ;
                                                //echo "<br><font color=green size=+1> Current Stock Availability is  [ $amount1 ]</font>" ;
                                                $j++;
                                            }
                                            else
                                            {
                                                echo "<br><font color=green size=+1 >There is no enough stock deliver for $name1! Please add stock !</font>" ;
                                            }
                                            $i++;
                                        }
                                       // echo "<div style='background-color:yellow;'><br><font color=green size=+1 >Sales Updated ! Transaction ID [ $autoid ]</font></div> ";
                                        echo "<script>window.open('add_sales_print.php?sid=$autoid','myNewWinsr','width=620,height=800,toolbar=0,menubar=no,status=no,resizable=yes,location=no,directories=no');</script>";
                                        echo "<meta http-equiv='refresh' content='0;url=view_stock_sales.php'>";
                                        $count1 = $db->queryUniqueValue("SELECT count(*) FROM customer_details WHERE customer_name='$customer'");
                                        if($count1!=1)
                                        {
                                            if($db->query("insert into customer_details values(NULL,'$customer','$address','$contact1','$contact2')"))
                                            echo "<br><font color=green size=+1 > [ $name ] Customer Details Updated !</font>" ;
                                        }
                                    }
                                    ?>
                                    <?php
                                    if(isset($_GET['id']))
                                    {
                                        $id=$_GET['id'];
                                        $line = $db->queryUniqueObject("SELECT * FROM stock_sales WHERE transactionid='$id'");
                                        ?>
                                    <div class="col-lg-10 col-md-offset-2">
                                        <form role="form" name="salesform" method="post" id="form1" action="" onSubmit="updateSubtotal()">
                                            <table   border="0" cellspacing="0" cellpadding="0"  id="dynamictable">
                                                <tr>
                                                    <div class="form-group-md" align="right">
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td><strong>ID</strong></td>
                                                        <?php
                                                        $max = $db->maxOfAll("id","stock_sales");
                                                        $max=$max+1;
                                                        $autoid="SA".$max."";
                                                        ?>
                                                        <td> <input class="form-control" name="id" type="text" id="id" readonly="" value="<?php echo $line->transactionid; ?>" style="width:90px;" required></td>
                                                        <td>&nbsp;</td>
                                                        <td><strong>Date</strong></td>
                                                        <td><input class="form-control" type="text" id="datefield" name="date" class="date_input" value="<?php $phpdate = strtotime( $line->date );
                                                            $phpdate = date("d-m-Y",$phpdate);
                                                            echo $phpdate; ?>" style="width:100px;"></td>
                                                        <br>
                                                        <br>
                                                    </div>
                                                </tr>
                                                <tr>
                                                    <td width="105">&nbsp;</td>
                                                    <td width="105">&nbsp;</td>
                                                    <td width="105">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <div class="form-group-md" align="center">
                                                        <td><strong>Bill No:</strong></td>
                                                        <td><input class="form-control" type="text" name="billnumber" style="width:100px;" id="billnumber" value="<?php echo $line->billnumber; ?>"  class="validate[required,length[0,100]] text-input" required></td></td>
                                                        <td>&nbsp;</td>
                                                        <td><strong>Customer</strong></td>
                                                        <td><input class="form-control" name="customer1" type="text" id="customer"  value="<?php echo $line->customer_id; ?>" style="width:100px;" autocomplete="off" required></td>
                                                        <td>&nbsp;</td>
                                                        <td><strong>Address</strong></td>
                                                        <td><textarea class="form-control" name="address1" id="address" style="width:100px;"><?php echo $db->queryUniqueValue("SELECT customer_address FROM customer_details WHERE customer_name='$line->customer_id'"); ?></textarea></td>
                                                        <td>&nbsp;</td>
                                                        <td>
                                                            <strong>Contact1</strong>
                                                            <br><br><br>
                                                            <strong>Contact2</strong>
                                                        </td>
                                                        <td><input class="form-control" name="contact1" type="text" id="contact1"  value="<?php echo $db->queryUniqueValue("SELECT 	customer_contact1 FROM customer_details WHERE customer_name='$line->customer_id'"); ?>" style="width:90px;">
                                                            <br>
                                                            <input class="form-control" name="contact2" type="text" id="contact2"  value="<?php echo $db->queryUniqueValue("SELECT 	customer_contact2 FROM customer_details WHERE customer_name='$line->customer_id'"); ?>" style="width:90px;" >
                                                        </td>
                                                    </div>
                                                </tr>
                                                <tr>
                                                    <td width="105">&nbsp;</td>
                                                    <td width="105">&nbsp;</td>
                                                    <td width="105">&nbsp;</td>
                                                </tr>
                                            </table>
                                            <table  border="0" cellspacing="0" cellpadding="0"  id="duplicate" style="">


                                                <?php
                                                $max = $db->maxOf("count1", "stock_sales", "transactionid='$id'");
                                                $j=0;
                                                for($i=1; $i<=$max; $i++)
                                                {
                                                    ?>

                                                <tr>
                                                    <div class="form-group-md" align="right">
                                                        <td ><strong>Name:</strong></td>
                                                        <td ><input name="name[]" class="form-control" type="text"  id="0<?php echo 0+$j;?>" style="width:120px;" onFocus="callAutoComplete(this.id)"
                                                                    onBlur="callAutoAsignValue(this.id)" autocomplete="off" value="<?php
                                                            echo $db->queryUniqueValue("SELECT stock_name FROM stock_sales WHERE transactionid='$id' and count1=$i"); ?>">
                                                        </td>
                                                        <td>
                                                            <div align="right"><strong>Qty:</strong></div>
                                                        </td>
                                                        <td>
                                                            <input name="quantity[]" class="form-control" type="text" id="00<?php echo 1+$j;?>"   class="validate[required,custom[onlyFloat],lengthCheck[6]] text-input"  style="width:60px;" onKeyUp="callQKeyUp(this.id)" value="<?php
                                                            echo $db->queryUniqueValue("SELECT quantity FROM stock_sales WHERE transactionid='$id' and count1=$i");
                                                            ?>">
                                                        </td>
                                                        <td>
                                                            <div align="left"><strong>Rate:</strong></div>
                                                        </td>
                                                        <td>
                                                            <input name="rate[]" class="form-control" type="text" id="000<?php echo 2+$j;?>"  class="validate[required,custom[onlyFloat],lengthCheck[6]] text-input"  style="width:50px;" onKeyUp="callRKeyUp(this.id)" value="<?php
                                                            echo $db->queryUniqueValue("SELECT selling_price FROM stock_sales WHERE transactionid='$id' and count1=$i");
                                                            ?>"   >

                                                        </td>
                                                        <td>
                                                            <strong>Avail Qty</strong>
                                                        </td>
                                                        <td>
                                                            <input name="avail[]" class="form-control" type="text" id="0000<?php echo 3+$j;?>" readonly="" value="" style="width:50px;" >
                                                        </td>
                                                        <td><div align="left"><strong>Total:</strong></div></td>
                                                        <td>
                                                            <input name="total[]" class="form-control" type="text" id="00000<?php echo 4+$j;?>" readonly="" value="<?php
                                                            echo $db->queryUniqueValue("SELECT selling_price FROM stock_sales WHERE transactionid='$id' and count1=$i");
                                                            ?>" style="width:120px;text-align:right;" >
                                                        </td>
                                                        <td width="50"><p><span><a id="minus" href=""  >[-]</a> <a id="plus" href="">[+]</a></span></p></td>
                                                    </div>
                                                </tr>
                                                <?php
                                                $j=$j+5;
                                                }
                                                ?>
                                                <tr>
                                                    <td width="105">&nbsp;</td>
                                                    <td width="105">&nbsp;</td>
                                                    <td width="105">&nbsp;</td>
                                                </tr>

                                            </table>
                                            <tr>
                                                <td width="105">&nbsp;</td>
                                                <td width="105">&nbsp;</td>
                                                <td width="105">&nbsp;</td>
                                            </tr>


                                            <table  border="0" align="left" cellpadding="0" cellspacing="0"  id="duplicate" style="">
                                                <div class="form-group-md">
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Payment:</strong></td>
                                                        <td><input type="text" class="form-control" name="payment" style="width:100px; " id="payment" class="validate[required,custom[onlyFloat],lengthCheck[6]] text-input" onKeyUp="balanceCalc()"value="<?php
                                                            echo $db->queryUniqueValue("SELECT payment FROM stock_sales WHERE transactionid='$id'");
                                                            ?>"></td>
                                                        <td><div align="left"><strong>Description</strong></div></td>
                                                        <td rowspan="2"><textarea class="form-control" name="description" style="width:150px; height:70px; "><?php echo $db->queryUniqueValue("SELECT description FROM stock_sales WHERE transactionid='$id'"); ?></textarea></td>
                                                        <td><strong>Sub Total </strong></td>
                                                        <td>&nbsp;</td>
                                                        <td><input name="subtotal" class="form-control" id="subtotal" type="text" value="<?php
                                                            echo $db->queryUniqueValue("SELECT subtotal FROM stock_sales WHERE transactionid='$id'");?>" readonly="" style="width:100px; text-align:right; color:#333333; font-weight:bold; font-size:16px;"></td>
                                                        <td><img src="images/refresh.png" alt="Refresh" align="absmiddle" onClick="updateSubtotal()"></td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="105">&nbsp;</td>
                                                        <td width="105">&nbsp;</td>
                                                        <td width="105">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Balance:</strong></td>
                                                        <td><input name="balance" class="form-control" type="text" id="balance" style="width:100px; " value="<?php
                                                            echo $db->queryUniqueValue("SELECT balance FROM stock_sales WHERE transactionid='$id'");
                                                            ?>" readonly=""></td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td><div align="center"></div></td>
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
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="55"><strong>Mode:</strong></td>
                                                        <td >
                                                            <select class="btn btn-default dropdown-toggle" name="mode">
                                                                <option   value="cheque">Cheque</option>
                                                                <option value="cash" selected>Cash</option>
                                                                <option  value="others">others</option>
                                                            </select>
                                                        </td>
                                                        <td width="77"><strong>Due Date </strong></td>
                                                        <td width="195"><input type="text" class="form-control"  name="due" class="date_input" value="<?php echo date('d-m-Y');?>" style="width:100px;"></td>
                                                        <td width="77">&nbsp;</td>
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

                                                        <td><input type="submit" class="btn btn-primary" name="Submit" value="Update" onClick="updateSubtotal()" ></td>
                                                        <td>&nbsp;</td>
                                                        <td> <a href="view_stock_sales.php"><button class="btn btn-primary">Cancle </button></a></td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                </div>
                                            </table>
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
    </body>
    </html>
<?php
}
}
?>