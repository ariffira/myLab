const mongoose = require('mongoose');
const bcrypt = require('bcryptjs');
const config = require('../config/database');

// Chat Schema
const ChatSchema = mongoose.Schema({
    roomTitle: {
        type: String,
        required: true
    },
    createdBy: {
        type: String
    }
});

const Chat =  module.exports = mongoose.model('Chat', ChatSchema);

module.exports.addChatRoom = function (newChat, callback) {
    newChat.save(callback);
};