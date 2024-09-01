<x-ladmin-auth-layout>  {{-- Tag x-ladmin-auth-layout adalah untuk memanggil Component layout, untuk file nya bisa kalian cek pada /latihan-article/Modules/Ladmin/Resources/views/components/layouts/auth-layout.blade.php --}}
    <x-slot name="title">{{ $title }}</x-slot> {{-- Sintak $title diambil dari variable $title pada file ArticleCategoryDatatable --}}
    {{-- @can berfungsi seperti IF ELSE, akan tetapi untuk melakukan check GATE ACCESS PERMISSIONS, jika memiliki akses maka akan menampilkan codingan dibawah, untuk akses permissions nya bisa di ubah pada ArticleCategoryMenu --}}
    {{-- @can(['ladmin.admin.create'])  --}}
        <x-slot name="button">
            <a href="{{ route('ladmin.article-category.create', ladmin()->back()) }}" class="btn btn-primary">&plus; Add New</a>
        </x-slot>
    {{-- @endcan --}}
    <x-ladmin-card>
        <x-slot name="body">
            <x-ladmin-data-tables :options="$options" :headers="$headers" /> {{-- Sintak ini adalah untuk memanggil component datatable --}}
        </x-slot>
    </x-ladmin-card>

</x-ladmin-auth-layout>