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
                $("#supplier").autocomplete("supplier1.php", {
                    width: 160,
                    autoFill: true,
                    mustMatch: true,
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
                for (i=0;i<=400;i=i+6)
                {
                    if($("#0"+i).length>0)
                    {		$k=0;
                        for (j=0;j<=400;j=j+6)
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
                var brate1 =  quantity1+1;
                var srate1 =  brate1+1;
                var avail1 = srate1+1;
                var total1 = avail1+1;
                if(parseInt(idname)>0)
                {
                    quantity1="00"+quantity1;
                    brate1="000"+brate1;
                    srate1="0000"+srate1;
                    avail1="00000"+avail1;
                    total1="000000"+total1;
                }
                else
                {
                    quantity1="00";
                    brate1="000";
                    srate1="0000";
                    avail1="00000";
                    total1="000000";
                }
                $.post('check_stock_details.php', {stock_name: $("#"+idname).val() },
                    function(data){
                        $("#"+brate1).val(data.buyingrate);
                        $("#"+srate1).val(data.sellingprice);
                        $("#"+avail1).val(data.available);
                        $("#quantity").focus();
                    }, 'json');
                checkDublicateName();

            }
            function callQKeyUp(Qidname)
            {
                var quantity = parseInt(Qidname,10);
                var brate =  quantity+1;
                var srate =  brate+1;
                var avail = srate+1;
                var total = avail+1;
                var rowcount = parseInt((total+1)/5);
                if(rowcount==0)
                    rowcount=1;

                if(parseInt(Qidname)>0)
                {
                    quantity="00"+quantity;
                    brate="000"+brate;
                    srate="0000"+srate;
                    avail="00000"+avail;
                    total="000000"+total
                }
                else
                {
                    quantity="00";
                    brate="000";
                    srate="0000";
                    avail="00000";
                    total="000000";
                }
                var result= parseFloat($("#"+quantity).val()) * parseFloat( $("#"+brate).val() );
                result=result.toFixed(2);
                $("#"+total).val(result);
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
                for (i=5;i<=400;i=i+6)
                {
                    if($("#000000"+i).length>0)
                    {
                        temp=parseFloat(temp)+parseFloat($("#000000"+i).val());
                    }
                }
                var subtotal=parseFloat(temp);

                if($("#000000").length>0)
                {
                    var firstrowvalue=$("#000000").val();
                    subtotal=parseFloat(subtotal)+parseFloat(firstrowvalue);
                }
                subtotal=subtotal.toFixed(2);
                $("#subtotal").val(subtotal);
            }

            function callRKeyUp(Ridname)
            {
                var brate = parseInt(Ridname,10);
                var quantity =  brate-1;
                var srate =  brate+1;
                var avail = srate+1;
                var total = avail+1;
                callQKeyUp(brate-1)

            }
            $(document).ready(function() {
                // SUCCESS AJAX CALL, replace "success: false," by:success : function() { callSuccessFunction() },
                $("#billnumber").focus();
                $("#supplier").blur(function()
                {
                    $.post('check_supplier_details.php',{stock_name1: $(this).val() },
                        function(data){
                            $("#address").val(data.address);
                            $("#contact1").val(data.contact1);
                            $("#contact2").val(data.contact2);
                            if(data.address!=undefined)
                                $("#0").focus();

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
                                <h1 class="panel-title">Add Purchases Stock</h1>
                            </div>
                            <div class="panel-body">
                                <div class="row">

                                    <?php
                                    if(isset($_POST['name']))
                                    {
                                        $billnumber=mysql_real_escape_string($_POST['billnumber']);
                                        $autoid=mysql_real_escape_string($_POST['id']);
                                        $supplier=mysql_real_escape_string($_POST['supplier']);
                                        $address=mysql_real_escape_string($_POST['address1']);
                                        $contact1=mysql_real_escape_string($_POST['contact1']);
                                        $contact2=mysql_real_escape_string($_POST['contact2']);
                                        $payment=mysql_real_escape_string($_POST['payment']);
                                        $balance=mysql_real_escape_string($_POST['balance']);
                                        $temp_balance = $db->queryUniqueValue("SELECT balance FROM supplier_details WHERE supplier_name='$supplier'");
                                        $temp_balance = (int) $temp_balance + (int) $balance;
                                        $db->execute("UPDATE supplier_details SET balance=$temp_balance WHERE supplier_name='$supplier'");
                                        $selected_date=$_POST['due'];
                                        $selected_date=strtotime( $selected_date );
                                        $mysqldate = date( 'Y-m-d H:i:s', $selected_date );
                                        $due=$mysqldate;
                                        $mode=mysql_real_escape_string($_POST['mode']);
                                        $description=mysql_real_escape_string($_POST['description']);
                                        $namet=$_POST['name'];
                                        $quantityt=$_POST['quanitity'];
                                        $bratet=$_POST['brate'];
                                        $sratet=$_POST['srate'];
                                        $totalt=$_POST['total'];
                                        $subtotal=mysql_real_escape_string($_POST['subtotal']);
                                        $username=$_SESSION['username'];
                                        $i=0;
                                        $j=1;
                                        $username = $_SESSION['username'];
                                        $max = $db->maxOfAll("id", "stock_details");
                                        $max=$max+1;
                                        $autoid="SD".$max."";
                                        $max1 = $db->maxOfAll("id", "stock_entries");
                                        $max1=$max1+1;
                                        $autoid1="SE".$max1."";
                                        $selected_date=$_POST['date'];
                                        $selected_date=strtotime( $selected_date );
                                        $mysqldate = date( 'Y-m-d H:i:s', $selected_date );
                                        foreach($namet as $name1)
                                        {
                                            $quantity=$_POST['quantity'][$i];
                                            $brate=$_POST['brate'][$i];
                                            $srate=$_POST['srate'][$i];
                                            $total=$_POST['total'][$i];
                                            $count = $db->countOf("stock_avail", "name='$name1'");
                                            if($count == 0)
                                            {
                                                $db->query("insert into stock_avail(name,quantity) values('$name1',$quantity)");
                                                echo "<br><font color=green size=+1 >New Stock Entry Inserted !</font>" ;
                                                $db->query("insert into stock_details(stock_id,stock_name,stock_quatity,supplier_id,company_price,selling_price) values('$autoid','$name1',0,'$suplier',$brate,$srate)");
                                                $db->query("INSERT INTO stock_entries(stock_id,stock_name, stock_supplier_name, quantity, company_price, selling_price, opening_stock, closing_stock, date, username, type, total, payment, balance, mode, description, due, subtotal,count1,billnumber) VALUES ( '$autoid1','$name1','$supplier',$quantity,$brate,$srate,0,$quantity,'$mysqldate','$username','entry',$total,$payment,$balance,'$mode','$description','$due',$subtotal,$j,'$billnumber')");
                                            }
                                            else if($count==1)
                                            {
                                                $amount = $db->queryUniqueValue("SELECT quantity FROM stock_avail WHERE name='$name1'");
                                                $amount1 = $amount + $quantity;
                                                $db->execute("UPDATE stock_avail SET quantity=$amount1 WHERE name='$name1'");
                                                $db->query("INSERT INTO stock_entries(stock_id,stock_name,stock_supplier_name,quantity,company_price,selling_price,opening_stock,closing_stock,date,username,type,total,payment,balance,mode,description,due,subtotal,count1,billnumber) VALUES ('$autoid1','$name1','$supplier',$quantity,$brate,$srate,$amount,$amount1,'$mysqldate','$username','entry',$total,$payment,$balance,'$mode','$description','$due',$subtotal,$j,'$billnumber')");

                                            }
                                            $i++;
                                            $j++;
                                        }

                                        echo "<meta http-equiv='refresh' content='0;url=view_stock_entries.php'>";
                                      //  echo "<br><font color=green size=+1 >Parchase order placed successfully Ref: [ $autoid1] !</font>" ;
                                    }
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
                                                        $autoid="PR".$max."";
                                                        ?>
                                                        <td> <input class="form-control" name="id" type="text" id="id" readonly="" value="<?php echo $autoid; ?>" style="width:90px;" required></td>
                                                        <td>&nbsp;</td>
                                                        <td><strong>Date</strong></td>
                                                        <td><input class="form-control" type="text" id="datefield" name="date" class="date_input" value="<?php echo date('d-m-Y');?>" style="width:100px;"></td>
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
                                                        <td><strong>Bill No</strong></td>
                                                        <td><input class="form-control" type="text" name="billnumber" style="width:100px;" id="billnumber"  class="validate[required,length[0,100]] text-input" required></td>
                                                        <td>&nbsp;</td>
                                                        <td><strong>Supplier</strong></td>
                                                        <td><input class="form-control" name="supplier" type="text" id="supplier"  value="" style="width:100px;" autocomplete="off" required></td>
                                                        <td>&nbsp;</td>
                                                        <td><strong>Address</strong></td>
                                                        <td><textarea class="form-control" name="address1" id="address" style="width:100px;"></textarea></td>
                                                        <td>&nbsp;</td>
                                                        <td>
                                                            <strong>Contact1</strong>
                                                            <br><br><br>
                                                            <strong>Contact2</strong>
                                                        </td>
                                                        <td><input name="contact1" class="form-control" type="text" id="contact1"  value="" style="width:100px;">
                                                            <br>
                                                            <input name="contact2" class="form-control" type="text" id="contact2"  value="" style="width:100px;" >
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

                                                <tr>
                                                    <div class="form-group-md" align="right">
                                                        <td ><div align="left"><strong>Name</strong></div></td>
                                                        <td ><input name="name[]" class="form-control" type="text"  id="0" style="width:120px;" onFocus="callAutoComplete(this.id)"  onBlur="callAutoAsignValue(this.id)" autocomplete="off"></td>
                                                        <td><div align="right"><strong>Qty</strong></div></td>
                                                        <td><input name="quantity[]" class="form-control" type="text" id="00" style="width:50px;" onKeyUp="callQKeyUp(this.id)"></td>
                                                        <td><div align="left"><strong>Buy Rate:</strong></div></td>
                                                        <td><input name="brate[]" class="form-control" type="text" id="000" style="width:80px;" onKeyUp="callRKeyUp(this.id)"  ></td>
                                                        <td><strong>Sales Rate</strong> </td>
                                                        <td><input name="srate[]" class="form-control" type="text" id="0000" style="width:80px;"  ></td>
                                                        <td><strong>Avail Qty</strong></td>
                                                        <td><input name="avail[]" class="form-control" type="text" id="00000" readonly="" value="" style="width:50px;" ></td>
                                                        <td><div align="left"><strong>Total:</strong></div></td>
                                                        <td><input name="total[]" class="form-control" type="text" id="000000" readonly="" value="" style="width:120px;text-align:right;" >  </td>
                                                        <td width="50"><p><span><a id="minus" href=""  >[-]</a> <a id="plus" href="">[+]</a></span></p></td>
                                                    </div>
                                                </tr>
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
                                                        <td><input type="text" class="form-control" name="payment" style="width:100px; " id="payment" class="validate[required,custom[onlyFloat],lengthCheck[6]] text-input" onKeyUp="balanceCalc()"></td>
                                                        <td><div align="left"><strong>Description</strong></div></td>
                                                        <td rowspan="2"><textarea class="form-control" name="description" style="width:150px; height:70px; "></textarea></td>

                                                        <td><strong>Sub Total </strong></td>
                                                        <td>&nbsp;</td>
                                                        <td><input name="subtotal" class="form-control" id="subtotal" type="text" readonly="" style="width:100px; text-align:right; color:#333333; font-weight:bold; font-size:16px;"></td>
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
                                                        <td><input name="balance" class="form-control" type="text" id="balance" style="width:100px; " value="0.00" readonly=""></td>
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
                                                        <td><div align="center">
                                                               <input class="btn btn-primary" type="reset" name="Reset" value="Reset">
                                                            </div></td>
                                                        <td>&nbsp;</td>
                                                        <td><input type="submit" class="btn btn-primary" name="Submit" value="Save" onClick="updateSubtotal()" ></td>
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
            <span class="COPYRIGHT">Copyright © SCDB | <a href="#">Inventory Management System</a> </span>
        </div>
    </footer>

    </body>
    </html>
    <?php
}

?>