var express = require('express');
var app = express();
var fs = require("fs");

//new user hard coded as json format
var user = {
    "user4" : {
        "name" : "Tina",
        "age" : "33",
        "profession" : "Beautician",
        "id": 4
    }
}

//creating RESTFUL Api listUsers
app.get('/listUsers', function (req, res) {
    fs.readFile( __dirname + "/" + "users.json", 'utf8', function (err, data) {
        console.log( data );
        res.end( data );
    });
})

//creating RESTFUL Api adduser
app.post('/addUser', function (req, res) {
    // First read existing users.
    fs.readFile( __dirname + "/" + "users.json", 'utf8', function (err, data) {
        data = JSON.parse( data );
        data["user4"] = user["user4"];
        console.log( data );
        res.end( JSON.stringify(data));
    });
})

//creating restful api to find id details
app.get('/:id', function (req, res) {
    // First read existing users.
    fs.readFile( __dirname + "/" + "users.json", 'utf8', function (err, data) {
        var users = JSON.parse( data );
        var user = users["user" + req.params.id]
        console.log( user );
        res.end( JSON.stringify(user));
    });
})

var server = app.listen(8081, function () {

    var host = server.address().address
    var port = server.address().port
    console.log("Server running.....");
    console.log("Listening at (host.port) http://%s:%s", host, port);

})