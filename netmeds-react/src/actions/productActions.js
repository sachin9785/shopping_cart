import { FETCH_PRODUCTS, FILTER_PRODUCTS, API_URL} from "../types";
import axios from "axios";
export const fetchProducts = () =>  async (dispatch) => {
  const res =  await axios.get(`${API_URL}/api/products`);
  dispatch({
    type: FETCH_PRODUCTS,
    payload: res.data,
  });
};

export const filterProducts =  (search) => async (dispatch) => {
  const res =  await axios.get(`${API_URL}/api/search_package?search=${search}`);
  dispatch({
    type: FILTER_PRODUCTS,
    payload: {
      search: search,
      items:res.data
    },
  });
};

