import React from 'react';
import logo from './logo.svg';
import './App.css';
import Menu from './components/Menu';
import Footer from './components/Footer';
import Header from './components/Header';
import Forms from './components/Form';

function App() {
  return (
    <div className="App">
      <Header></Header>
      <Menu></Menu>
      <Forms></Forms>
      <Footer></Footer>
    </div>
  );
}

export default App;
