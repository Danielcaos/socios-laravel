@extends('layouts.index')

@section('content')
<body class="bg-gradient-primary">
    
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9 py-5">

                <div class="card o-hidden border-0 shadow-lg" style="top: 25%;">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block">
                                <img src="{{ asset('/img/login.jpg') }}" class="img-fluid" alt="...">
                            </div>
                            <div class="col-lg-6 py-5">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Bienvenido</h1>
                                    </div>
                                    <form class="user" method="POST" action="{{ route('login') }}">
                                    @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control @error('documento') is-invalid @enderror form-control-user"
                                                id="documento" placeholder="Documento" name="documento">
                                            @error('documento')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control @error('contraseña') is-invalid @enderror form-control-user " 
                                                id="password" placeholder="Contraseña" name="contraseña">
                                                @error('contraseña')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                        @if(!empty($data))
                                            <div class="alert alert-danger" role="alert">
                                                {{$data}}
                                            </div>
                                        @endif
                                        <button class="btn btn-primary btn-user btn-block" type="submit">
                                            Ingresar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    
</body>
@endsection
