$(document).ready(function () {

    // Load the Visualization API and the corechart package.
    google.charts.load('current', {'packages':['corechart']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawChart);

    drawChart();
});

function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ['Year', 'Sales', 'Expenses'],
        ['2013',  1000,      400],
        ['2014',  1170,      460],
        ['2015',  660,       1120],
        ['2016',  1030,      540]
    ]);

    var options = {
        title: 'Company Performance',
        hAxis: {title: 'Year',  titleTextStyle: {color: '#000'}},
        vAxis: {minValue: 0},
        backgroundColor: 'white',
        height: 400
    };

    var chart = new google.visualization.AreaChart(document.getElementById('large-chart'));
    chart.draw(data, options);
}