const express = require('express');
const router = express.Router();
const config = require('../../config/database');
const Chat = require('../../models/chat');
const ChatDetail = require('../../models/chatDetail');

// get list of all chat room list
router.get('/list', (req, res, next) => {
    Chat.find()
        .sort({ date: -1 })
        .then(chats => res.json(chats));
});

// create chat room
router.post('/create', (req, res) => {
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

// chat detail chats by id and also find related chat msg for this chat id from chatDetail collection
router.get('/detail/:id', (req, res, next) => {
    Chat.findById(req.params.id)
        .then(chat => res.json(chat))
        .catch(err => res.status(404).json({ success: false }));
});

// send chat msg with chatRoom Id
router.post('/addMsg/', (req, res, next) => {
    let newMsg = new ChatDetail({
        // chatId: req.body.chatId,
        chatMsg: req.body.chatMsg,
        msgBy: req.body.msgBy,
        // chatId: req.body.chatId
    });

    ChatDetail.addChatMsg(newMsg, (err, chatMsgs) => {
        if (err) {
            res.json({
                success: false,
                msg: 'No msg send'
            });
        }
        else {
            res.json ({
                success: true,
                msg: 'Successfully Send a msg'
            });
        }
    });

});

// test routes
router.get('/test', (req, res, next) => {
    res.send('This route works fine');
});

module.exports = router;


