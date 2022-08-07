@extends('layouts.userDash')

@section('content')
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

                <!-- Sidebar -->
                @include('dashboard.user.nav.navs')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <h1 class="h3 mb-0 text-gray-800">Registrar Presentación</h1>
                    <hr>
                    <div class="card shadow align-items-center justify-content-between mb-4">
                        <div class="card-body" style="width: 50%;">
                            <form class="user" action="{{ route('registro.presentacion') }}" method="post" id="datosInvitado">
                                @csrf

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text"  class="form-control form-control-user {{ $errors->has('cedula') ? ' is-invalid' : '' }}"
                                         value="{{ old('cedula') }}" id="cedula" name="cedula"  placeholder="Cedula invitado" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                        @if ($errors->has('cedula'))
                                            <span style="margin-bottom:18px" class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('cedula') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text"  class="form-control form-control-user {{ $errors->has('codigo') ? ' is-invalid' : '' }}"
                                         value="{{ old('codigo') }}" id="codigo" name="codigo"  placeholder="Codigo socio" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                        @if ($errors->has('codigo'))
                                            <span style="margin-bottom:18px" class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('codigo') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="date" class="form-control form-control-user {{ $errors->has('fecha') ? ' is-invalid' : '' }}"
                                        value="{{ old('fecha') }}" id="fecha" name="fecha"  placeholder="Fecha">
                                        @if ($errors->has('fecha'))
                                            <span style="margin-bottom:18px" class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('fecha') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control form-control-user {{ $errors->has('dias') ? ' is-invalid' : '' }}"
                                        value="{{ old('dias') }}" id="dias" name="dias" placeholder="Dias">
                                        @if ($errors->has('dias'))
                                            <span style="margin-bottom:18px" class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('dias') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <input type="hidden" class="form-control form-control-user" id="tipoi" name="tipo" value="PRESENTACION">
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Guardar
                                </button>
                            </form>
                        </div>
                    </div>

                    <h1 class="h3 mb-0 text-gray-800">Restaurante</h1>
                    <hr>
                    <div class="card shadow align-items-center justify-content-between mb-4">
                        <div class="card-body" style="width: 50%;">
                            <form class="user" id="datosAlimento">
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control form-control-user" id="cedulab" name="cedulab"
                                            placeholder="Cedula invitado">
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="number" class="form-control form-control-user" id="codigob" name="codigob"
                                            placeholder="Codigo socio">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="date" class="form-control form-control-user" id="fechab" name="fechab"
                                        placeholder="Fecha">
                                </div>
                                <input type="hidden" class="form-control form-control-user" id="tipob" name="tipob" value="ALIMENTO">
                                <button type="button" onclick="return alimento()" class="btn btn-primary btn-user btn-block">
                                    Guardar
                                </button>
                            </form>
                        </div>
                    </div>
                    <!-- AQUI TODO EL CONTENIDO DEL INICIO -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('dashboard.user.nav.navi')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection