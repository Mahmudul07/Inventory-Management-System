<?php
session_start();
if(!isset($_SESSION['username']) || $_SESSION['usertype'] !='admin'){
header("location:index.php?msg=Please%20login%20to%20access%20admin%20area%20!");
}
else
{
	include_once "db/db.php";
	error_reporting (E_ALL ^ E_NOTICE);
	if(isset($_GET['id']) && isset($_GET['table']))
	{
	$id=$_GET['id'];
	$tablename=$_GET['table'];
	$return=$_GET['return'];
	if($tablename=="stock_entries")
	{			
				$difference=$db->queryUniqueValue("SELECT quantity FROM stock_entries WHERE id=$id");
				$name=$db->queryUniqueValue("SELECT stock_name FROM stock_entries WHERE id=$id");
				$result=$db->query("SELECT * FROM stock_entries where id > $id");
				while ($line2 = $db->fetchNextObject($result)) {
				$osd=$line2->opening_stock - $difference;
				$csd=$line2->closing_stock - $difference;
				$cid=$line2->id;
				$db->execute("UPDATE stock_entries SET opening_stock=".$osd.",closing_stock=".$csd." WHERE id=$cid");
				}
				$total = $db->queryUniqueValue("SELECT quantity FROM stock_avail WHERE name='$name'");
				$total = $total - $difference;
				$db->execute("UPDATE stock_avail SET quantity=$total WHERE name='$name'");
	}
	if($tablename=="stock_sales")
	{			$difference=$db->queryUniqueValue("SELECT quantity FROM stock_sales WHERE id=$id");	
				$sid=$db->queryUniqueValue("SELECT transactionid FROM stock_sales WHERE id=$id");
				$id=$db->queryUniqueValue("SELECT id FROM stock_entries WHERE salesid='$sid'");
				$name=$db->queryUniqueValue("SELECT stock_name FROM stock_entries WHERE id=$id");
				$result=$db->query("SELECT * FROM stock_entries where id > $id");
				while ($line2 = $db->fetchNextObject($result)) {
				$osd=$line2->opening_stock + $difference;
				$csd=$line2->closing_stock + $difference;
				$cid=$line2->id;
				$db->execute("UPDATE stock_entries SET opening_stock=".$osd.",closing_stock=".$csd." WHERE id=$cid");
				}
				echo "sale $name";
				$total = $db->queryUniqueValue("SELECT quantity FROM stock_avail WHERE name='$name'");
				$total = $total + $difference;
				$db->execute("UPDATE stock_avail SET quantity=$total WHERE name='$name'");
				$db->execute("DELETE FROM $tablename WHERE id=$id");
	}
	$id=$_GET['id'];
	$db->execute("DELETE FROM $tablename WHERE id=$id");
	header("location:$return?msg=Record Deleted Successfully!&id=$id");
	}
}
?>