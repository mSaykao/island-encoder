import React from "react";
import { BrowserRouter, Route, Routes } from "react-router-dom";
import Login from './pages/login';
import Dashboard from "./pages/dashboard";

function App() {
  return (
    <div className="App">
      <BrowserRouter>
        <Routes>
          <Route path="/" element={<Login />} />
          <Route path="/dashboard" element={<Dashboard />} />
        </Routes>
      </BrowserRouter>
    </div>
  );
}

export default App;
