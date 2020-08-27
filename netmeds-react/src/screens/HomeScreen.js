import React, { Component } from "react";
import Filter from "../components/Filter";
import Products from "../components/Products";
import Cart from "../components/Cart";
import Login from "../components/Login";

export default class HomeScreen extends Component {
  render() {
    return (
      <div>
        <div className="content">
          <div className="main">
            {!localStorage.authToken && <Login></Login>}
            {localStorage.authToken && <Filter></Filter>}
            {localStorage.authToken && <Products></Products>}
          </div>
          <div className="sidebar">
          {localStorage.authToken && <Cart />}
          </div>
        </div>
      </div>
    );
  }
}
