<x-ladmin-auth-layout>
    <x-slot name="title">
        Create Category
    </x-slot>

    <form action="{{ route('ladmin.article-category.store') }}" method="POST"> {{-- Arahkan route dengan benar sesuai yg sudah dibuat --}}
        @csrf {{-- Wajib ada pada setiap FORM untuk membuat setiap Request menjadi aman --}}

        <label for="" class="mb-3">Category Name</label>
        <input type="text" class="form-control mb-3" name="category_name">

        <button type="submit" class="btn btn-primary">
            Submit
        </button>
    </form>

</x-ladmin-auth-layout>
