import React from 'react'

const BlogCard = ({blog}) => {

  const showImage = (img) => {
    return (img) ? 'http://localhost:8000/uploads/blogs/'+img : 'https://placehold.co/600x400';
}
  return (
        <div className="col-12 col-md-2 col-lg-3">
          <div className="card border-0 shadow-lg mb-4">
            <img src={showImage(blog.image)} alt="image" className='card-img-top'/>
            <div className="card-body">
              <h2 className='h5'>{blog.title}</h2>
              <p>
              {blog.shortDesc}
              </p>
              <a href={`/blog/${blog.id}`} className="btn btn-dark">Read More</a>
            </div>
          </div>
        </div>
  )
}

export default BlogCard