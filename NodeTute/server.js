//author : Md Ariful islam
//this one only response when go localhost:8888
var http = require('http');

function onRequest(request, response) {
    console.log("User made a request to the server" + request.url);
    response.writeHead(200, {"Context-type":"text/plain"});
    response.write("Thank you for your request");
    response.end();
}

http.createServer(onRequest).listen(8888);
console.log("Server starting.....");
setTimeout(function () {
    console.log('Now Server is running on port 8888....');
}, 2000);