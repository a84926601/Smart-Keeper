var express = require('express');
var path = require('path');
var favicon = require('serve-favicon');
var logger = require('morgan');
var cookieParser = require('cookie-parser');
var bodyParser = require('body-parser');

var router = express.Router();
var app = express();

const mongoose=require('mongoose');
const dataSchema = mongoose.Schema({
    id: Number,
    type: Number,
    time: Number,
    power: Number
});

var Data = mongoose.model('Data', dataSchema);
module.exports = Data;

mongoose.connect('mongodb://127.0.0.1:27017/electricity');
mongoose.Promise = global.Promise;
mongoose.connection.once('open',function(){
        console.log('successful');
}).on('error',function(error){
        console.log('fail by '+error);
});


// view engine setup
app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'ejs');

// uncomment after placing your favicon in /public
//app.use(favicon(path.join(__dirname, 'public', 'favicon.ico')));
app.use(logger('dev'));


app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }));
app.use(cookieParser());
app.use(express.static(path.join(__dirname, 'public')));

//===============insert data===============
var tt = new Data({
    id:1,
    type:1,
    time:1530835000,
    power:100
});

//tt.save(function(err){
//    if(err)
//	throw err
//    else
//    console.log('success');
//});
// ========================================
var dat = new Date();
var dd = dat.getDate();
var mm = dat.getMonth()+1;
var yy = dat.getFullYear();
var tt = yy+'-'+mm+'-'+dd;
var lower = (new Date(tt).getTime())/1000+86400;
var upper = lower+86400;
app.get('/',function(req, res, next){
  //console.log(req.query)
  lower=req.query.lower==null?lower:req.query.lower;
  upper=req.query.upper==null?upper:req.query.upper;
  Data.find({time:{$gte:lower,$lte:upper}},function(err, datas){
      if(err) throw err;
      //console.log(datas);
      jn=datas;
  });
  if(jn[0]==null) jn=null;
  else
  {
    var tmp='{';
    var count=0;
    while(jn[count]!=null)
    {
	if(count==0)
	    tmp = tmp + jn[count];
	else
	    tmp = tmp + ',' +  jn[count];
	count++;
    };
    tmp=tmp+'}';
    jn = tmp;
    console.log(jn);
  }
  res.render('index',{title: 'Smart-keeper',upper:upper ,lower:lower , result:jn});
});

app.get('/index',function(req, res, next){
  //console.log(req.query)
  lower=req.query.lower==null?lower:req.query.lower;
  upper=req.query.upper==null?upper:req.query.upper;
  Data.find({time:{$gte:lower,$lte:upper}},function(err, datas){
      if(err) throw err;
      //console.log(datas);
      jn=datas;
  });
  if(jn[0]==null) jn=null;
  else
  {
    var tmp='{';
    var count=0;
    while(jn[count]!=null)
    {
        if(count==0)
            tmp = tmp + jn[count];
        else
            tmp = tmp + ',' +  jn[count];
        count++;
    };
    tmp=tmp+'}';
    jn = tmp;
    console.log(jn);
  }
  res.render('index',{title: 'Smart-keeper',upper:upper ,lower:lower, result:jn});
});

app.get('/data',function(req, res, next){
  res.render('data',{title: 'data'});
});

app.get('/chart',function(req, res, next){
  res.render('chart',{title: 'Chart'});
});


// catch 404 and forward to error handler
app.use(function(req, res, next) {
  var err = new Error('Not Found');
  err.status = 404;
  next(err);
});

// error handler
app.use(function(err, req, res, next) {
  // set locals, only providing error in development
  res.locals.message = err.message;
  res.locals.error = req.app.get('env') === 'development' ? err : {};

  // render the error page
  res.status(err.status || 500);
  res.render('error');
});

module.exports = app;
