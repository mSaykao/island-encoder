import React, { useState } from "react";
import './style.css';

function App() {
  const [isActive, setIsActive] = useState(false);
  const [isPopupActive, setIsPopupActive] = useState(false);

  const handleRegisterClick = () => {
    setIsActive(true);
  };

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

  return (
    <div>
      {/* Header */}
      <header className="header">
        <img id="logo" src="images/Colour_LOGO.png" alt="ISLAND" />
        <nav className="navbar">
          <a href="#">Home</a>
          <a href="#">About</a>
          <a href="#">Services</a>
          <a href="#">Contact</a>
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
              <form action="#">
                <div className="input-box">
                  <span className="icon"></span>
                  <input type="text" required />
                  <label>Username</label>
                </div>
                <div className="input-box">
                  <span className="icon"></span>
                  <input type="password" required />
                  <label>Password</label>
                </div>
                <div className="remember-forgot">
                  <label><input type="checkbox" />Remember me</label>
                  <a href="#">Forgot password?</a>
                </div>
                <button type="submit" className="btn">Login</button>
                <a href="#" className="syncer">Syncer</a>
                <div className="logreg-link">
                  <p>Don't have an account? <a href="#" className="register-link" onClick={handleRegisterClick}>Register</a></p>
                </div>
              </form>
            </div>

            {/* Register Form */}
            <div className={`form-box register ${isActive ? '' : 'hide'}`}>
              <div className="logreg-title">
                <h2 id="reg">Registration</h2>
                <p id="regtext">Please provide the following to verify your identity</p>
              </div>
              <form action="#">
                <div className="input-box">
                  <span className="icon"></span>
                  <input type="text" required />
                  <label>Email</label>
                </div>
                <div className="input-box">
                  <span className="icon"></span>
                  <input type="text" required />
                  <label>Username</label>
                </div>
                <div className="input-box">
                  <span className="icon"></span>
                  <input type="password" required />
                  <label>Password</label>
                </div>
                <div className="remember-forgot">
                  <label><input type="checkbox" />I agree to the terms & conditions</label>
                </div>
                <button type="submit" className="btn">Register</button>
                <div className="logreg-link">
                  <p id="zhuce">Already have an account? <a href="#" className="login-link" onClick={handleLoginClick}>Login</a></p>
                </div>
              </form>
            </div>

            <div className="media-options">
              <a href="#">
                <span>Login with Google</span>
              </a>
              <a href="#">
                <span>Login with Facebook</span>
              </a>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
}

export default App;
