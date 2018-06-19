var express = require('express');
var path = require('path');
var app = express();

// load view engine
app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'pug');

// Home route
app.get('/', function (req, res) {
    res.render('index', {
        title: 'Node&express js practice'
    });
});

// Add routes
app.get('/articles/add', function (req, res) {
    res.render('addArticle', {
        title: 'add Articles'
    });
});


app.listen(3001, function () {
    console.log('Example app listening on port 3001!');
});