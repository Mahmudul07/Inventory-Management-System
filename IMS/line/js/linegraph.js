$(document).ready(function(){
    $.ajax({
        url : "http://localhost/IMS/line/flowersdata.php",
        type : "GET",
        success : function(data){
            console.log(data);

            var stock_name = [];
            var company_price = [];
            var selling_price = [];

            for(var i in data) {
                stock_name.push( data[i].stock_name);

                company_price.push(data[i].company_price);
                selling_price.push(data[i].selling_price);
            }

            var chartdata = {
                labels: stock_name,
                datasets: [

                    {
                        label: "Company Price",
                        fill: false,
                        lineTension: 0.1,
                        backgroundColor: "rgba(29, 202, 255, 0.75)",
                        borderColor: "rgba(29, 202, 255, 1)",
                        pointHoverBackgroundColor: "rgba(29, 202, 255, 1)",
                        pointHoverBorderColor: "rgba(29, 202, 255, 1)",
                        data: company_price
                    },
                    {
                        label: "Selling price",
                        fill: false,
                        lineTension: 0.1,
                        backgroundColor: "rgba(211, 72, 54, 0.75)",
                        borderColor: "rgba(211, 72, 54, 1)",
                        pointHoverBackgroundColor: "rgba(211, 72, 54, 1)",
                        pointHoverBorderColor: "rgba(211, 72, 54, 1)",
                        data: selling_price
                    }
                ]
            };

            var ctx = $("#myycanvas");

            var LineGraph = new Chart(ctx, {
                type: 'line',
                data: chartdata
            });
        },
        error : function(data) {

        }
    });
});