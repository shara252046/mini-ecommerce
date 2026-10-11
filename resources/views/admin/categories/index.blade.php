@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold">📂 Manage Categories</h1>
    <a href="{{ route('admin.categories.create') }}" 
       class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        + Add Category
    </a>
</div>

<div class="bg-white rounded shadow">
    <table class="w-full">
        <thead>
            <tr class="border-b bg-gray-50">
                <th class="text-left py-3 px-4">ID</th>
                <th class="text-left py-3 px-4">Name</th>
                <th class="text-left py-3 px-4">Slug</th>
                <th class="text-left py-3 px-4">Products</th>
                <th class="text-left py-3 px-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-4">{{ $category->id }}</td>
                    <td class="py-3 px-4 font-bold">{{ $category->name }}</td>
                    <td class="py-3 px-4 text-gray-600">{{ $category->slug }}</td>
                    <td class="py-3 px-4">
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">
                            {{ $category->products_count }} products
                        </span>
                    </td>
                    <td class="py-3 px-4 flex gap-2">
                        <a href="{{ route('admin.categories.show', $category->id) }}" 
                           class="text-green-600 hover:underline">View</a>
                        <a href="{{ route('admin.categories.edit', $category->id) }}" 
                           class="text-blue-600 hover:underline">Edit</a>
                        <form method="POST" 
                              action="{{ route('admin.categories.destroy', $category->id) }}" 
                              onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-gray-600">No categories found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $categories->links() }}</div>
@endsection