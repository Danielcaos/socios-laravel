@extends('layouts.userDash')

@section('content')
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

                <!-- Sidebar -->
                @include('dashboard.user.nav.navs')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-0 text-gray-800">Invitados Resgistrados</h1>
                    <hr>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Dias Restantes del Invitado</h6>
                        </div>
                        <div class="card-body">
                            <form class="user" action="{{ route('registro.consulta') }}" method="post">
                            @csrf
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="number" class="form-control form-control-user {{ $errors->has('documento_invitado') ? ' is-invalid' : '' }}" id="documento_invitado" name="documento_invitado"
                                        placeholder="Documento invitado" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('documento_invitado') }}">
                                        @if ($errors->has('documento_invitado'))
                                            <span style="margin-bottom:18px" class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('documento_invitado') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-sm-6">
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Consultar
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Registros</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Cedula</th>
                                            <th>Nombre</th>
                                            <th>Ciudad</th>
                                            <th>Celular</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Cedula</th>
                                            <th>Nombre</th>
                                            <th>Ciudad</th>
                                            <th>Celular</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    @isset($invitados)
                                    @for($m = 0; $m < count($invitados); $m++)
                                        <tr>
                                            <td>{{$invitados[$m]->cedula}}</td>
                                            <td>{{$invitados[$m]->nombre}}</td>
                                            <td>{{$invitados[$m]->ciudad}}</td>
                                            <td>{{$invitados[$m]->celular}}</td>
                                        </tr>
                                    @endfor
                                    @endisset
                                    </tbody>
                                </table>
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