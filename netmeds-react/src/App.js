import React from "react";
import store from "./store";
import { Provider } from "react-redux";
import { BrowserRouter, Route, Link } from "react-router-dom";
import HomeScreen from "./screens/HomeScreen";
import {logoutUser} from "../src/actions/loginActions";
import jwt_decode from "jwt-decode";
import setAuthToken from "../src/setAuthToken";
import {LOGIN_SUCCESS} from "../src/types";

  // Check for token
  if (localStorage.authToken) {
    // Set auth token header auth
    setAuthToken(localStorage.authToken);
    // Decode token and get user info and exp
    const decoded = jwt_decode(localStorage.authToken);
    // Check for expired token
    const currentTime = Date.now() / 1000;
    if (decoded.exp < currentTime) {
      // Logout user
      store.dispatch(logoutUser());
      // Redirect to login
      window.location.href = "/";
    }
    store.dispatch({
      type: LOGIN_SUCCESS,
      payload: decoded,
    });
  }
class App extends React.Component {
  render() {
    return (
      <Provider store={store}>
        <BrowserRouter>
          <div className="grid-container">
            <header>
              <Link to="/">NetMeds</Link>
              {localStorage.authToken && <a onClick={() => store.dispatch(logoutUser())}>Logout</a>}
            </header>
            <main>
              <Route path="/" component={HomeScreen} exact />
            </main>
            <footer>All right is reserved.</footer>
          </div>
        </BrowserRouter>
      </Provider>
    );
  }
}


export default App;
