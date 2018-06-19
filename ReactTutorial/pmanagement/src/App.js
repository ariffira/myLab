import React, { Component } from 'react';
import Projects from './components/Projects';

import './App.css';

class App extends Component {

  constructor(){
      super();
      this.state = {
      projects: [
          {
            title: 'Project generate',
              category: 'PBL'
          },
          {
              title: 'Idea generate',
              category: 'PBL'
          },
          {
              title: 'Showcase',
              category: 'PBL'
          }
      ]
    }
  }
  render() {
    return (
      <div className="App">
        my app
          <Projects projects = {this.state.projects} />
      </div>
    );
  }
}

export default App;
