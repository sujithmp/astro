var createError = require('http-errors');
var express = require('express');
var path = require('path');
var cookieParser = require('cookie-parser');
var logger = require('morgan');
const bodyParser = require('body-parser');
const session = require('express-session');
const expressMessage = require('express-messages');
const passport = require('passport');
const passportLocal = require('passport-local');
const multer = require('multer');
var uploads = multer({dest:"./uploads"});
const expressValidator = require('express-validator');
const flash = require('connect-flash');
const mongo = require('mongodb');
const mongoose = require('mongoose');
const db = mongoose.connection;

var indexRouter = require('./routes/index');
var usersRouter = require('./routes/users');

var app = express();

// view engine setup
app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'hbs');
// Handle file upload

app.use(logger('dev'));
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }));
app.use(cookieParser());
app.use(express.static(path.join(__dirname, 'public')));


//  Handle session
app.use(session({
	secret:"secret",
	saveUninitialized:true,
	resave:true

}));

// passport
app.use(passport.initialize());
app.use(passport.session());

// Validator

/* 
	In 6  and above versions of express validator 
	you will get an error of expressValidator is not 
	a function.
	Here i just degraded to lower version less than 6
	you  can just specify the exact  version right 
	in the npm installation command. 
	Just like npm install express-validator@5.*.*
	the above example  will install latest with
	in the major release of the 5th  version.
	Now if you want a specific version, u can do like 
	suppose if  u want to install 5.3.1 then instead of
	asterisk mark u shall put the minor and patch numbers
	as u like.
 */
app.use(expressValidator({
	errorFormatter:function(param,msg,value){
		var namespace = param.split('.')
		,root = namespace.shift()
		,formParam = root;
		while(namespace.length){
			formParam+= '[' + namespace.shift() + ']';
		}
		return {
			param : formParam,
			msg : msg,
			value : value
		};
	}

}))

// middle ware
app.use(flash());
app.use(function(req, res, next){
    //res.locals.success_messages = req.flash('success_messages');
    res.locals.messages = expressMessage(req,res);
    next();
});
app.use('/', indexRouter);
app.use('/users', usersRouter);

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
















