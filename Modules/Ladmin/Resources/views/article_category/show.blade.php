<x-ladmin-auth-layout>
    <x-slot name="title">
        Details Category
    </x-slot>

    <h1>
        {{ $category->name }} {{-- Memanggil column nama dari category --}}
    </h1>

    <form action="{{ route('ladmin.article-category.destroy', $category->ulid) }}" method="POST">
    @csrf
    @method('DELETE') {{-- Wajib tambahkan metodh DELETE untuk menghapus data --}}

    <a href="{{ route('ladmin.article-category.edit', $category->ulid) }}" class="btn btn-warning text-white">
        Edit
    </a>
    <button class="btn btn-danger text-white" type="submit">
        Delete
    </button>
    </form>

</x-ladmin-auth-layout>
