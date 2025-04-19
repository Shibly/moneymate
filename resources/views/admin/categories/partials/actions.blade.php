<button class="btn btn-info edit-btn" data-id="{{ $category->id }}">
    <x-tabler-edit/>
    {{ get_translation('edit') }}
</button>
<button class="btn btn-danger delete-btn" data-id="{{ $category->id }}">
    <x-tabler-trash/>
    {{ get_translation('delete') }}
</button>
