
$(document).ready(function(){
	$.ajax({
		url: "http://localhost/IMS/graph/data.php",
		method: "GET",
		success: function(data) {
			console.log(data);
			var quantity = [];
			var name = [];

			for(var i in data) {
				name.push("" + data[i]. name);
				quantity.push(data[i]. quantity);
			}

			var chartdata = {
				labels: name,
				datasets: [
					{
						label: 'Total ',
						backgroundColor: 'rgba(32, 92, 202,1)',
						borderColor: 'rgba(32, 92, 202, 1)',
						hoverBackgroundColor: 'rgba(32, 92, 202, 0.93)',
						hoverBorderColor: 'rgba(32, 92, 202,1)',
						data: quantity
					}
				]
			};

			var ctx = $("#mycanvas");

			var barGraph = new Chart(ctx, {
				type: 'bar',
				data: chartdata
			});
		},
		error: function(data) {
			console.log(data);
		}
	});
});