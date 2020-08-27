import { CREATE_ORDER, CLEAR_CART, CLEAR_ORDER, FETCH_ORDERS,API_URL } from "../types";
import axios from "axios";
export const createOrder = (order) => (dispatch) => {
  axios.post(`${API_URL}/api/orders`,JSON.stringify(order), {
    headers: {
      "Content-Type": "application/json",
    }
  })
    .then((res) => {
      dispatch({ type: CREATE_ORDER, payload: res.data });
      localStorage.clear("cartItems");
      dispatch({ type: CLEAR_CART });
    });
};
export const clearOrder = () => (dispatch) => {
  dispatch({ type: CLEAR_ORDER });
};
export const fetchOrders = () => (dispatch) => {
  axios.post(`${API_URL}/api/orders`)
    .then((res) => {
      dispatch({ type: FETCH_ORDERS, payload: res.data });
    });
};
