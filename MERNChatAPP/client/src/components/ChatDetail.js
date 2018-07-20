import React, { Component } from 'react';
import axios from 'axios';


class ChatDetail extends Component {
    constructor(props) {
        super(props);
        this.state = {
            chatDetails: []
        };
    }

    componentDidMount() {
        axios.get(`chats/detail/5b4cfe47b1adce1794c94888`)
            .then(res => {
                //detail data of chat id
                const chatDetails = res.data;
                console.log(chatDetails);
                this.setState({ chatDetails });
            })
    }

    render() {
        return (
            <div>
                Hello....works
            </div>
        );
    }
}

export default ChatDetail;