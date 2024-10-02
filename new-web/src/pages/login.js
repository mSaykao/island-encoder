import React, { useState } from "react";
import './login.css';
import { useNavigate } from "react-router-dom";
import { login } from "../data/repository";

function Login(props) {
  const [fields, setFields] = useState({ username: "", password: "" });
  const [isActive, setIsActive] = useState(false);
  const [isPopupActive, setIsPopupActive] = useState(false);
  const [errorMessage, setErrorMessage] = useState(null);
  const navigate = useNavigate();

  const handleLoginClick = () => {
    setIsActive(false);
  };

  const handlePopupClick = () => {
    setIsPopupActive(true);
  };

  const handleCloseClick = () => {
    setIsPopupActive(false);
    setIsActive(false);

    
  };

  const handleInputChange = (event) => {
    const name = event.target.name;
    const value = event.target.value;

    // Copy fields.
    const temp = { username: fields.username, password: fields.password };
    // OR use spread operator.
    // const temp = { ...fields };

    // Update field and state.
    temp[name] = value;
    setFields(temp);
  }

  const handleSubmit = (event) => {
    event.preventDefault();

    const verified = login(fields.username, fields.password);

    // If verified sign in the user.
    if (verified === true) {
      //props.signInUser(getUser());

      // Navigate to the home page.
      navigate("/dashboard");
    } else {
      // Reset password field to blank.
      const temp = { ...fields };
      temp.password = "";
      setFields(temp);

      // Set error message.
      setErrorMessage("Email and/or password invalid, please try again.");
    }
}

  return (
    <div>
      {/* Header */}
      <header className="header">
        <img id="logo" src="../images/Colour_LOGO.png" alt="ISLAND" />
        <nav className="navbar">
          <button className="btnLogin-popup" onClick={handlePopupClick}>
            Login
          </button>
        </nav>
      </header>

      {/* Section */}
      <section className="section">
        <div className="details">
          <div className="InputStatus">
            <h3 id="title1">Input Status</h3>
            {/* linkpi api calls required here */}
          </div>
          <div className="Encoder">
            <h3 id="title2">Encoder/Streaming Status</h3>
            {/* linkpi api calls required here */}
          </div>
          <div className="recordingstatus">
            <h3 id="title3">Recording Status</h3>
            {/* linkpi api calls required here */}
          </div>
          <div className="NetworkStatus">
            <h3 id="title4">Network Status</h3>
            {/* linkpi api calls required here */}
          </div>
        </div>

        {/* Wrapper */}
        <div className={`wrapper ${isPopupActive ? 'active-popup' : ''} ${isActive ? 'active' : ''}`}>
          <span className="icon-close" onClick={handleCloseClick}>
            <i className="bx bx-x"></i>
          </span>

          {/* Login Form */}
          <div className="logreg-box">
            <div className={`form-box login ${isActive ? 'hide' : ''}`}>
              <div className="logreg-title">
                <h2>Login</h2>
                <p>Id:Comp Sci H1</p>
              </div>
              <form onSubmit={handleSubmit}>
                <div className="input-box">
                  <span className="icon"></span>
                  <input type="text" name="username" required value={fields.username} onChange={handleInputChange}/>
                  <label>Username</label>
                </div>
                <div className="input-box">
                  <span className="icon"></span>
                  <input type="password" name="password" required value={fields.password} onChange={handleInputChange}/>
                  <label>Password</label>
                </div>
                <button type="submit" className="btn">Login</button>
              </form>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
}

export default Login;
