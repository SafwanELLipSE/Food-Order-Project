
$(document).ready(function(){
	$.ajax({
		url: "http://localhost/sadlife/admin_area/functions/function.php",
		method: "GET",
		success: function(data) {
			console.log(data);
			var countCategory() = [];
			var countMenu() =[];

	/*	y2015.push("y2015"+ sum(y2015));
			y2016.push("y2016"+ sum(y2016));
			y2017.push("y2017"+ sum(y2017));
			y2018.push("y2018"+ sum(y2018));
*/
			for(var i in data) {
				y2015.push("y2015 " + data[i].y2015);
			}
				
		

			var chartdata = {
				labels: ['y2015','y2016'],
				datasets : [
					{
						labels:['Year wise selected students @ NSU'],
						backgroundColor: 'rgba(200, 200, 200, 0.75)',
						borderColor: 'rgba(200, 200, 200, 0.75)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data:[
						countCategory(),countMenu(),y2017,y2018
					],
					}
				]
			};

			var ctx = $("#myChart");

			var lineGraph = new Chart(ctx, {
				type: 'bar',
				data: chartdata
			});
		},
		error: function(data) {
			console.log(data);
		}
	});
});