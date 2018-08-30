<?php
session_start(); 
if(!isset($_SESSION['username']) || $_SESSION['usertype'] !='admin'){ 
header("location:indexx.php?msg=Please%20login%20to%20access%20admin%20area%20!"); 
}
else
{
	include_once "db.php"; 

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>Inventory Management System !</title>
    <link rel="icon" href="Knight/favicon.png" type="image/png">

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css" media="screen" title="no title" charset="utf-8" />
		<link rel="stylesheet" href="css/template.css" type="text/css" media="screen" title="no title" charset="utf-8" />
		<script src="js/jquery.min.js" type="text/javascript"></script>
		
		<script type='text/javascript' src='lib/jquery.bgiframe.min.js'></script>
<script type='text/javascript' src='lib/jquery.ajaxQueue.js'></script>
<script type='text/javascript' src='lib/thickbox-compressed.js'></script>
<script type='text/javascript' src='js/jquery.autocomplete.js'></script>
<script type='text/javascript' src='js/localdata.js'></script>

<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />
<link rel="stylesheet" type="text/css" href="lib/thickbox.css" />
	
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
	


	$("#singleBirdRemote").autocomplete("search.php", {
		width: 160,
		autoFill: true,
		selectFirst: false
	});
	$("#suplier").autocomplete("search.php", {
		width: 160,
		autoFill: true,
		selectFirst: false
	});
	$("#uom").autocomplete("search.php", {
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


<body>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ECECEC">
                            <tr>
                                <?php
                                include "banner.php";
                                ?>
                            </tr>
                            <tr>
                                <td height="500" align="center" valign="top"><table width="96%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ECECEC">
                                        <tr>
                                            <td width="130" align="left" valign="top">

                                                <br>
                                                <br>
                                                <br>

<table width="100%"  border="0" cellspacing="0" cellpadding="0">

    <?php
    include "link.php";
    ?>


    <tr>
    <td align="center">&nbsp;</td>
    </tr>
  <tr>
    <td align="center">&nbsp;</td>
    </tr>
  <tr>
    <td align="center">&nbsp;</td>
    </tr>
</table>


	<div id="vertmenu">
<h1>Options</h1>
<ul>
<li><a href="admin.php" tabindex="1">Admin Home</a></li>
<li><a href="add_purchase.php" tabindex="2">Add Stock Entry</a></li>
<li><a href="add_stock_sales.php" tabindex="3">AddStock Sales</a></li>
<li><a href="add_stock_details.php" tabindex="4">Add Stock Details</a></li>
<li><a href="add_category.php" tabindex="5">Add Catetogry</a></li>
<li><a href="add_supplier_details.php" tabindex="6">Add Supplier Details</a></li>
<li><a href="add_customers_details.php" tabindex="7">Add Customer Details</a></li>

<li><a href="view_stock_entries.php" tabindex="8">V<iew Stock Entries/a></li>
<li><a href="view_stock_sales.php" tabindex="9">View Stock Sales</a></li>
<li><a href="view_stock_details.php" tabindex="10">View Stock Details</a></li>
<li><a href="view_supplier_details.php" tabindex="11">View Supplier Details</a></li>
<li><a href="view_customer_details.php" tabindex="12">View Customer Details</a></li>

<li><a href="report.php" tabindex="13">Report</a></li>
<li><a href="logout.php" tabindex="14">Signout</a></li>
</ul>
</div>
				
				
				</td> <td height="500" align="center" valign="top">


                      <?php
                      include "llink.php";

                      ?>

<?php
				if(isset($_POST['name']))

            {
			
			$id=mysql_real_escape_string($_POST['id']);
			$name=mysql_real_escape_string($_POST['name']);
			$category=mysql_real_escape_string($_POST['category']);
			$buyingrate=mysql_real_escape_string($_POST['buyingrate']);
			$sellingrate=mysql_real_escape_string($_POST['sellingrate']);
			$suplier=mysql_real_escape_string($_POST['suplier']);
			$uom=mysql_real_escape_string($_POST['uom']);
			$expiry=mysql_real_escape_string($_POST['expiry']);
			$count = $db->countOf("stock_details", "stock_id='$id'");
		if($count==1)
			{
		echo "<font color=red> Dublicat Entry. Please Verify</font>";
			}
			else
			{
				
			if($db->query("insert into stock_details(stock_id,stock_name,stock_quatity,supplier_id,company_price,selling_price,category,expire_date,uom) values('$id','$name',0,'$suplier',$buyingrate,$sellingrate,'$category','$expiry','$uom')"))
			echo "<br><font color=green size=+1 >Stock Details Added !</font>" ;
			else
			echo "<br><font color=red size=+1 >Problem in Adding !</font>" ;
			
			}
			
			
			}
				
				?>
				
				<br>
<br>

				
				<form name="form1" method="post" id="form1" action="">
                  
                 <h2> <p align="center"><strong>Add New Stock Details </strong></p></h2>
                  <table width="300"  border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="150">&nbsp;</td>
                      <td width="150">&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="150">&nbsp;</td>
                      <td width="150">&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="150">ID</td>
                      <td width="150"><input name="id" type="text" id="id" ></td>
                    </tr>
                    <tr>
                      <td width="150">&nbsp;</td>
                      <td width="150">&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="150">Name</td>
                      <td width="150"><input name="name" type="text" id="name" class="validate[required,length[0,100]] text-input"></td>
                    </tr>
                    <tr>
                      <td width="150">&nbsp;</td>
                      <td width="150">&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="150">Category</td>
                      <td width="150"><input name="category" type="text" id="singleBirdRemote"></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>Buying Rate</td>
                      <td><input name="buyingrate" type="text" id="buyingrate"  class="validate[required,custom[onlyNumber],lengthCheck[6]] text-input" ></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>Selling Rate </td>
                      <td><input name="sellingrate" type="text" id="sellingrate"  class="validate[required,custom[onlyNumber],lengthCheck[6]] text-input" ></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>Suplier Name</td>
                      <td><input name="suplier" type="text" id="suplier" class="validate[optional,length[0,100]] text-input"></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>UOM</td>
                      <td><input name="uom" type="text" id="uom" class="validate[optional,length[0,100]] text-input"></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>Expiry Date </td>
                      <td><input name="expiry" type="text" id="expiry" class="validate[optional,length[0,100]] text-input" ></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="right"><input type="reset" name="Reset" value="Reset">                     &nbsp;&nbsp;&nbsp;</td>
                      <td>                        &nbsp;&nbsp;&nbsp;
                        <input type="submit" name="Submit" value="Save"></td>
                    </tr>
                    <tr>
                      <td align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                      <td align="left"> &nbsp;&nbsp;</td>
                    </tr>
                  </table>
                </form></td>
              </tr>
            </table>
                                    <?php
                                    include "footer.php";
                                    ?>
		</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>

</body>
</html>
<?php
}
?>