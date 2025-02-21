@extends('layout.master')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Edit Translations
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <!-- Additional header buttons can go here if needed -->
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Translation Strings ({{ strtoupper($code) }})
                    </h3>
                </div>
                <div class="card-body">
                    <!-- Professional Tip Message -->
                    <div class="alert alert-info">
                        <span class="badge bg-blue-lt">Tip:</span>
                        <span>
                            The <strong>Key</strong> column displays the original reference text. Please enter the corresponding translation in your preferred language in the <strong>Value</strong> field.
                        </span>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter table-striped">
                            <thead>
                            <tr>
                                <th style="width: 5%">#</th>
                                <th style="width: 25%">Key</th>
                                <th style="width: 50%">Value</th>
                                <th style="width: 20%">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($translations as $translation)
                                <tr>
                                    <td class="text-muted">{{ $loop->iteration }}</td>
                                    <td class="fw-bold">
                                        {{ $translation->key }}
                                    </td>
                                    <td>
                                        <input type="text"
                                               class="form-control translation-value"
                                               value="{{ $translation->value ?? '' }}"
                                               required>
                                    </td>
                                    <td>
                                        <a href="#"
                                           class="save-value btn btn-icon btn-bitbucket"
                                           data-code="{{ $code }}"
                                           data-key="{{ $translation->key }}"
                                           title="Save this translation">
                                            <x-tabler-device-floppy/>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        "use strict";
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.save-value').forEach(function (saveBtn) {
                saveBtn.addEventListener('click', function (e) {
                    e.preventDefault();

                    // Read data attributes
                    let code = this.dataset.code;
                    let translationKey = this.dataset.key;

                    // Find the input in the same row (closest <tr>)
                    let row = this.closest('tr');
                    let inputEl = row.querySelector('.translation-value');
                    let newValue = inputEl.value;

                    fetch("{{ route('translations.ajaxUpdate') }}", {
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            code: code,
                            key: translationKey,
                            value: newValue
                        })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                Swal.fire({
                                    title: 'Success!',
                                    text: data.message,
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: 'An error occurred while saving the translation.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        })
                        .catch(error => {
                            console.error("Error:", error);
                            Swal.fire({
                                title: 'Error',
                                text: 'Failed to save the translation. Please insert translated text.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        });
                });
            });
        });
    </script>
@endsection
