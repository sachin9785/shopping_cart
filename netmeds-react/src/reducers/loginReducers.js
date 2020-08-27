import { LOGIN_SUCCESS, LOGIN_ERROR,LOGOUT_SUCCESS} from "../types";
import {isEmpty} from "../util";

const loginReducer = (state = {}, action) => {
  switch (action.type) {
    case LOGIN_SUCCESS:
      return {
        ...state,
        isAuthenticated: isEmpty(action.payload) ? false : true,
        loginResponse: action.payload
      };

    case LOGOUT_SUCCESS:
      return {
        ...state,
        isAuthenticated: false,
        loginResponse: null
      };

    case LOGIN_ERROR:
      return {
        ...state,
        isAuthenticated: false,
        loginResponse: action.payload
      };
    default:
      return state;
  }
};
export { loginReducer };
