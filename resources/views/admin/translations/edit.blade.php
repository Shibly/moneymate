<div class="container">
    <h1>Edit Translations for {{ strtoupper($code) }}</h1>

    <form action="{{ route('translations.update', $code) }}" method="POST">
        @csrf
        @method('PUT')

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Key</th>
                <th>Value</th>
                <th>Options</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($translations as $translation)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $translation->key }}</td>
                    <td>
                        <input type="text" name="translations[{{ $translation->id }}][value]" class="form-control"
                               value="{{ $translation->value ?? '' }}" required>
                    </td>
                    <td>
                        <!-- Optionally, you can add any extra buttons or actions here -->
                        <button type="button" class="btn btn-warning btn-sm edit-btn" data-id="{{ $translation->id }}">
                            Edit
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-success">Save Changes</button>
{{--        <a href="{{ route('translations.index') }}" class="btn btn-secondary">Cancel</a>--}}
    </form>
</div>

<script>
    // If you want an inline edit function (or confirmation), you can add a simple JavaScript function:
    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const translationId = this.getAttribute('data-id');
            const translationRow = this.closest('tr');
            const input = translationRow.querySelector('input');
            input.removeAttribute('readonly');
            input.focus();
        });
    });
</script>
