<?php
session_start();
if(!isset($_SESSION['username']) || $_SESSION['usertype'] !='admin'){
header("location:indexx.php?msg=Please%20login%20to%20access%20admin%20area%20!");
}
else
{
	include_once "db/db.php";
	error_reporting (E_ALL ^ E_NOTICE);
	if(isset($_GET['sid']))
	{
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sales Print</title>
    <link rel="icon" href="Knight/favicon.png" type="image/png">
    <style type="text/css" media="print">
.hide{display:none}
</style>
<script type="text/javascript">
function printpage() {
document.getElementById('printButton').style.visibility="hidden";
window.print();
document.getElementById('printButton').style.visibility="visible";  
}
</script>
<style type="text/css">
.style1 {font-size: 10px}
</style>
</head>
<body>
<input name="print" type="button" value="Print" id="printButton" onClick="printpage()">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top">
	<table width="595"  cellspacing="0" cellpadding="0" id="bordertable"  border="1">
      <tr>
        <td align="center"><strong>Sales Receipt <br />
        </strong>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="67%" align="left" valign="top">&nbsp;&nbsp;&nbsp;Date: <?php
			  $sid=$_GET['sid'];
			$line = $db->queryUniqueObject("SELECT * FROM stock_sales WHERE transactionid='$sid' ");
			$mysqldate=$line->date;
 		$phpdate = strtotime( $mysqldate );
 		$phpdate = date("d/m/Y",$phpdate);
		echo $phpdate;
			  ?> <br />
                <br />
                <strong><br />
                &nbsp;&nbsp;&nbsp;Receipt No: <?php echo $sid; ?>
                </strong><br />
              </td>
              <td width="33%"><div align="center"><span class="style1"></span> <br />
                  <strong>UK Electronics LTD </strong><br />
                  Mirpur-2, <br />
                  Dhaka-1216<br />
                 <br />
              </div></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td height="90" align="left" valign="top"><br />
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="5%" align="left" valign="top"><strong>&nbsp;&nbsp;TO:</strong></td>
              <td width="95%" align="left" valign="top"><br />
              <?php 
				echo $line->customer_id;
				$cname=$line->customer_id;
				$line2 = $db->queryUniqueObject("SELECT * FROM customer_details WHERE customer_name='$cname'  " );
				?>
				<br />
				<?php
                echo $line2->customer_address."<br>";
				echo "Contact1: ".$line2->customer_contact1."<br>";
				echo "Contact1: ".$line2->customer_contact2."<br>";
				?></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="12%" align="center" bgcolor="#CCCCCC"><strong>No.</strong></td>
            <td width="22%" bgcolor="#CCCCCC"><strong>Stock</strong></td>
            <td width="18%" bgcolor="#CCCCCC"><strong>Quantity</strong></td>
            <td width="19%" bgcolor="#CCCCCC"><strong>Rate</strong></td>
            <td width="11%" bgcolor="#CCCCCC">&nbsp;</td>
            <td width="18%" bgcolor="#CCCCCC"><strong>Total</strong></td>
          </tr>
          <tr>
            <td align="center">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
		  <?php
		  $i=1;
		 $db->query("SELECT * FROM stock_sales where transactionid='$sid'");
while ($line3 = $db->fetchNextObject()) {
?>
          <tr>
            <td align="center"><?php echo $i."."; ?></td>
            <td><?php echo $line3->stock_name; ?></td>
            <td><?php echo $line3->quantity; ?></td>
            <td><?php echo $line3->selling_price; ?></td>
            <td>&nbsp;</td>
            <td><?php echo $line3->amount 	; ?></td>
          </tr>
		  
		  <?php
	$i++;	
	$subtotal=$line3->subtotal;  
	$payment=$line3->payment;
	$balance=$line3->balance;
	$date=$line->due;	    
}
		  ?>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td></td>
          </tr>
        </table></td>
      </tr>
	  <tr>
	  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="82%" align="right" bgcolor="#CCCCCC"><strong>SubTotal:&nbsp;&nbsp;</strong></td>
          <td width="18%" bgcolor="#CCCCCC"><?php echo $subtotal; ?>&nbsp;</td>
        </tr>
      </table>	  </td>
	  </tr>
      <tr>
        <td align="right"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="33%" align="left" valign="top"><br />
              <strong>&nbsp;&nbsp;Paid Amount :&nbsp;&nbsp;<?php echo $payment; ?><br />
              &nbsp;&nbsp;Due Balance &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;:&nbsp;&nbsp;<?php echo $balance; ?><br />
              &nbsp;&nbsp;Due Date&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;: <?php if($balance == 0) {
			  $mysqldate=$line->due;
 		$phpdate = strtotime( $mysqldate );
 		$phpdate = date("d/m/Y",$phpdate);}
		echo $phpdate;?> <br />
              </strong> </td>
            <td width="67%" align="right"><br />
              <br />
              <br />
              Signature&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
          </tr>
        </table>
        </td>
      </tr>

    </table></td>
  </tr>
</table>


</body>
</html>
<?php
}
else "Error in processing printing the sales receipt";
}
?>