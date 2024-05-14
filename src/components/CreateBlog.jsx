import React, { useState, useEffect } from "react";
import Editor from "react-simple-wysiwyg";
import { useForm } from "react-hook-form";
import { useNavigate } from "react-router-dom";
import { toast } from "react-toastify";

const CreateBlog = () => {
  const [html, setHtml] = useState("");
  const [imageId, setImageId] = useState("");
  const [categories, setCategories] = useState([]);  // State to store the categories fetched from the API
  const [selectedCategory, setSelectedCategory] = useState("");   // State to hold the selected category

  const onChange = (e) => {
    setHtml(e.target.value);
  };

  const navigate = useNavigate();

  const handleFileChange = async (e) => {
    const file = e.target.files[0];
    const formData = new FormData();
    formData.append("image", file);

    const res = await fetch("http://localhost:8000/api/save-temp-image/", {
      method: "POST",
      body: formData,
    });

    const result = await res.json();

    if (result.status == false) {
      alert(result.errors.image);
      e.target.value = null;
    }

    setImageId(result.image.id);
  };

  const {
    register,
    handleSubmit,
    formState: { errors },
  } = useForm();

  const formSubmit = async (data) => {
    const newData = { ...data, description: html, image_id: imageId };

    const res = await fetch("http://localhost:8000/api/blogs", {
      method: "POST",
      headers: {
        "Content-type": "application/json",
      },
      body: JSON.stringify(newData),
    });

    toast("Blog added successfully.");

    navigate("/");
  };

  useEffect(() => {
    const fetchCategories = async () => {
      try {
        const response = await fetch("http://localhost:8000/api/categories");
        const data = await response.json();
        setCategories(data);
      } catch (error) {
        console.error("Error fetching categories:", error);
      }
    };

    fetchCategories();
  }, []); // Empty dependency array means this effect runs only once after the initial render

  const handleChange = (event) => {
    setSelectedCategory(event.target.value);
  };

  return (
    <div className="container mb-5">
      <div className="d-flex justify-content-between pt-5 mb-4">
        <h4>Create Blog</h4>
        <a href="/" className="btn btn-dark">
          Back
        </a>
      </div>

      <div className="card border-0 shadow-lg">
        <form onSubmit={handleSubmit(formSubmit)}>
          <div className="card-body">
            <div className="mb-3">
              <label className="form-label">Title</label>
              <input
                {...register("title", { required: true })}
                type="text"
                className={`form-control ${errors.title && "is-invalid"}`}
                placeholder="Enter Blog Title"
              />
              {errors.title && (
                <p className="invalid-feedback">This field is required</p>
              )}
            </div>

            <div className="mb-3">
              <label className="form-label">Short Description</label>
              <textarea
                {...register("shortDesc")}
                cols="30"
                rows="5"
                className="form-control"
              ></textarea>
            </div>

            <div className="mb-3">
              <label className="form-label">Description</label>
              <Editor
                containerProps={{ style: { height: "500px" } }}
                value={html}
                onChange={onChange}
              />
            </div>

            <div className="mb-3">
              <label className="form-label">Image</label>
              <br />
              <input onChange={handleFileChange} type="file" />
            </div>

            <div className="mb-3">
              <label className="form-label">Category</label>
              <select
                {...register("category", { required: true })}
                className={`form-select ${errors.category && "is-invalid"}`}
                value={selectedCategory}
                onChange={handleChange}
              >
                <option value="">Select Category</option>
                {categories.map((category) => (
                  <option key={category.id} value={category.id}>
                    {category.name}
                  </option>
                ))}
              </select>
              {errors.category && (
                <p className="invalid-feedback">This field is required</p>
              )}
            </div>

            <div className="mb-3">
              <label className="form-label">Author</label>
              <input
                {...register("author", { required: true })}
                type="text"
                className={`form-control ${errors.author && "is-invalid"}`}
                placeholder="Enter Author Name"
              />
              {errors.author && (
                <p className="invalid-feedback">This field is required</p>
              )}
            </div>

            <button className="btn btn-dark">Create</button>
          </div>
        </form>
      </div>
    </div>
  );
};

export default CreateBlog;
