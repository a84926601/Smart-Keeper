$(document).ready(function() {
    draw_chart();
});

function timeConverter(UNIX_timestamp){
  var a = new Date(UNIX_timestamp * 1000);
  var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
  var year = a.getFullYear();
  var month = months[a.getMonth()];
  var date = a.getDate();
  var hour = a.getHours();
  var min = a.getMinutes();
  var sec = a.getSeconds();
  var time = (a.getMonth()+1) + '/' + date + ' ' + hour + ':' + min;
  return time;
}

function draw_chart(int lower,int upper)
{
    var combined = new Array();
    combined[0] = ['Time', 'Usage'];
    $.get("data", function(data){
        var json_verify
        var i=0
        while(json_verify=JSON.stringify(data[i]))
        {
            var data_parse = JSON.parse(json_verify)
            console.log(timeConverter(data_parse.time))
            var tim=timeConverter(data_parse.time)
            var pow=parseInt(data_parse.power)
            combined[i + 1] = [tim , pow]
            i++
        }
        console.log(combined)
        alert(i)
    });
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);
      function drawVisualization() {
        var data = google.visualization.arrayToDataTable(combined,false);
        var options = {
          title : 'Usage',
          vAxis: {title: 'Usage'},
          hAxis: {title: 'Time'},
          seriesType: 'bars',
          series: {5: {type: 'line'}}
        };
        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
  }
}