<x-ladmin-auth-layout>
    <x-slot name="title">
        Edit Category
    </x-slot>

    <form action="{{ route('ladmin.article-category.update', $category->ulid ) }}" method="POST"> {{-- Arahkan route dengan benar sesuai yg sudah dibuat & tambahkan data ulid setelah route sebagai parameter --}}
        @csrf {{-- Wajib ada pada setiap FORM untuk membuat setiap Request menjadi aman --}}
        @method('PUT') {{-- Agar Metode POST nya menjadi PUT untuk mengubah data --}}
        <label for="" class="mb-3">Category Name</label>
        <input type="text" class="form-control mb-3" name="category_name" value="{{ $category->name }}"> {{-- Tambahkan nama pada value untuk diubah oleh user --}}
        <input type="text" class="form-control mb-3" name="state">
        <input type="text" class="form-control mb-3" name="type">
        <button type="submit" class="btn btn-primary">
            Update
        </button>
    </form>

</x-ladmin-auth-layout>
