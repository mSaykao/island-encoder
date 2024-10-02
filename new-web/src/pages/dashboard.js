import React, { useState, useEffect } from 'react';
import './dashboard.css';

const Dashboard = () => {
  const [time, setTime] = useState({
    year: '',
    month: '',
    date: '',
    hour: '',
    minute: '',
    second: '',
  });

  const showTime = () => {
    const now = new Date();
    setTime({
      second: now.getSeconds(),
      minute: now.getMinutes(),
      hour: now.getHours(),
      date: now.getDate(),
      month: now.getMonth() + 1,
      year: now.getFullYear(),
    });
  };

  useEffect(() => {
    const timer = setInterval(showTime, 1000);
    return () => clearInterval(timer);
  }, []);

  return (
    <div className="container">
      <aside>
        <div className="top">
          <div className="logo">
            <img id="LinkPi" src="./link-regular-24.png" alt="" />
            <h2 className="text-muted">Link<span className="danger">Pi</span></h2>
          </div>
          <div className="close" id="close-btn">
            <span className="material-symbols-outlined">close</span>
          </div>
        </div>

        <div className="sidebar">
          <a href="#" className="active">
            <span className="material-symbols-outlined">menu</span>
            <h3>Dashboard</h3>
          </a>
          <a href="#">
            <span className="material-symbols-outlined">view_timeline</span>
            <h3>Decode</h3>
          </a>
          <a href="#">
            <span className="material-symbols-outlined">explosion</span>
            <h3>Encode</h3>
          </a>
          <a href="#">
            <span className="material-symbols-outlined">stream</span>
            <h3>Stream</h3>
          </a>
          <a href="#">
            <span className="material-symbols-outlined">compare_arrows</span>
            <h3>Push</h3>
          </a>
          <a href="#">
            <span className="material-symbols-outlined">output</span>
            <h3>Output</h3>
          </a>
          <a href="#">
            <span className="material-symbols-outlined">settings</span>
            <h3>System</h3>
          </a>
          <a href="#">
            <span className="material-symbols-outlined">layers</span>
            <h3>Overlay</h3>
          </a>
          <a href="#">
            <span className="material-symbols-outlined">play_circle</span>
            <h3>Video mix</h3>
          </a>
          <a href="#">
            <span className="material-symbols-outlined">extension</span>
            <h3>Extend</h3>
          </a>
          <a href="#">
            <span className="material-symbols-outlined">share</span>
            <h3>Options</h3>
          </a>
          <a href="#">
            <span className="material-symbols-outlined">science</span>
            <h3>Labor</h3>
          </a>
          <a href="#">
            <span className="material-symbols-outlined">logout</span>
            <h3>Logout</h3>
          </a>
        </div>
      </aside>

      <main>
        <h1>Dashboard</h1>

        <div className="date">
          <input type="date" />
          <h2>
            Melbourne Time: {`${time.year}-${time.month}-${time.date} ${time.hour}:${time.minute}:${time.second}`}
          </h2>
        </div>

        <div className="insights">
          <div className="CPU">
            {/* You can add CPU-related content here */}
          </div>
        </div>
      </main>
    </div>
  );
};

export default Dashboard;
