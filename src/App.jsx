import React from "react";
import "bootstrap/dist/css/bootstrap.min.css";
import Navbar from "./components/Navbar";
import Footer from "./components/Footer";
import { Route, Routes } from "react-router-dom";
import Blogs from "./components/Blogs";
import CreateBlog from "./components/CreateBlog";
import BlogDetail from "./components/BlogDetail";

const App = () => {
  return (
    <>
      <Navbar />
      <Routes>
        <Route path="/" element={<Blogs />} />
        <Route path="/create" element={<CreateBlog />} />
        <Route path="/blog" element={<BlogDetail />} />
      </Routes>
      <Footer />
    </>
  );
};

export default App;
