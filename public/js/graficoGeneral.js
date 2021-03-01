google.charts.load('current', {'packages':['table']});
google.charts.setOnLoadCallback(drawTable);

function drawTable() {

    var jsonData = $.ajax({
        url: 'http://localhost/reporte/getDatosGraficaGeneral',
        method:"POST",
        dataType: "json",
        async: false
    }).responseText;

    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Year');
    data.addColumn('string', 'Month');
    data.addColumn('number', 'Recaudado');
    $.each(JSON.parse(jsonData), function(i,jsonData)
    {
        var year=jsonData.anio;
        var month=jsonData.mes;
        var recaudado=parseFloat(jsonData.costo);
        data.addRows([ [year, month, recaudado]]);
    });

    var table = new google.visualization.Table(document.getElementById('table_div'));

    table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
}