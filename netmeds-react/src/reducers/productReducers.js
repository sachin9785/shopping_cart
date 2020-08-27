import {
  FETCH_PRODUCTS,
  FILTER_PRODUCTS
} from "../types";

export const productsReducer = (state = {}, action) => {
  switch (action.type) {
    case FILTER_PRODUCTS:
      return {
        ...state,
        search: action.payload.search,
        filteredItems: action.payload.items,
      };
    
    case FETCH_PRODUCTS:
      return { items: action.payload, filteredItems: action.payload };
    default:
      return state;
  }
};
