@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold">Categories</h1>
    <a href="{{ route('admin.categories.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Add Category</a>
</div>

<div class="bg-white rounded shadow">
    <table class="w-full">
        <thead>
            <tr class="border-b bg-gray-50">
                <th class="text-left py-3 px-4">ID</th>
                <th class="text-left py-3 px-4">Name</th>
                <th class="text-left py-3 px-4">Slug</th>
                <th class="text-left py-3 px-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr class="border-b">
                    <td class="py-3 px-4">{{ $category->id }}</td>
                    <td class="py-3 px-4">{{ $category->name }}</td>
                    <td class="py-3 px-4">{{ $category->slug }}</td>
                    <td class="py-3 px-4 flex gap-2">
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-blue-600">Edit</a>
                        <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $categories->links() }}</div>
@endsection