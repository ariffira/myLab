//author : Md Ariful islam
//this response with some html data
var http = require('http');
var fs = require('fs');

//Error manage with 404 error message
function send404Response(response) {
    response.writeHead(404, {"Context-type":"text/plain"});
    response.write("error 404, page not found");
    response.end();
}
//user request and response manage
function onRequest(request, response) {
    if(request.method == 'GET' && request.url == '/'){
        console.log("User made a request to the server" + request.url);
        response.writeHead(200, {"Context-type":"text/html"});
        fs.createReadStream("./simpleServer.html").pipe(response);
    }else {
        send404Response(response);
    }
}

http.createServer(onRequest).listen(8889);
console.log("Server starting.....");
setTimeout(function () {
    console.log('Now Server is running on port 8889....');
}, 2000);