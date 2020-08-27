import React, { PureComponent } from "react";
import { connect } from "react-redux";
import Modal from "react-modal";
import Zoom from "react-reveal/Zoom";
import { validateForm } from "../util";
import { loginAction } from "../actions/loginActions";

class Login extends PureComponent {
  constructor(props) {
    super(props);
    this.state = {
      formInputs: {},
      formError: {},
      isOpen: true
    };
    this.notRequired = {};
  }



  componentDidUpdate(props) {
    if (props.loginResponse !== this.props.loginResponse) {
      const { loginResponse } = this.props;
      if (loginResponse) {
        if (!loginResponse.status) {
          let error = loginResponse.error;
          this.setState({
            formError: error
          });
        }
      }
    }
  }

  handleOnSubmit = (e) => {
    e.preventDefault();
    const formError = validateForm(e.target.elements, this.notRequired);

    if (Object.keys(formError).length > 1) {
      this.setState({
        formError: formError
      });
    } else {
      this.props.loginAction(this.state.formInputs);
    }
  }

  handleOnChange = (e) => {
    this.setState({
      ...this.state,
      formInputs: {
        ...this.state.formInputs,
        [e.target.name]: e.target.value
      }
    });
  }

  render() {
    const { loginResponse, isAuthenticated } = this.props;

    return (
      <>
        {!isAuthenticated && <Modal isOpen={this.state.isOpen} >

          <form onSubmit={this.handleOnSubmit}>
            <Zoom>
              <div className="order-details">
                <h3 className="success-message">Login </h3>
                {this.state.formError && (
                  <span className="form-message error-message">
                    {this.state.formError.display_error}
                  </span>
                )}
                <ul>

                  <li>
                    <div>Email:</div>
                    <div><input type="text" onChange={this.handleOnChange} name="email" id="email" value={this.state.formInputs.email || ""} class="email" placeholder="Email" /></div>
                    {this.state.formError && this.state.formError.email &&
                      <span className="form-message error-message">
                        {this.state.formError.email}
                      </span>}
                  </li>
                  <li>
                    <div>Password:</div>
                    <div><input type="password" onChange={this.handleOnChange} name="password" value={this.state.formInputs.password || ""} id="password" class="password" placeholder="Password" /></div>
                    {this.state.formError && this.state.formError.password &&
                      <span className="form-message error-message">
                        {this.state.formError.password}
                      </span>}
                  </li>

                </ul>

                <button className="button primary" type="submit">
                  Login Now
                    </button>
              </div>
            </Zoom>
          </form>
        </Modal>}
      </>
    );
  }
}

const mapStateToProps = state => ({
  loginResponse: state.login.loginResponse,
  isAuthenticated: state.login.isAuthenticated
});
export default connect(mapStateToProps, { loginAction })(Login);
