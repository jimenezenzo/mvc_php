google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawVisualization);

function drawVisualization() {

    var pathname = location.pathname;
    var id = pathname.substring(14);

    var jsonData = $.ajax({
        url: 'http://localhost/reporte/getDatosGrafica/'+id,
        method:"POST",
        dataType: "json",
        async: false
    }).responseText;

    var data =new  google.visualization.DataTable();
    data.addColumn('string', 'fecha');
    data.addColumn('number', 'Combustible');
    data.addColumn('number', 'Kilometros');
    $.each(JSON.parse(jsonData), function(i,jsonData)
    {
        var fecha=jsonData.fecha;
        var combustible=parseFloat(jsonData.combustible);
        var kilometros=parseFloat(jsonData.kilometros);
        data.addRows([ [fecha, combustible, kilometros]]);
    });

    var options = {
        title : 'Rendimiento del vehiculo por viajes',
        vAxis: {title: 'Kilometros y Combustible'},
        hAxis: {title: 'Fecha de Viajes'},
        seriesType: 'bars',
        series: {5: {type: 'line'}}
    };

    var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
    chart.draw(data, options);
}
