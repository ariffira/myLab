import {
    GET_CHATS,
    ADD_CHAT,
    DELETE_CHAT,
    CHATS_LOADING
} from './types';

export const getChats = () => {
    return {
        type: GET_CHATS
    };
};