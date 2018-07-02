google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(draw_chart);
$(document).ready(function() {
year_init();
month_init(1);
month_init(2);
day_init(1);
day_init(2);
/*draw_chart(1,1,0,42364183353);
draw_chart(1,1,0,4236418335);*/
});

function _search()
{
	draw_chart(1,1,0,42364183353)
}

function year_init()
{
    var d=new Date();
    var y=d.getFullYear();
    var yy
    for(var i=y;i>=(y-10);i--)
    {
        if(i!=y)
        {
            yy=yy+"<option value='"+i+"'>"+i+"年</option>"
        }
        else
        {
            yy=yy+"<option value='"+i+"' selected='selected'>"+i+"年</option>"
        }
    }
    document.getElementById("Year1").innerHTML=yy;
    document.getElementById("Year2").innerHTML=yy;
}


function month_init(_id)
{
    var d=new Date();
    var m=d.getMonth()+1;
    document.getElementById("Month"+_id).style.display="block";
    var mm
    for(var i=1;i<=12;i++)
    {
        if(m==i)
            mm=mm+"<option value='"+i+"' selected='selected'>"+i+"月</option>"
        else
            mm=mm+"<option value='"+i+"'>"+i+"月</option>"
    }
    document.getElementById("Month"+_id).innerHTML=mm;
}

function day_init(_id)
{
    document.getElementById("Day"+_id).style.display="block";
    var d=new Date();
    var da=d.getDate();
    var dd
    var last_day
    var y=document.getElementById("Year"+_id).value;
    var m=document.getElementById("Month"+_id).value;
    var days=[31,28,31,30,31,30,31,31,30,31,30,31]
    if((y%4)==0)
    {
        if(m==2)
        {
            last_day=29
        }
        else
        {
            if((m-1)!=-1)
                last_day=days[m-1];
        }
    }
    else
    {
        if(m==2)
        {
            last_day=28
        }
        else
        {
            last_day=days[m-1];
        }
    }
    for(var i=1;i<=last_day;i++)
    {
        if(i==da)
            dd=dd+"<option value='"+i+"' selected='selected'>"+i+"日</option>"
        else
            dd=dd+"<option value='"+i+"'>"+i+"日</option>"
    }
    document.getElementById("Day"+_id).innerHTML=dd;
}

function timeConverter(UNIX_timestamp)
{
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

function draw_chart(id , type , lower , upper)
{
	id=id==null?1:id;
	type=type==null?1:type;
	lower=lower==null?0:lower;
	upper=upper==null?42364183353:upper;
    var combined = new Array;
	combined.push(["Time","Usage"])
    $.get("data", function(data){
        var json_verify
        var i=0
        while(json_verify=JSON.stringify(data[i]))
        {
            var data_parse = JSON.parse(json_verify)
            if((data_parse.time>=lower)&&(data_parse.time<=upper))
            {
                var tim=timeConverter(data_parse.time)
                var pow=parseInt(data_parse.power)
                combined.push([tim , pow])
            }
            i++
        }
		console.log(combined)
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
    });

	
}