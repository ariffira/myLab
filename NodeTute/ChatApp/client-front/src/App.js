import React, { Component } from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import './App.css';

import AppNavbar from './components/AppNavbar';
import AppBody from './components/AppBody';
import ChatList from './components/ChatList';

import { Provider } from 'react-redux';
import store from './store';


class App extends Component {
  render() {
    return (
        <Provider store={store}>
          <div className="App">
              <AppNavbar />
              <AppBody />
              <ChatList />
          </div>
        </Provider>
    );
  }
}

export default App;
