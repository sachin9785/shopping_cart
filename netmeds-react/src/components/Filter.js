import React, { Component } from "react";
import { connect } from "react-redux";
import { filterProducts } from "../actions/productActions";

class Filter extends Component {
  render() {
    return !this.props.filteredProducts ? (
      <div>Loading...</div>
    ) : (
      <div className="filter">
        <div className="filter-result">
          {this.props.filteredProducts.length} Products
        </div>
        
        <div className="filter-size">
          Seach{" "}
          <input
            name = 'search'
            value={this.props.search}
            onChange={(e) =>
              this.props.filterProducts(e.target.value)
            }
          >
          </input>
        </div>
      </div>
    );
  }
}
export default connect(
  (state) => ({
    search: state.products.search,
    products: state.products.items,
    filteredProducts: state.products.filteredItems,
  }),
  {
    filterProducts
  }
)(Filter);
