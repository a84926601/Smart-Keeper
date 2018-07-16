var init_count_status=0;
var init_count_chart=0;
var upper
var lower
var _type = 0;
var switch_pid;
var mychart_id = -1;
function init(up,lo)
{
    upper=up;
    lower=lo;
    var str="".concat(upper,",",lower,",",mychart_id,",",_type);
    var socket = io.connect('http://140.125.33.31:8080');
    socket.emit('Data',str);
    document.getElementById("chart_div").innerHTML="<canvas id='myChart'>"
        socket.on('Data',function(data){
	    if(init_count_chart==0)
	    {
		draw_statistics_table(upper,lower,data);
		draw_chart(upper,lower,data,0);
	    }
	    init_count_chart++;
        });
	socket.on('Data2',function(data){
            if(init_count_status==0)
            {
                draw_chart(upper,lower,data,1);
            }
            init_count_status++;
	});
	socket.emit('ID',"GET ALL ID");
	socket.on('ID',function(data){
		var str="<option value='-1' selected='selected'>ALL</option>";
		for(var key in data)
		{
			if(data[key]._pid==mychart_id)
				str+="<option value="+data[key]._pid+" selected='selected'>"+data[key]._pid+"</option>";
			else
				str+="<option value="+data[key]._pid+">"+data[key]._pid+"</option>";
		}
		document.getElementById('_id').innerHTML=str;
	});
    var tim="".concat(timeConverter_easy(lower),"~",timeConverter_easy(upper));
    document.getElementById('show_tim').innerHTML=tim;
    year_init();
    month_init(1);
    month_init(2);
    day_init(1);
    day_init(2);
    year_ini();
    mon_ini();
    day_ini();
}
function draw_statistics_table(up,lo,data)
{
        var days=(up-lo)/86400;
	var data_count=0;
        var div_content="<table><tr><td>ID</td><td>Time</td><td>Usage(kWh)</td></tr>";
        for(var key in data)
        {
                div_content+="<tr><td>"+data[key]._pid+"</td><td>"+timeConverter_easy(data[key]._time)+"</td><td>"+data[key]._usage+"</td></tr>";
		data_count++;
        }
	if(data_count==0)
	{
		div_content+="<tr><td colspan='5'>No Data</td></tr>";
	}
	div_content+="</table>";
        document.getElementById('statistics_div').innerHTML=div_content;
	
}

function draw_chart(up,lo,data,chart_id)
{
	var days=(up-lo)/86400;
	var day_arr=[];
	var data_arr=[];
        var div_content="<table><tr><td>Date</td><td>ID</td><td>Usage(kWh)</td></tr>";
	for(var i=0;i<days;i++)
	{
		var t=(lo*1)+(i*86400);
		day_arr.push(timeConverter_easy(t));
	}
	var which_id=-1;
	var tmp=new Object();
	var tmp_arr=[];
	var data_count=0;
        for(var key in data)
	{
		var index=Math.floor((data[key]._time-lo)/86400);
		while(which_id!=data[key]._pid)
		{
			if(JSON.stringify(tmp)!=='{}')
			{
				tmp.data=tmp_arr;
				data_arr[data_count]=tmp;
				data_count++;
			}
			which_id++;
			tmp=new Object();
		}
		if(JSON.stringify(tmp)==='{}')
		{
			tmp_arr=[];
			tmp.label=data[key]._pid;
			var color="rgb(".concat(Math.floor(Math.random()*256),",",Math.floor(Math.random()*256),",",Math.floor(Math.random()*256),")");
			tmp.borderColor=color;
			for(var i=0;i<days;i++)
			{
				tmp_arr.push(0);
			}
		}
		tmp_arr[index]=data[key]._usage;
	}
	if(JSON.stringify(tmp)!=='{}')
        {
           tmp.data=tmp_arr;
           data_arr[data_count]=tmp;
	   data_count++;
        }
	var ctx;
	if(chart_id==0)
	{
		ctx = document.getElementById('myChart').getContext('2d');
	}
	else
	{
		ctx = document.getElementById('Chart').getContext('2d');
	}
	var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: day_arr,
            datasets: data_arr,
        },

        // Configuration options go here
        options: {
		responsive: true,
		title: {
	                display: false,
        	        text: ''
            	},
		scales: {
                xAxes: [{
                	    display: true,
        	            scaleLabel: {
	                        display: true,
        	                labelString: 'Time'
	                    }
	                }],
	        yAxes: [{
        	            display: true,
	                    scaleLabel: {
                	        display: true,
        	                labelString: 'Usage(kWh)'
	                    }
                	}]
            	}
	}
    });
}

function on_off(pid)
{
	var socket = io.connect('http://140.125.33.31:8080');
	var switch_status=document.getElementById('switch'+pid).checked;
	switch_pid=pid;
	var str="".concat(upper,",",lower,",",switch_pid,",",_type);
	socket.emit('Data2',str);
	$("#all").show(0);
	$("#cover").show(400);
	if(switch_status==true)
	{
		//device on
		document.getElementById("on_off").innerHTML="<input class='btn' type='button' value='Turn On later' onclick='turn_on_off(1,1)'><input class='btn' type='button' value='Turn on now' onclick='turn_on_off(0,1)'>";
	}
	else
	{
		//device off
		document.getElementById("on_off").innerHTML="<input class='btn' type='button' value='Turn Off later' onclick='turn_on_off(1,0)'><input class='btn' type='button' value='Turn off now' onclick='turn_on_off(0,0)'>";
	}
}

