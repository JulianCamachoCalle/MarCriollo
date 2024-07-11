<div class="card-body table-responsive p-0">
    <div class="d-flex justify-content-between mb-3">
        <div class="d-flex align-items-center">
            <div class="form-group mr-2">
                <input type="text" class="form-control" id="txtBuscar" placeholder="Buscar...">
            </div>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">
                <i class="fa fa-plus"></i> Agregar
            </button>
        </div>
    </div>
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="TbData">
            <!-- Aquí se llenará dinámicamente la tabla -->
        </tbody>
    </table>
</div>

<!-- Modal para agregar producto -->
<div class="modal fade" id="modalAgregarProducto" tabindex="-1" role="dialog" aria-labelledby="modalAgregarProductoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAgregarProductoLabel">Agregar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario de agregar producto -->
                <form id="formAgregarProducto" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="agregarNombre">Nombre:</label>
                        <input type="text" class="form-control" id="agregarNombre" name="nombre">
                    </div>
                    <div class="form-group">
                        <label for="agregarDescripcion">Descripción:</label>
                        <input type="text" class="form-control" id="agregarDescripcion" name="descripcion">
                    </div>
                    <div class="form-group">
                        <label for="agregarPrecio">Precio:</label>
                        <input type="text" class="form-control" id="agregarPrecio" name="precio">
                    </div>
                    <div class="form-group">
                        <label for="agregarImagen">Imagen:</label>
                        <input type="file" class="form-control-file" id="agregarImagen" name="imagen">
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para editar producto -->
<div class="modal fade" id="modalEditarProducto" tabindex="-1" role="dialog" aria-labelledby="modalEditarProductoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarProductoLabel">Editar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario de editar producto -->
                <form id="formEditarProducto" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="editId" name="edit_id">
                    <div class="form-group">
                        <label for="editNombre">Nombre:</label>
                        <input type="text" class="form-control" id="editNombre" name="edit_nombre">
                    </div>
                    <div class="form-group">
                        <label for="editDescripcion">Descripción:</label>
                        <input type="text" class="form-control" id="editDescripcion" name="edit_descripcion">
                    </div>
                    <div class="form-group">
                        <label for="agregarPrecio">Precio:</label>
                        <input type="text" class="form-control" id="agregarPrecio" name="precio">
                    </div>
                    <div class="form-group">
                        <label for="editImagen">Imagen:</label>
                        <input type="file" class="form-control-file" id="editImagen" name="edit_imagen">
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

        // Evento cuando se envía el formulario de agregar producto
        $("#formAgregarProducto").submit(function(event) {
            event.preventDefault(); // Evita que se envíe el formulario automáticamente

            // Obtiene los valores de los campos del formulario
            var nombre = $("#agregarNombre").val();
            var descripcion = $("#agregarDescripcion").val();
            var foto = $("#agregarFoto").val();
            var precio = $("#agrePrecio").val();

            // Prepara los datos del formulario para enviar mediante AJAX
            var formData = new FormData(this);

            $.ajax({
                url: "Servicio/SProductos.php",
                data: formData,
                type: 'POST',
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    $('#modalAgregarProducto').modal('hide'); // Cierra el modal después de agregar el producto
                    getList(''); // Actualiza la lista de productos
                    Swal.fire({
                        icon: 'success',
                        title: 'Producto agregado con éxito',
                        showConfirmButton: false,
                        timer: 1500
                    });
                },
                error: function(xhr, status) {
                    console.log("Error al agregar producto:", status);
                }
            });
        });

        // Evento cuando se muestra el modal de edición de producto
        $('#modalEditarProducto').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Botón que activó el modal
            var productId = button.data('productid'); // ID del producto obtenido del botón
            editarProducto(productId);
        });

        // Evento cuando se envía el formulario de edición de producto
        $("#formEditarProducto").submit(function(event) {
            event.preventDefault(); // Evita que se envíe el formulario automáticamente

            // Prepara los datos del formulario para enviar mediante AJAX
            var formData = new FormData(this);

            $.ajax({
                url: "Servicio/SProductos.php",
                data: formData,
                type: 'POST',
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    $('#modalEditarProducto').modal('hide'); // Cierra el modal después de guardar cambios
                    getList(''); // Actualiza la lista de productos
                    Swal.fire({
                        icon: 'success',
                        title: 'Producto editado con éxito',
                        showConfirmButton: false,
                        timer: 1500
                    });
                },
                error: function(xhr, status) {
                    console.log("Error al guardar cambios:", status);
                }
            });
        });

        // Evento cuando se escribe en el campo de búsqueda
        $("#txtBuscar").on("keyup", function() {
            var busqueda = $(this).val();
            getList(busqueda);
        });
    });

    function getList(busqueda) {
    $.ajax({
        url: "Servicio/SProductos.php",
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
                tabla += "<td>" + response[i]['nombre'] + '</td>';
                // Mostrar solo una parte de la descripción y añadir botón para expandir
                tabla += "<td>";
                tabla += "<span class='descripcion-corta'>" + truncateText(response[i]['descripcion'], 50) + "</span>";
                tabla += "<span class='descripcion-completa' style='display: none;'>" + response[i]['descripcion'] + "</span>";
                tabla += "<button class='btn btn-link ver-mas-btn'>Ver más</button>";
                tabla += "</td>";
                tabla += "<td>" + response[i]['precio'] + '</td>';
                tabla += "<td><img src='imagenes/" + response[i]['imagen'] + "' class='img-thumbnail' style='max-width: 100px;'></td>";
                tabla += "<td>";
                tabla += "<button class='btn btn-sm btn-info mr-2' data-productid='" + response[i]['id'] + "' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-edit'></i> Editar</button>";
                tabla += "<form method='POST' action='' class='d-inline'>";
                tabla += "<input type='hidden' name='eliminar_id' value='" + response[i]['id'] + "'>";
                tabla += "<button type='button' class='btn btn-sm btn-danger' onclick='eliminarProducto(" + response[i]['id'] + ")'><i class='fa fa-trash'></i> Eliminar</button>";
                tabla += "</form>";
                tabla += "</td>";
                tabla += "</tr>";
            }
            $("#TbData").html(tabla);

            // Configuración del botón "Ver más"
            $(document).on('click', '.ver-mas-btn', function() {
                var btn = $(this);
                var descripcionCorta = btn.siblings(".descripcion-corta");
                var descripcionCompleta = btn.siblings(".descripcion-completa");
                
                // Alternar entre mostrar la descripción corta o completa
                if (descripcionCorta.is(':visible')) {
                    descripcionCorta.hide();
                    descripcionCompleta.show();
                    btn.text('Ver menos');
                } else {
                    descripcionCompleta.hide();
                    descripcionCorta.show();
                    btn.text('Ver más');
                }
            });
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

    // Función para truncar el texto de la descripción
    function truncateText(text, maxLength) {
        if (text.length > maxLength) {
            return text.substring(0, maxLength) + "...";
        } else {
            return text;
        }
    }


    function editarProducto(id) {
        $.ajax({
            url: "Servicio/SProductos.php",
            data: {
                tipo: 'get',
                id: id
            },
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log("Respuesta recibida del servidor:", response); 
                $("#editId").val(response.id);
                $("#editNombre").val(response.nombre);
                $("#editDescripcion").val(response.descripcion);
                $("#editPrecio").val(response.precio);
                // No se establece el valor del campo de imagen para evitar problemas de seguridad
            },
            error: function(xhr, status) {
                console.log("Error al obtener datos del producto:", status);
                console.log("Detalles del error:", xhr.responseText); // Agrega esto
            }
        });
    }

    function eliminarProducto(id) {
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
                    url: "Servicio/SProductos.php",
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
                            title: 'Producto eliminado con éxito',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    },
                    error: function(xhr, status) {
                        console.log("Error al eliminar producto:", status);
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