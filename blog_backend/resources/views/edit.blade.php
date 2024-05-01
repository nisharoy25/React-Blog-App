@extends('layouts.app')

@section('main')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-sm-8">
      <div class="card mt-5 p-3">
        <h3 class="text-muted">Category Edit #{{ $category->name }}</h3>
        <form method="POST" action="/categories/{{ $category->id }}/update">
          @csrf
          @method('PUT')
          <div class="form-group mb-3">
            <label>Name</label>
            <input type="text" name="name" 
            placeholder="Enter Category Name"
            class="form-control"
            value="{{ old('name', $category->name) }}" />
            @if($errors->has('name'))
            <span class="text-danger">{{  $errors->first('name')  }}</span>
            @endif
          </div>

          <div class="form-group mb-3">
            <label>Slug</label>
            <input type="text" name="slug" 
            placeholder="Enter Category Slug"
            class="form-control"
            value="{{ old('slug', $category->slug) }}" />
            @if($errors->has('slug'))
            <span class="text-danger">{{  $errors->first('slug')  }}</span>
            @endif
          </div>

          <div class="form-group mb-3">
            <label>Description</label>
           <textarea name="description" cols="10" rows="5" class="form-control"
           value="{{ old('description', $category->description) }}"></textarea>
           @if($errors->has('description'))
            <span class="text-danger">{{  $errors->first('description')  }}</span>
            @endif
          </div>

            <button type="submit" class="btn btn-dark mb-1">Submit</button>
          
          
        </form>
      </div>
    </div>
  </div>
</div>
@endsection