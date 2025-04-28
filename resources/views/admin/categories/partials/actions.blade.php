<button class="btn btn-info btn-sm edit-btn" data-id="{{ $category->id }}">
    <x-tabler-edit/>
    {{ get_translation('edit') }}
</button>
<button class="btn btn-danger btn-sm delete-btn" data-id="{{ $category->id }}">
    <x-tabler-trash/>
    {{ get_translation('delete') }}
</button>
