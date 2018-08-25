const express = require('express');
const router = express.Router();
const passport = require('passport');
const jwt = require('jsonwebtoken');
const config = require('../config/database');
const User = require('../models/user');

// Register route to join chat list for participants
router.post('/register', (req, res, next) => {
    // res.send('Register works');
    let newUser = new User({
        name: req.body.name,
        email: req.body.email,
        username: req.body.username,
        password: req.body.password
    });

    User.addUser(newUser, (err, user) => {
        if (err) {
            res.json({
                success: false,
                msg: 'Failed to register...'
            });
        }
        else {
            res.json ({
            success: true,
            msg: 'User registration successful....! Please log-in to Chat'
        });
        }
    });
});

// authenticate routes for get token for login
router.post('/authenticate', (req, res, next) => {
    // res.send('Authenticate');
    const username = req.body.username;
    const password = req.body.password;

    User.getUserByUserName(username, (err, user) => {
        if (err) throw err;
        if (!user) {
            return res.json({
                success: false,
                msg: 'No user found!'
            });
        }
    User.comparePassword(password, user.password, (err, isMatch) => {
        if (err) throw err;
        if (isMatch) {
        const token = jwt.sign({data: user}, config.secret, {
            expiresIn: 604800 // 1 week
        });
        res.json({
            success: true,
            token: `Bearer ${token}`,
            user: {
                id: user._id,
                name: user.name,
                username: user.username,
                email: user.email
            }
        });
        }
        else {
            return res.json({
            success: false,
            msg: 'Wrong password!please enter right one'
            });
        }
    });
    });
});

// profile page routes with authentication check
router.get('/profile', passport.authenticate('jwt', {session:false}), (req, res, next) => {
    // res.send('Profile works');
    res.json({user: req.user});
});

// test routes
router.get('/authenticatetest', (req, res, next) => {
    res.send('This route works fine');
});

module.exports = router;