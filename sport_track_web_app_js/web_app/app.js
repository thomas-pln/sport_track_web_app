var createError = require('http-errors');
var express = require('express');
var path = require('path');
var cookieParser = require('cookie-parser');
var logger = require('morgan');
var bodyParser = require('body-parser');
var fileUpload = require('express-fileupload');
var session = require('express-session');

var indexRouter = require('./routes/index');
var users = require('./routes/users');
var connect = require('./routes/connect');
var upload = require('./routes/upload');

var app = express();

// view engine setup
app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'jade');


//app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser());

app.use(logger('dev'));
app.use(express.json());
app.use(express.urlencoded({ extended: false }));
app.use(cookieParser());
app.use(express.static(path.join(__dirname, 'public')));
app.use(fileUpload({createParentPath: true}));
app.use(session({secret:"dora_lexploratrice",resave:false,saveUninitialized:true,cookie:{secure:false}}));

app.use('/', indexRouter);
app.use('/users', users);
app.use('/connect', connect);
app.use('/upload', upload);

// catch 404 and forward to error handler
app.use(function(req, res, next) {
  next(createError(404));
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
