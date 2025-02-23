@extends('layout.master')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        {{$title}}
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="#" class="btn btn-primary btn-5 d-none d-sm-inline-block" data-bs-toggle="modal"
                           data-bs-target="#modal-report">
                            <x-tabler-language/>
                            Add New Language
                        </a>
                    </div>

                    <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add New Language</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <form id="add-language-form" action="{{ route('languages.store') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Language Name</label>
                                            <select name="name" id="langName" class="form-control select2">
                                                <option value="">Select Language</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country['name'] }} - {{ $country['code'] }}">
                                                        {{ $country['emoji'] }} {{ $country['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Cancel
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            <x-tabler-language/>
                                            Add New Language
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade modal-blur" id="modal-delete" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Confirm Deletion</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="icon mb-2 text-danger icon-lg">
                                        <path d="M12 9v4"></path>
                                        <path
                                            d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z">
                                        </path>
                                        <path d="M12 16h.01"></path>
                                    </svg>
                                    <h3>Are you sure you want to delete this language?</h3>
                                    <div class="text-secondary">This action cannot be undone.</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Cancel
                                    </button>
                                    <button type="button" class="btn btn-danger" id="confirm-delete">
                                        Yes, Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-body">
                    <div class="alert alert-info">
                        <span class="badge bg-blue-lt">Tip:</span>
                        You can add multiple languages to translate your application. Once you add a language, please
                        click the
                        <strong>Edit</strong> button next to it to provide your own translations.
                    </div>
                    <div class="table-responsive">
                        <table class="table datatable table-striped table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">Name</th>
                                <th class="text-center">Code</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($languages as $language)
                                <tr>
                                    <td class="text-center">{{ $language->name }}</td>
                                    <td class="text-center">{{ $language->code }}</td>
                                    <td class="text-center">{{ $language->status ? 'Active' : 'Inactive' }}</td>
                                    <td class="text-center">

                                        <div class="d-flex justify-content-center">
                                            <a href="{{route('language.setDefault',$language->code)}}"
                                               class="btn btn-success me-2 {{ $language->is_default ? 'disabled' : '' }}">
                                                <x-tabler-zoom-reset/>
                                                Set Default
                                            </a>
                                            <a class="btn btn-primary me-2"
                                               href="{{ route('translations.edit', $language->code) }}">
                                                <x-tabler-language/>
                                                Edit
                                            </a>
                                            @if($language->id != 1)
                                                <form action="{{ route('languages.destroy', $language->id) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" type="submit">
                                                        <x-tabler-trash/>
                                                        Delete
                                                    </button>
                                                </form>
                                            @endif
                                        </div>

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
