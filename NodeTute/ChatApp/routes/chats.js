const express = require('express');
const router = express.Router();
const passport = require('passport');
const jwt = require('jsonwebtoken');
const config = require('../config/database');
const Chat = require('../models/chat');

// get list of all chat room list
router.get('/list', passport.authenticate('jwt', {session:false}), (req, res, next) => {
    // res.send('Chat list routes here');
    //res.json({lel: req.user});
    var userName = req.user.name;
    //res.json(userId._id);
    Chat.find()
        .where('createdBy', userName)
        .sort({ date: -1 })
        .then(chats => res.json(chats));
});

// create chat room
router.post('/create', (req, res) => {
    // res.send('Chat list routes here');
    let newChat = new Chat({
        roomTitle: req.body.roomTitle,
        createdBy: req.body.createdBy
    });

    Chat.addChatRoom(newChat, (err, chat) => {
        if (err) {
            res.json({
                success: false,
                msg: 'Can not create Chat room'
            });
        }
        else {
            res.json ({
                success: true,
                msg: 'Successfully created a chat room'
            });
        }
    });
});

module.exports = router;


