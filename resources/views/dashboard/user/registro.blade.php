@extends('layouts.dashboard')

@section('content')
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

                <!-- Sidebar -->
                @include('dashboard.user.nav.navs')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-0 text-gray-800">Registrar Invitado</h1>
                    <hr>
                    <div class="card shadow align-items-center justify-content-between mb-4">
                        <div class="card-body" style="width: 50%;">
                            <form class="user" action="{{ route('registro.user') }}" method="post" id="datosRegistro">
                                @csrf
                                
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="number" max="10" class="form-control form-control-user" id="cedula" name="cedula"
                                            placeholder="Cedula" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="nombre" name="nombre"
                                            placeholder="Nombre" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="ciudad" name="ciudad"
                                            placeholder="Ciudad" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control form-control-user" id="contacto" name="contacto"
                                            placeholder="Contacto">
                                    </div>
                                </div>
                                <button type="button" onclick="return registro()" class="btn btn-primary btn-user btn-block">
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