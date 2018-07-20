import React, { Component } from 'react';
import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import AppNavbar from "./components/AppNavbar";
import ChatList from "./components/ChatList";
import ChatDetail from "./components/ChatDetail";
import CreateRoom from "./components/CreateRoom";
import { BrowserRouter as Router, Route, Link } from "react-router-dom";


class App extends Component {
  render() {
    return (
      <div className="App">
          <AppNavbar/>
          <CreateRoom/>
          <Router>
              <div>
                  <ul>
                      <li>
                          <Link to="/">Chat List</Link>
                      </li>
                      <li>
                          <Link to="/chatDetail">Chat Detail</Link>
                      </li>
                  </ul>
                  <hr />
                  <Route exact path="/" component={ChatList} />
                  <Route path="/chatDetail" component={ChatDetail} />
              </div>
          </Router>
      </div>
    );
  }
}

export default App;
