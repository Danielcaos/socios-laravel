

function registro() {
    cedula = document.getElementById('cedula').value;
    nombre = document.getElementById('nombre').value;
    email = document.getElementById('email').value;
    contraseña = document.getElementById('contraseña').value;

    var url = $("#registroUsuario").attr("action");
    var parametros = { cedula: cedula, nombre: nombre, email: email, contraseña: contraseña };

    if (cedula == "" || nombre == "" || email == "" || cedula == "") {
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Porfavor complete los campos',
            confirmButtonColor: '#2a6db3'
        })
    } else {
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            method: "POST",
            url: url,
            data: parametros,
            success: function (task) {
                if (task["response"]) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: task["message"],
                        showConfirmButton: false,
                        timer: 2000
                    })
                    setTimeout(function () {
                        location.reload();
                    }, 2000)
                } else {

                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: task["message"],
                        confirmButtonColor: '#2a6db3'
                    })
                }
            },
            error: function (r) {
                r.responseText;
                console.log(r);
                alert("Error del servidor");
            }
        });
    }
}

/* 

const URLD = "http://localhost/club/";

function verificarDatos(e) {
    e.preventDefault();v
    var documento = $('#documento').val();
    var password = $('#password').val();
    if (documento == "" || password == "") {
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Porfavor complete los campos',
            confirmButtonColor: '#2a6db3'
        })
    } else {
        httpRequest(URLD + "loginControl/validarDatos/" + documento + "/" + password, function () {
            console.log(this.responseText);
            var tasks = JSON.parse(this.responseText);

            console.log(tasks[1]);

            if (tasks[1] == false) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Datos incorrectos',
                    confirmButtonColor: '#2a6db3'
                })
            } else {
                window.location.href = URLD + "registroControl/render/";
            }
        });
    }

}



function presentacion(){
    codigo = document.getElementById('codigoi').value;
    cedula = document.getElementById('cedulai').value;
    fecha = document.getElementById('fechai').value;
    dias = document.getElementById('diasi').value;
    tipo = document.getElementById('tipoi').value;

    if (cedula == "" || codigo == "" || fecha == "" || dias == "") {
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Porfavor complete los campos',
            confirmButtonColor: '#2a6db3'
        })
    } else {
        $.ajax({
            type: "POST",
            url: URLD + "presentacionControl/presentaciong",
            data: $('#datosPresentacion').serialize(),
            success: function (data) {
                /* console.log(data);
                return; 
                var task = JSON.parse(data);
                console.log(task);
                if(task[0]){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Presentacion Registrada',
                        showConfirmButton: false,
                        timer: 2000
                    })
                    setTimeout(function () {
                        location.reload();
                    }, 2000)
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: task[1],
                        confirmButtonColor: '#2a6db3'
                    })
                }
            },
            error: function (r) {
                r.responseText;
                console.log(r);
                alert("Error del servidor");
            }
        });
    }
}

function alimento(){
    codigo = document.getElementById('codigob').value;
    cedula = document.getElementById('cedulab').value;
    fecha = document.getElementById('fechab').value;
    tipo = document.getElementById('tipob').value;
    if (cedula == "" || codigo == "" || fecha == "") {
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Porfavor complete los campos',
            confirmButtonColor: '#2a6db3'
        })
    } else {
        $.ajax({
            type: "POST",
            url: URLD + "presentacionControl/alimentog",
            data: $('#datosAlimento').serialize(),
            success: function (data) {
                var task = JSON.parse(data);
                console.log(task);
                if(task[0]){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Presentacion Registrada',
                        showConfirmButton: false,
                        timer: 2000
                    })
                    setTimeout(function () {
                        location.reload();
                    }, 2000)
                }else{
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: task[1],
                        confirmButtonColor: '#2a6db3'
                    })
                }
            },
            error: function (r) {
                r.responseText;
                console.log(r);
                alert("Error del servidor");
            }
        });
    }
}

function ausente(){
    codigo = document.getElementById('codigo').value;
    fecha = document.getElementById('fecha').value;
    dias = document.getElementById('dias').value;

    if (codigo == "" || fecha == "" || dias == "") {
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Porfavor complete los campos',
            confirmButtonColor: '#2a6db3'
        })
    } else {
        $.ajax({
            type: "POST",
            url: URLD + "ausenteControl/ausenteg",
            data: $('#datosAusente').serialize(),
            success: function (data) {
                /* console.log(data);
                return; 
                var task = JSON.parse(data);
                console.log(task);
                if(task[0]){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Ingreso Registrado',
                        showConfirmButton: false,
                        timer: 2000
                    })
                    setTimeout(function () {
                        location.reload();
                    }, 2000)
                }else{
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: task[1],
                        confirmButtonColor: '#2a6db3'
                    })
                }
            },
            error: function (r) {
                r.responseText;
                console.log(r);
                alert("Error del servidor");
            }
        });
    }
}

function httpRequest(url, callback) {
    const http = new XMLHttpRequest();
    http.open("GET", url);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            callback.apply(http);
        }
    }
} */