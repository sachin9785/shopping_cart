import { ADD_TO_CART, REMOVE_FROM_CART, API_URL} from "../types";
import axios from "axios";
export const addToCart = (product) =>  (dispatch, getState) => {
  const res = axios.post(`${API_URL}/api/add_to_cart`, JSON.stringify(product),{
                headers: {
                  "Content-Type": "application/json",
                }
              }).then((res) => {
                const cartItems = res.data;
                  dispatch({
                    type: ADD_TO_CART,
                    payload: { cartItems },
                  });
                  localStorage.setItem("cartItems", JSON.stringify(cartItems));
              });
};

export const removeFromCart = (product) => (dispatch, getState) => {
  axios.post(`${API_URL}/api/remove_from_cart`,JSON.stringify(product), {
      headers: {
        "Content-Type": "application/json",
      }
    });
  const cartItems = getState()
    .cart.cartItems.slice()
    .filter((x) => x.package_id !== product.package_id);
  dispatch({ type: REMOVE_FROM_CART, payload: { cartItems } });
  localStorage.setItem("cartItems", JSON.stringify(cartItems));
};

export const fetchCart = () => (dispatch) => {
  axios.get(`${API_URL}/api/add_to_cart`)
    .then((res) => {
      const cartItems = res.data;
      localStorage.setItem("cartItems", JSON.stringify(cartItems));
      dispatch({
        type: ADD_TO_CART,
        payload: { cartItems },
      });
    });
};
