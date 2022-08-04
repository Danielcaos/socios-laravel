function registro() {
    cedula = document.getElementById('cedula').value;
    nombre = document.getElementById('nombre').value;
    ciudad = document.getElementById('ciudad').value;
    contacto = document.getElementById('contacto').value;

    var url = $("#datosRegistro").attr("action");
    var parametros = { cedula: cedula, nombre: nombre, ciudad: ciudad, contacto: contacto };

    if (cedula == "" || nombre == "" || contacto == "") {
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