@extends('layouts.app')

@section('main')

    <div class="container">
        <div class="float-end">
        <a href="/categories/create" class="btn btn-dark mt-3">New Category
        </a>
        </div>

        <table class="table table-hover mt-3">
            <thead>
                <tr>
                    <th>Sno.</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td><a href="/categories/{{ $category->id }}/show" class="text-dark"> {{$category->name }}</a></td>
                        <td>
                            <form action="/categories/{{ $category->id }}/delete" method="POST">
                                <a class="btn btn-primary" href="/categories/{{ $category->id }}/edit">Edit</a>

                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody> 
        </table>
    </div>
@endsection
