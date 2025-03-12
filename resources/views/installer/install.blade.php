<!DOCTYPE html>
<html lang="en">
<head>
  <title>Install Doctor On Time</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" type="text/css" href="{{asset('installer/plugin/bootstrap-5/css/bootstrap.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('installer/plugin/bootstrap-icon/font/bootstrap-icons.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('installer/plugin/fontawesome-6/css/fontawesome.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('installer/plugin/fontawesome-6/css/all.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('installer/plugin/feather-icon/dist/feather-icons.css')}}">

  <!-- ========== Main Custom Css ================== -->
  <link rel="stylesheet" type="text/css" href="{{asset('installer/custom.css')}}">
</head>
<body>

<div class="container mt-4">
  <div class="card">
    <h5 class="card-header">Install Moneymate</h5>
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <h5 class="card-title">Server Requirements</h5>
          <table class="table table-bordered mt-4">
            <thead>
              <tr>
                <th>Requirement</th>
                <th class="text-center">Status</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>PHP >= 8.2</td>
                <td class="text-center">
                  @if($requirements['php_version'])
                    <i class="fa fa-check-circle text-success"></i>
                  @else
                    <i class="fa fa-times-circle text-danger"></i>
                  @endif
                </td>
              </tr>

              <tr>
                <td>OpenSSL PHP Extension</td>
                <td class="text-center">
                  @if($requirements['open_ssl_extension'])
                    <i class="fa fa-check-circle text-success"></i>
                  @else
                    <i class="fa fa-times-circle text-danger"></i>
                  @endif
                </td>
              </tr>

              <tr>
                <td>PDO PHP Extension</td>
                <td class="text-center">
                  @if($requirements['pdo_php_extension'])
                    <i class="fa fa-check-circle text-success"></i>
                  @else
                    <i class="fa fa-times-circle text-danger"></i>
                  @endif
                </td>
              </tr>

              <tr>
                <td>Mbstring PHP Extension</td>
                <td class="text-center">
                  @if($requirements['mbstring_php_extension'])
                    <i class="fa fa-check-circle text-success"></i>
                  @else
                    <i class="fa fa-times-circle text-danger"></i>
                  @endif
                </td>
              </tr>

              <tr>
                <td>Tokenizer PHP Extension</td>
                <td class="text-center">
                  @if($requirements['tokenizer_php_extension'])
                    <i class="fa fa-check-circle text-success"></i>
                  @else
                    <i class="fa fa-times-circle text-danger"></i>
                  @endif
                </td>
              </tr>

              <tr>
                <td>XML PHP Extension</td>
                <td class="text-center">
                  @if($requirements['xml_php_extension'])
                    <i class="fa fa-check-circle text-success"></i>
                  @else
                    <i class="fa fa-times-circle text-danger"></i>
                  @endif
                </td>
              </tr>

              <tr>
                <td>Ctype PHP Extension</td>
                <td class="text-center">
                  @if($requirements['ctype_php_extension'])
                    <i class="fa fa-check-circle text-success"></i>
                  @else
                    <i class="fa fa-times-circle text-danger"></i>
                  @endif
                </td>
              </tr>

            </tbody>
          </table>
        </div>
        <div class="col-md-6">
          <h5 class="card-title">Database Credentials</h5>

          @error('db_error')
          <div class="alert alert-danger">
            <strong>Error:</strong> {{ $message }}
          </div>
          @enderror

          @if (Session('error'))
            <p class="text-danger">{{ session('error') }}</p>
          @endif
          <form method="POST" action="{{ route('install') }}" class="mt-4">
            @csrf
            <div class="mb-3">
              <label for="db_name" class="form-label">Database Name:</label>
              <input type="text" name="db_name" value="{{old('db_name')}}" id="db_name" class="form-control" placeholder="Enter database name" >
              @error('db_name')
                <span class="text-danger"> <i class="fa fa-warning"></i> {{ $message }}</span>
              @enderror
            </div>

            <div class="mb-3">
              <label for="db_user" class="form-label">Database Username:</label>
              <input type="text" name="db_user" value="{{old('db_user')}}" id="db_user" class="form-control" placeholder="Enter database username" >
              @error('db_user')
              <span class="text-danger"> <i class="fa fa-warning"></i> {{ $message }}</span>
              @enderror
            </div>

            <div class="mb-3">
              <label for="db_password" class="form-label">Database Password:</label>
              <input type="text" name="db_password" value="{{old('db_password')}}" id="db_password" class="form-control" placeholder="Enter database password">
              @error('db_password')
              <span class="text-danger"> <i class="fa fa-warning"></i> {{ $message }}</span>
              @enderror
            </div>

            <div class="mb-3">
              <label for="db_host" class="form-label">Database Host:</label>
              <input type="text" name="db_host" value="{{old('db_host', '127.0.0.1')}}" id="db_host" class="form-control" placeholder="Enter database host" >
              @error('db_host')
              <span class="text-danger"> <i class="fa fa-warning"></i> {{ $message }}</span>
              @enderror
            </div>

            <div class="mb-3">
              <label for="db_port" class="form-label">Database Port:</label>
              <input type="text" name="db_port" value="{{old('db_port', '3306')}}" id="db_port" class="form-control" >
              @error('db_port')
              <span class="text-danger"> <i class="fa fa-warning"></i> {{ $message }}</span>
              @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100" {{ !$allRequirementsMet ? 'disabled' : '' }}>Install</button>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>




<!--====================== Script ========================-->
<script type="text/javascript" src="{{asset('installer/js/jquery-3.7.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('installer/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('installer/plugin/bootstrap-5/js/bootstrap.min.js')}}"></script>

</body>
</html>
