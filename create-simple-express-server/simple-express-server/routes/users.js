var express = require('express');
var router = express.Router();
const nodemailer = require('nodemailer');
console.log("nodemailer",nodemailer);
/* POST user login */

router.post('/login',function(req,res,next){

	/* 
		user login is successfull ,
		will show the home page
	*/
	res.render('home');
});
/* GET users login */
router.get('/', function(req, res, next) {

	/*
		send is available only with express
		tried to use it normally 
		but got an error  as send is not a function
	*/	
	res.render('login-form');
  	//res.send('respond with a resource');
});
/* POST user registeration detail  */
router.post('/register/submit', ( req, res,next) => { 
	/* 
		user  register successfull, will send
		a mail notifying
		once user successfully submitted
		redirects to login page
	*/
});
/* GET  user register */
router.get('/register',(req,res,next) =>{
	/* 
		will show here the user registeration
		form 
	*/
	res.render('register-form');
});

/* show  contact form */

router.get('/contact', ( req, res,next) => { 
	/* 
		render contact form
	*/

	res.render('contact-form');
});
/* POST contact  */
router.post('/contact/send', (req, res,next) => { 
	var transport = nodemailer.createTransport({
		service : 'Gmail',
		auth:{
			user : 'test.@gmail.com',
			pass : ''
		}
	});
	var mailOptions = {
		from:'test <test.@gmail.com>',
		to:'test.@gmail.com',
		subject:"This is a test mail from I-learn",
		text:"Please see the details below ",
		html:'<p> Please see the below details<p>'+
				'<ul>'+
				'<li> Name:'+req.body.username+'</li>'+
				'<li>Email:'+req.body.email+'</li>'+
				'<li>Message:'+req.body.message+'</li>'+
				'</ul>'	,
	};
	//console.log("transport",transport);
	transport.sendMail(mailOptions, (error,info) => { 
		if(error){
			console.log("Message not sent"+ error.message);
			res.redirect('/');
		}else{
			 console.log("Message sent");;
			res.redirect('/');
		}
	});
});

module.exports = router;
