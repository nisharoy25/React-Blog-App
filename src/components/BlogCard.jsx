import React from 'react'

const BlogCard = () => {
  return (
        <div className="col-12 col-md-2 col-lg-3">
          <div className="card border-0 shadow-lg mb-4">
            <img src="https://placehold.co/600x400" alt="image" className='card-img-top'/>
            <div className="card-body">
              <h2 className='h5'>Dummy Heading</h2>
              <p>
              Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.
              </p>
              <a href={"/blog"} class="btn btn-dark">Read More</a>
            </div>
          </div>
        </div>
  )
}

export default BlogCard