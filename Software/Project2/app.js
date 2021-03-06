var express = require('express');
var path = require('path');
var favicon = require('serve-favicon');
var logger = require('morgan');
var cookieParser = require('cookie-parser');
var bodyParser = require('body-parser');

<<<<<<< HEAD
var router = express.Router();
=======
var index = require('./routes/index');
#var data = require('./routes/data');
#var chart = require('./routes/chart');
var users = require('./routes/users');

>>>>>>> 27552dfb491c3c33715a634cedf2233d4e22982e
var app = express();

const mongoose=require('mongoose');
mongoose.connect('mongodb://140.125.33.34:27017/electricity');
mongoose.Promise = global.Promise;
mongoose.connection.once('open',function(){
<<<<<<< HEAD
        console.log('successful');
=======
	console.log('successful');
>>>>>>> 27552dfb491c3c33715a634cedf2233d4e22982e
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

<<<<<<< HEAD
app.get('/',function(req, res, next){
  console.log(req.query)
  if(req.query.upper==null || req.query.lower==null)
        res.render('index',{title: 'Smart-keeper',upper:0 ,lower:0});
  else
        res.render('index',{title: 'Smart-keeper',upper:req.query.upper ,lower:req.query.lower});
});

app.get('/index',function(req, res, next){
  console.log(req.query)
  if(req.query.upper==null || req.query.lower==null)
        res.render('index',{title: 'Smart-keeper',upper:0 ,lower:0});
  else
        res.render('index',{title: 'Smart-keeper',upper:req.query.upper ,lower:req.query.lower});
});
app.get('/data',function(req, res, next){
  res.render('data',{title: 'data'});
});
app.get('/chart',function(req, res, next){
  res.render('chart',{title: 'Chart'});
});

=======
app.use('/', index);
#app.use('/data', data);
#app.use('/chart', chart);
app.use('/users', users);
>>>>>>> 27552dfb491c3c33715a634cedf2233d4e22982e

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