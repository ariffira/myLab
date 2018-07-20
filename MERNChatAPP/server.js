const express = require('express');
const path = require('path');
const bodyParser = require('body-parser');
const mongoose = require('mongoose');
const config = require('./config/database');
const cors = require('cors');

// get config of database
mongoose.connect(config.database);


// on connect database
mongoose.connection.on('connected', () => {
    console.log('mongoose connected as:' + config.database);
});

// on reject database
mongoose.connection.on('error', (err) => {
    console.log('database Rejected ...' + err);
});

// initialization app variable with express
const app = express();
// chats api routes
const chats = require('./routes/api/chats');

// Port Number
const port = 5000;

// CORS Middleware
app.use(cors());

// set static folder
// To serve static files such as images, CSS files, and JavaScript files
app.use(express.static(path.join(__dirname, 'public')));// absolute path

// Body Parser Middleware
app.use(bodyParser.json());
// using chats routes as localhost:portnumber/chats/nextpath.
app.use('/chats', chats);

// index route
app.get('/', (req, res) => {
    res.send('invalid endpoint which is not use. It is only testing API purpose');
});

// start server here
app.listen(port, () => {
    console.log('SERVER started on port number: '+port);
});