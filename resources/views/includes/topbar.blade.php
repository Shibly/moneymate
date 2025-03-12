<!-- Page header -->
<div class="navbar navbar-expand-md d-print-none">
    <div class="col-auto ms-auto d-print-none pe-3 pt-2">
        <div class="d-flex">
            <div class="nav-item dropdown ms-3">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                   aria-label="Open user menu">

                    @if(auth()->user()->profile_picture)
                    <span class="avatar avatar-sm"
                          style="background-image: url('{{ route('private.files', ['filename' => auth()->user()->profile_picture]) }}');"></span>
                    @endif

                    <div class="d-none d-xl-block ps-2">
                        <div>{{auth()->user()->name}}</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="{{route('profile.manage-profile')}}"
                       class="dropdown-item">{{get_translation('manage_profile')}}</a>
                    <a href="{{route('profile.change-password')}}"
                       class="dropdown-item">{{get_translation('change_password')}}</a>
                    <div class="dropdown-divider"></div>
                    <a href="{{route('logout')}}" class="dropdown-item">{{get_translation('log_out')}}</a>
                </div>
            </div>
        </div>
    </div>
</div>
