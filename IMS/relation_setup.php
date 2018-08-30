<?php
include_once "db/db.php";
error_reporting(E_ALL ^ E_NOTICE);

$from_month = explode( '/', $_POST["from_month"] );
$to_month = explode( '/', $_POST["to_month"] );


$fromMonth = $from_month[1].'-'.$from_month[0];
$toMonth = $to_month[1].'-'.$to_month[0];


$sql = "SELECT sum((sts.`selling_price`*sts.`quantity`) - (std.`company_price` * sts.`quantity`)) as profit, MONTHNAME(STR_TO_DATE(MONTH(sts.`date`), '%m'))
as month FROM `stock_sales` as sts INNER join `stock_details` as std on sts.stock_name = std.stock_name WHERE DATE_FORMAT(sts.`date`, \"%Y-%m\")
<= '$toMonth'  AND DATE_FORMAT(sts.`date`, \" % Y -%m\") <= '$fromMonth' GROUP BY MONTH(sts.`date`)";
$query = mysql_query($sql);

?>

<table class="table table-bordered table-hover table-striped">
    <thead>
    <tr>
        <th>Sl No</th>
        <th>Months</th>
        <th>Profit</th>
    </tr>
    </thead>
    <tbody>
    <?php

    $sl = 1;
    $gandProfit = 0;
    $payment = 10;

    while($row = mysql_fetch_array($query)){
        ?>
        <tr>
            <td><?php echo $sl;?></td>
            <td><?php echo $row['month'];?></td>
            <td><?php echo number_format($row['profit'],2);?></td>
        </tr>
        <?php
        $gandProfit +=$row['profit'];
        $sl++;
    }//while
    ?>
    <tr>
        <td colspan="2" style="text-align: right;">Total</td>
        <td><?php echo number_format($gandProfit,2);?></td>

    </tr>
    </tbody>
</table>


