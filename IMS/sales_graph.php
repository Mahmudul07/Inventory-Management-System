
<?php
$link = mysqli_connect('localhost','root','','stock');

//$db = mysql_connect("localhost","root","");
//mysql_select_db("stock",$db);

$meses = array('','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
for($x = 1;$x<=12;$x++){
    $month[$x] = 0;
}
$year = date('Y');
$sql = ("SELECT * FROM stock_sales");
$query=mysqli_query($link,$sql);

while($row = mysqli_fetch_array($query)){
    $y = date('Y',strtotime($row['date']));
    $mes = (int)date("m", strtotime($row['date']));
    if($y=$year){
        $month[$mes]= $month[$mes]+$row['amount'];
    }
}
//print_r($year);

?>



<html>
<head>
    <script type="text/javascript" src="ukk/loader.js"></script>
    <script type="text/javascript" src="ukk/my.js"></script>
    <script >
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Year', 'Sales'],
                <?php
                for($x = 1;$x<=12;$x++){
                ?>
                ['<?php echo $meses[$x]; ?>', <?php echo $month[$x] ?>],
                <?php
                }
                ?>
            ]);

            var options = {
                chart: {
                    title: 'Company Performance',
                    subtitle: 'Sales In the Year',
                }
            };


            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

            chart.draw(data, options);
        }
    </script>
</head>
<body>
<div id="columnchart_material" style="width: 800px; height: 500px;"></div>
<script type="text/javascript" src="ukk/loader.js"></script>
    <script type="text/javascript" src="ukk/my.js"></script>
</body>
</html>
