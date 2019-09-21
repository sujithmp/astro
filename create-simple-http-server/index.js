// importing http module
const http  = require('http');

// we need to cofigure the port which 
// server should listen to

const port = "3000";
const hostname = '127.0.0.1';
console.log("http",http);
http.createServer((req,res) =>{ 

	res.writeHead('200',{'Content-Type':'text/html'});
	res.end("<h1>Hello\n<h1>");

}).listen(port,hostname,() =>{
	console.log("port",port);
	console.log("hostname",hostname);
	/*
		use tild sign to properly console the port and hostname the server is
		running
	*/
	 console.log(`Server running  at the port http://${hostname}:${port}/`);
});
