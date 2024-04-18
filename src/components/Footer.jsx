import React from 'react'
import "./Footer.css";

const Footer = () => {
  return (
    <footer>
      <div className="footer-wrapper">
        <p>Copyright © 2024</p>
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
      </div>
    </footer>
  )
}

export default Footer