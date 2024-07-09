<div class="card-body table-responsive p-0">
    <div class="d-flex justify-content-between mb-3">
        <div class="d-flex align-items-center">
            <div class="form-group mr-2">
                <input type="text" class="form-control" id="txtBuscar" placeholder="Buscar...">
            </div>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">
                <i class="fa fa-plus"></i> Agregar
            </button>
        </div>
    </div>
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombres</th>
                <th>Dirección</th>
                <th>Distrito</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="TbData">
            <!-- Aquí se llenará dinámicamente la tabla -->
        </tbody>
    </table>
</div>

<!-- Modal para agregar usuario -->
<div class="modal fade" id="modalAgregarUsuario" tabindex="-1" role="dialog" aria-labelledby="modalAgregarUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAgregarUsuarioLabel">Agregar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario de agregar usuario -->
                <form id="formAgregarUsuario" method="POST" action="Servicio/SUsuarios.php">
                    <div class="form-group">
                        <label for="agregarNombres">Nombres:</label>
                        <input type="text" class="form-control" id="agregarNombres" name="nombres">
                    </div>
                    <div class="form-group">
                        <label for="agregarDireccion">Dirección:</label>
                        <input type="text" class="form-control" id="agregarDireccion" name="direccion">
                    </div>
                    <div class="form-group">
                        <label for="agregarDistrito">Distrito:</label>
                        <select class="form-control" id="agregarDistrito" name="distrito">
                            <option value="">Seleccionar distrito</option>
                            <?php
                            $distritos = array("Ancón", "Ate", "Barranco", "Breña", "Carabayllo", "Chaclacayo", "Chorrillos", "Cieneguilla", "Comas", "El Agustino", "Independencia", "Jesús María", "La Molina", "La Victoria", "Lince", "Los Olivos", "Lurigancho", "Lurín", "Magdalena del Mar", "Miraflores", "Pachacámac", "Pucusana", "Pueblo Libre", "Puente Piedra", "Punta Hermosa", "Punta Negra", "Rímac", "San Bartolo", "San Borja", "San Isidro", "San Juan de Lurigancho", "San Juan de Miraflores", "San Luis", "San Martín de Porres", "San Miguel", "Santa Anita", "Santa María del Mar", "Santa Rosa", "Santiago de Surco", "Surquillo", "Villa El Salvador", "Villa María del Triunfo");
                            foreach ($distritos as $distrito) {
                                echo "<option value='$distrito'>$distrito</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="agregarCorreo">Correo:</label>
                        <input type="email" class="form-control" id="agregarCorreo" name="correo">
                    </div>
                    <div class="form-group">
                        <label for="agregarContrasena">Contraseña:</label>
                        <input type="password" class="form-control" id="agregarContrasena" name="contrasena">
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para editar usuario -->
<div class="modal fade" id="modalEditarUsuario" tabindex="-1" role="dialog" aria-labelledby="modalEditarUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarUsuarioLabel">Editar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario de editar usuario -->
                <!-- Formulario de editar usuario -->
                <form id="formEditarUsuario" method="POST" action="Servicio/SUsuarios.php">
                    <input type="hidden" id="editId" name="edit_id">
                    <div class="form-group">
                        <label for="editNombres">Nombres:</label>
                        <input type="text" class="form-control" id="editNombres" name="edit_nombres">
                    </div>
                    <div class="form-group">
                        <label for="editDireccion">Dirección:</label>
                        <input type="text" class="form-control" id="editDireccion" name="edit_direccion">
                    </div>
                    <div class="form-group">
                        <label for="editDistrito">Distrito:</label>
                        <input type="text" class="form-control" id="editDistrito" name="edit_distrito">
                    </div>
                    <div class="form-group">
                        <label for="editCorreo">Correo:</label>
                        <input type="email" class="form-control" id="editCorreo" name="edit_correo">
                    </div>
                    <div class="form-group">
                        <label for="editContrasena">Contraseña:</label>
                        <input type="password" class="form-control" id="editContrasena" name="edit_contrasena" value="">
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        getList('');

        // Evento cuando se envía el formulario de agregar usuario
        $("#formAgregarUsuario").submit(function(event) {
            event.preventDefault(); // Evita que se envíe el formulario automáticamente

            // Obtiene los valores de los campos del formulario
            var nombres = $("#agregarNombres").val();
            var direccion = $("#agregarDireccion").val();
            var distrito = $("#agregarDistrito").val();
            var correo = $("#agregarCorreo").val();
            var contrasena = $("#agregarContrasena").val();

            // Hace la solicitud AJAX para agregar un nuevo usuario
            $.ajax({
                url: "Servicio/SUsuarios.php",
                data: {
                    tipo: 'add',
                    nombres: nombres,
                    direccion: direccion,
                    distrito: distrito,
                    correo: correo,
                    contrasena: contrasena
                },
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    $('#modalAgregarUsuario').modal('hide'); // Cierra el modal después de agregar el usuario
                    getList(''); // Actualiza la lista de usuarios
                    Swal.fire({
                        icon: 'success',
                        title: 'Usuario agregado con éxito',
                        showConfirmButton: false,
                        timer: 1500
                    });
                },
                error: function(xhr, status) {
                    console.log("Error al agregar usuario:", status);
                }
            });
        });

        // Evento cuando se escribe en el campo de búsqueda
        $("#txtBuscar").on("keyup", function() {
            var busqueda = $(this).val();
            getList(busqueda);
        });
    });

    $(document).ready(function() {
        getList('');

        // Evento cuando se muestra el modal de edición de usuario
        $('#modalEditarUsuario').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Botón que activó el modal
            var userId = button.data('userid'); // ID del usuario obtenido del botón
            editarUsuario(userId);
        });

        // Evento cuando se envía el formulario de edición de usuario
        $("#formEditarUsuario").submit(function(event) {
            event.preventDefault(); // Evita que se envíe el formulario automáticamente

            // Hace la solicitud AJAX para actualizar los datos del usuario
            $.ajax({
                url: "Servicio/SUsuarios.php",
                data: $(this).serialize() + '&tipo=edit', // Serializa los datos del formulario y añade el tipo de solicitud
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    $('#modalEditarUsuario').modal('hide'); // Cierra el modal después de guardar cambios
                    getList(''); // Actualiza la lista de usuarios
                    Swal.fire({
                        icon: 'success',
                        title: 'Usuario editado con éxito',
                        showConfirmButton: false,
                        timer: 1500
                    });
                },
                error: function(xhr, status) {
                    console.log("Error al guardar cambios:", status);
                }
            });
        });
    });

    function getList(busqueda) {
        $.ajax({
            url: "Servicio/SUsuarios.php",
            data: {
                tipo: 'list',
                txtbus: busqueda
            },
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                let tabla = "";
                for (let i = 0; i < response.length; i++) {
                    tabla += "<tr>";
                    tabla += "<td>" + response[i]['id'] + '</td>';
                    tabla += "<td>" + response[i]['nombres'] + '</td>';
                    tabla += "<td>" + response[i]['direccion'] + '</td>';
                    tabla += "<td>" + response[i]['distrito'] + '</td>';
                    tabla += "<td>" + response[i]['correo'] + '</td>';
                    tabla += "<td>";
                    tabla += "<button class='btn btn-sm btn-info mr-2' data-userid='" + response[i]['id'] + "' data-toggle='modal' data-target='#modalEditarUsuario'><i class='fa fa-edit'></i> Editar</button>";
                    tabla += "<form method='POST' action='' class='d-inline'>";
                    tabla += "<input type='hidden' name='eliminar_id' value='" + response[i]['id'] + "'>";
                    tabla += "<button type='button' class='btn btn-sm btn-danger' onclick='eliminarUsuario(" + response[i]['id'] + ")'><i class='fa fa-trash'></i> Eliminar</button>";
                    tabla += "</form>";
                    tabla += "</td>";
                    tabla += "</tr>";
                }
                $("#TbData").html(tabla);
            },
            error: function(xhr, status) {
                console.log("Error en la solicitud AJAX:", status);
                var mensaje = "Ocurrió un error al obtener los datos. Por favor, inténtalo de nuevo más tarde.";
                if (xhr.responseText) {
                    mensaje += "\nDetalles del error: " + xhr.responseText;
                }
                alert(mensaje);
                $("#TbData").html("<tr><td colspan='6'>Error al obtener los datos.</td></tr>");
            }
        });
    }

    function editarUsuario(id) {
        $.ajax({
            url: "Servicio/SUsuarios.php",
            data: {
                tipo: 'get',
                id: id
            },
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log("Respuesta recibida del servidor:", response); // Agrega esto
                $("#editId").val(response.id);
                $("#editNombres").val(response.nombres);
                $("#editDireccion").val(response.direccion);
                $("#editDistrito").val(response.distrito);
                $("#editCorreo").val(response.correo);
                $("#editContrasena").val(response.contrasena); // Asigna un valor vacío a la contraseña
            },
            error: function(xhr, status) {
                console.log("Error al obtener datos del usuario:", status);
                console.log("Detalles del error:", xhr.responseText); // Agrega esto
            }
        });
    }

    function eliminarUsuario(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí, eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "Servicio/SUsuarios.php",
                    data: {
                        tipo: 'delete',
                        id: id
                    },
                    type: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        getList('');
                        Swal.fire({
                            icon: 'success',
                            title: 'Usuario eliminado con éxito',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    },
                    error: function(xhr, status) {
                        console.log("Error al eliminar usuario:", status);
                    }
                });
            }
        });
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .d-flex.justify-content-between.mb-3 {
        align-items: center;
    }

    .d-flex.justify-content-between.mb-3 .form-group {
        margin-bottom: 0;
        margin-left: 10px;
    }
</style>