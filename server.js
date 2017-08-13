var http = require('http');
var app =  require('./app')
http.createServer(app.requestHandler).listen(1137);
console.log("The server is running now");