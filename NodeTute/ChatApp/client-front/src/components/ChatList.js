import React, { Component } from 'react';
import { Container, ListGroup, ListGroupItem, Button } from 'reactstrap';
import { CSSTransition, TransitionGroup } from 'react-transition-group';
import uuid from 'uuid';
import { connect } from 'react-redux'; // get state from redux to react component
import { getChats } from '../actions/chatActions';
import PropTypes from 'prop-types';

class ChatList extends Component {
    componentDidMount() {
        this.props.getChats();
    }

    render() {
        const { chats } = this.props.chat;
        return (
            <Container>
              <Button style ={{marginBottom: '2em'}} onClick={() => {
                  const name = prompt('Enter Room Title');
                  if(name) {
                      this.setState (state => ({
                          chats: [...state.chats, { id: uuid(), name}]
                      }));
                  }
            }}>Create New Room </Button>
             <ListGroup>
               <TransitionGroup className="chat-list">
                {chats.map(({ id, name }) => (
                    <CSSTransition key={id} timeout={500} classNames="fade">
                      <ListGroupItem>
                       <Button className="remove-btn" color="danger" onClick={() =>
                        {
                            this.setState(state => ({
                                chats: state.chats.filter(chat => chat.id !== id)
                            }));
                        }}>&times;
                       </Button>
                       {name}
                      </ListGroupItem>
                    </CSSTransition>
                ))}
               </TransitionGroup>
             </ListGroup>
            </Container>
        );
    }
}

ChatList.propTypes = {
    getChats: PropTypes.func.isRequired,
    chat: PropTypes.object.isRequired
};

const mapStateToProps = (state) => ({
    chat: state.chat
});
export default connect(mapStateToProps, { getChats })(ChatList);