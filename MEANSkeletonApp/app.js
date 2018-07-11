const express = require('express');
const path = require('path');
const bodyParser = require('body-parser');
const cors = require('cors');
const passport = require('passport');
const mongoose = require('mongoose');
const config = require('./config/database');

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

const app = express();// initialization app variable with express

const users = require('./routes/users');

// Port Number
const port = 3000;

// CORS middleware
app.use(cors());

// set static folder
// To serve static files such as images, CSS files, and JavaScript files
app.use(express.static(path.join(__dirname, 'public')));// absolute path

// app.use(express.static('public'));// relative path

// Body Parser Middleware
app.use(bodyParser.json());

// Passport middleware
app.use(passport.initialize());
app.use(passport.session());

require('./config/passport')(passport);

app.use('/users', users);

// index route
app.get('/', (req, res) => {
    res.send('invalid endpoint');
});

// start server here
app.listen(port, () => {
    console.log('SERVER started on port: '+port);
});