function turn_on_off(now_or_later,method)
{
	var socket = io.connect('http://140.125.33.31:8080');
	var year = document.getElementById('Year').value;
	var month = document.getElementById('Month').value;
	var day = document.getElementById('Day').value;
	var hour = document.getElementById('Hour').value;
	var min = document.getElementById('Min').value;
	var tt = year+'-'+month+'-'+day;
	var result = ((new Date(tt).getTime())/1000)+hour*3600+min*60;
	var ts = Math.round((new Date()).getTime() / 1000);
	if(now_or_later==0)
	{
		var str="".concat((_type*255+switch_pid),",",method,",",result,",",now_or_later);
                socket.emit('Switch',str);
                clos();
	}
	else
	{
		if(result<ts)
		{
			alert('Choose the later time');
		}
		else
		{
			var str="".concat((_type*255+switch_pid),",",method,",",result,",",now_or_later);
			socket.emit('Switch',str);
			clos();
		}
	}
}

function clos()
{
	$("#all").hide(0);
	$("#cover").hide(400);
	document.getElementById('status_div').innerHTML="<canvas id='Chart' style='z-index:100002;'></canvas>"
	init_count_status=0;
	var switch_status=document.getElementById('switch'+switch_pid).checked;
	document.getElementById('switch'+switch_pid).checked=!switch_status;
}

function _search()
{
    mychart_id = document.getElementById('_id').value
    _type = document.getElementById('_type').value
    init_count_chart=0;
    var year1 = document.getElementById('Year1').value
    var month1 = document.getElementById('Month1').value
    var day1 = document.getElementById('Day1').value
    var year2 = document.getElementById('Year2').value
    var month2 = document.getElementById('Month2').value
    var day2 = document.getElementById('Day2').value
    var tt1 = year1+'-'+month1+'-'+day1;
    var tt2 = year2+'-'+month2+'-'+day2;
    document.getElementById('chart_div').innerHTML="<canvas id='myChart'>"
    lower = (new Date(tt1).getTime())/1000;
    upper = (new Date(tt2).getTime())/1000;
    if(lower>upper)
    {
        var tmp=lower
        lower=upper
        upper=tmp
    }
    upper+=86399
    var tim="".concat(timeConverter_easy(lower),"~",timeConverter_easy(upper));
    document.getElementById('show_tim').innerHTML=tim;
    var str="".concat(upper,",",lower,",",mychart_id,",",_type);
    var socket = io.connect('http://140.125.33.31:8080');
    socket.emit('Data',str);
    socket.emit('ID',"GET ALL ID");
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
    document.getElementById("Month"+_id).style.display="inline";
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
    document.getElementById("Day"+_id).style.display="inline";
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

function year_ini()
{
    var d=new Date();
    var y=d.getFullYear();
    var yy
    for(var i=y;i<=(y+1);i++)
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
    document.getElementById("Year").innerHTML=yy;
}

function mon_ini()
{
    var d=new Date();
    var y=d.getFullYear();
    var yy=document.getElementById("Year").value;
    var m=d.getMonth()+1;
    var least_month;
    if(yy>y)
    {
	least_month=1;
    }
    else
    {
	least_month=m;
    }
    var mm
    for(var i=least_month;i<=12;i++)
    {
        if(m==i)
            mm=mm+"<option value='"+i+"' selected='selected'>"+i+"月</option>"
        else
            mm=mm+"<option value='"+i+"'>"+i+"月</option>"
    }
    document.getElementById("Month").innerHTML=mm;

}

function day_ini()
{
    var d=new Date();
    var da=d.getDate();
    var yy=d.getFullYear();
    var mm=d.getMonth()+1;
    var dd
    var last_day
    var y=document.getElementById("Year").value;
    var m=document.getElementById("Month").value;
    var day_lo;
    var days=[31,28,31,30,31,30,31,31,30,31,30,31]
    if(y>yy)
    {
	day_lo=1;
    }
    else if(m>mm)
    {
	day_lo=1;
    }
    else
    {
	day_lo=da;
    }
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
    for(var i=day_lo;i<=last_day;i++)
    {
        if(i==da)
            dd=dd+"<option value='"+i+"' selected='selected'>"+i+"日</option>"
        else
            dd=dd+"<option value='"+i+"'>"+i+"日</option>"
    }
    document.getElementById("Day").innerHTML=dd;
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
    var time = year + '/' + (a.getMonth()+1) + '/' + date + ' ' + hour + ':' + min;
    return time;
}
function timeConverter_easy(UNIX_timestamp)
{
    var a = new Date(UNIX_timestamp * 1000);
    var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    var year = a.getFullYear();
    var month = months[a.getMonth()];
    var date = a.getDate();
    var hour = a.getHours();
    var min = a.getMinutes();
    var sec = a.getSeconds();
    var time = year + '/' + (a.getMonth()+1) + '/' + date;
    return time;
}
