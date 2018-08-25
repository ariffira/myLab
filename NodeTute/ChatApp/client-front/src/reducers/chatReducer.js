import uuid from 'uuid';
import {
    GET_CHATS,
    ADD_CHAT,
    DELETE_CHAT,
    CHATS_LOADING
} from '../actions/types';

const initialState = {
    chats: [
        { id: uuid(), name: 'WorldCup18'},
        { id: uuid(), name: 'Cricket'},
        { id: uuid(), name: 'Germany'},
        { id: uuid(), name: 'TestRoom'}
    ]
}

export default function (state= initialState, action) {
    switch (action.type) {
        case GET_CHATS:
            return {
                ...state
            };
        default:
            return state;
    }
}