import React from 'react'
import "./Navbar.css";

const Navbar = () => {
  return (
    <nav>
      <a className="navbar-brand fs-4" href="#">Blog App</a>
      <ul>
        <li>
          <a href="/">Home</a>
        </li>
        <li>
          <a href="/">Blog</a>
        </li>
        <li>
          <a href="/">About</a>
        </li>
        <li>
          <a href="/">Contact</a>
        </li>
      </ul>
    </nav>
  )
}

export default Navbar