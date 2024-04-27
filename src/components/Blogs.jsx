import React, { useState, useEffect } from 'react';
import BlogCard from './BlogCard';

const Blogs = () => {
  const [blogs, setBlogs] = useState([]);

  const fetchBlogs = async () => {
    try {
      const res = await fetch('http://localhost:8000/api/blogs');
      const result = await res.json();
      console.log('Fetched blogs:', result); // Add this line to check the fetched data
      if (result && result.data) {
        setBlogs(result.data.data);  
      } else {
        console.error('Data not found in the fetched result:', result);
      }
    } catch (error) {
      console.error('Error fetching blogs:', error);
    }
  };
    
  useEffect(() => {
    fetchBlogs();
  }, []);

  console.log('Blogs state:', blogs); // Add this line to check the state before rendering

  return (
    <div className='container'>
      <div className="d-flex justify-content-between pt-5 mb-4">
        <h4>Blogs</h4>
        <a href='/create' className='btn btn-dark'>Create</a>
      </div>
      <div className="row">
        {blogs.map((blog) => (
          <BlogCard blog={blog} key={blog.id} />
        ))}
      </div>
    </div>
  );
};

export default Blogs;
