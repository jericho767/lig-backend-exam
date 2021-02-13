import React, { Component } from 'react';

import Pages from 'screens/Pages';
import Header from 'components/Header/Header';
import Footer from 'components/Footer/Footer';
import Nav from 'components/Nav/Nav';

import './App.scss';

class App extends Component {

  state = {
    isToggle: false
  };

  render() {
    let { isToggle } = this.state;

    return (
      <div className="app">
        <Nav
          isShow={isToggle}
          onHide={() => this.setState({ isToggle: false })}
        />
        <Header
          isMenuToggle={isToggle}
          onMenuToggle={(e) => this.setState({ isToggle: e })}
        />
        <Pages />
        <Footer />
      </div>
    );
  }
}

export default App;
