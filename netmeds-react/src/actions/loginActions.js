import axios from "axios";
import { LOGIN_SUCCESS, LOGIN_ERROR,LOGOUT_SUCCESS, API_URL} from "../types";
import setAuthToken from "../setAuthToken";
import {encodeForm} from "../util";

export const loginAction = (data) => (dispatch) => {
  axios
    .post(`${API_URL}/api/login/`, encodeForm(data), {
      headers: { Accept: "application/json" },
    })
    .then((res) => {
      if (res.data.token) {
        const token = res.data.token;
        localStorage.setItem("authToken", token);
        setAuthToken(localStorage.authToken);
      
        // Set current user
        dispatch({
          type: LOGIN_SUCCESS,
          payload: token,
        });
        window.location.href = "/";
      } else {
        dispatch({
          type: LOGIN_ERROR,
          payload: res.data,
        });
      }
    })
    .catch((error) => {
      console.log("error", error);
    });
};


// Log user out
export  const logoutUser = () => dispatch => {
  // Remove token from localStorage
  localStorage.removeItem("authToken");
  localStorage.removeItem("cartItems");
  // Remove auth header for future requests
  setAuthToken(false);
  // Set current user to {} which will set isAuthenticated to false
  dispatch({
    type: LOGOUT_SUCCESS,
    payload: null,
  });
  window.location.href = "/";
};
