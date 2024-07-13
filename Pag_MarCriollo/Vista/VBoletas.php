<div class="card-body table-responsive p-0">
    <div class="d-flex justify-content-between mb-3">
        <div class="d-flex align-items-center">
            <div class="form-group mr-2">
                <input type="text" class="form-control" id="txtBuscar" placeholder="Buscar...">
            </div>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarBoleta">
                <i class="fa fa-plus"></i> Agregar
            </button>
        </div>
    </div>
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>DNI</th>
                <th>Número de Cuotas</th>
                <th>Fecha de Emisión</th>
                <th>Pago Final</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="TbData">
            <!-- Aquí se llenará dinámicamente la tabla -->
        </tbody>
    </table>
</div>

<!-- Modal para agregar boleta -->
<div class="modal fade" id="modalAgregarBoleta" tabindex="-1" role="dialog" aria-labelledby="modalAgregarBoletaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAgregarBoletaLabel">Agregar Boleta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario de agregar boleta -->
                <form id="formAgregarBoleta" method="POST">
                    <input type="hidden" name="tipo" value="add">
                    <div class="form-group">
                        <label for="agregarNombre">Nombre:</label>
                        <input type="text" class="form-control" id="agregarNombre" name="nombre">
                    </div>
                    <div class="form-group">
                        <label for="agregarDni">DNI:</label>
                        <input type="text" class="form-control" id="agregarDni" name="dni">
                    </div>
                    <div class="form-group">
                        <label for="agregarNumeroDeCuotas">Número de Cuotas:</label>
                        <input type="text" class="form-control" id="agregarNumeroDeCuotas" name="numero_de_cuotas">
                    </div>
                    <div class="form-group">
                        <label for="agregarFechaEmision">Fecha de Emisión:</label>
                        <input type="date" class="form-control" id="agregarFechaEmision" name="fecha_emision">
                    </div>
                    <div class="form-group">
                        <label for="agregarPagoFinal">Pago Final:</label>
                        <input type="text" class="form-control" id="agregarPagoFinal" name="pago_final">
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para editar boleta -->
<div class="modal fade" id="modalEditarBoleta" tabindex="-1" role="dialog" aria-labelledby="modalEditarBoletaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarBoletaLabel">Editar Boleta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario de editar boleta -->
                <form id="formEditarBoleta" method="POST">
                    <input type="hidden" name="tipo" value="edit">
                    <input type="hidden" id="editId" name="edit_id">
                    <div class="form-group">
                        <label for="editNombre">Nombre:</label>
                        <input type="text" class="form-control" id="editNombre" name="edit_nombre">
                    </div>
                    <div class="form-group">
                        <label for="editDni">DNI:</label>
                        <input type="text" class="form-control" id="editDni" name="edit_dni">
                    </div>
                    <div class="form-group">
                        <label for="editNumeroDeCuotas">Número de Cuotas:</label>
                        <input type="text" class="form-control" id="editNumeroDeCuotas" name="edit_numero_de_cuotas">
                    </div>
                    <div class="form-group">
                        <label for="editFechaEmision">Fecha de Emisión:</label>
                        <input type="date" class="form-control" id="editFechaEmision" name="edit_fecha_emision">
                    </div>
                    <div class="form-group">
                        <label for="editPagoFinal">Pago Final:</label>
                        <input type="text" class="form-control" id="editPagoFinal" name="edit_pago_final">
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

        // Evento cuando se envía el formulario de agregar boleta
        $("#formAgregarBoleta").submit(function(event) {
            event.preventDefault(); // Evita que se envíe el formulario automáticamente

            // Prepara los datos del formulario para enviar mediante AJAX
            var formData = $(this).serialize();

            $.ajax({
                url: "Servicio/SBoletas.php",
                data: formData,
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    $('#modalAgregarBoleta').modal('hide'); // Cierra el modal después de agregar la boleta
                    getList(''); // Actualiza la lista de boletas
                    Swal.fire({
                        icon: 'success',
                        title: 'Boleta agregada con éxito',
                        showConfirmButton: false,
                        timer: 1500
                    });
                },
                error: function(xhr, status) {
                    console.log("Error al agregar boleta:", status);
                }
            });
        });

        // Evento cuando se muestra el modal de edición de boleta
        $('#modalEditarBoleta').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Botón que activó el modal
            var boletaId = button.data('boletaid'); // ID de la boleta obtenido del botón
            editarBoleta(boletaId);
        });

        // Evento cuando se envía el formulario de edición de boleta
        $("#formEditarBoleta").submit(function(event) {
            event.preventDefault(); // Evita que se envíe el formulario automáticamente

            // Prepara los datos del formulario para enviar mediante AJAX
            var formData = $(this).serialize();

            $.ajax({
                url: "Servicio/SBoletas.php",
                data: formData,
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    $('#modalEditarBoleta').modal('hide'); // Cierra el modal después de guardar cambios
                    getList(''); // Actualiza la lista de boletas
                    Swal.fire({
                        icon: 'success',
                        title: 'Boleta editada con éxito',
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
            url: "Servicio/SBoletas.php",
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
                    tabla += "<td>" + response[i]['dni'] + '</td>';
                    tabla += "<td>" + response[i]['numero_de_cuotas'] + '</td>';
                    tabla += "<td>" + response[i]['fecha_emision'] + '</td>';
                    tabla += "<td>" + response[i]['pago_final'] + '</td>';
                    tabla += '<td>';
                    tabla += '<button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditarBoleta" data-boletaid="' + response[i]['id'] + '"><i class="fa fa-edit"></i></button> ';
                    tabla += '<button class="btn btn-danger btn-sm" onclick="eliminarBoleta(' + response[i]['id'] + ')"><i class="fa fa-trash"></i></button>';
                    tabla += '</td>';
                    tabla += '</tr>';
                }
                $("#TbData").html(tabla);
            },
            error: function(xhr, status) {
                console.log("Error al obtener lista de boletas:", status);
            }
        });
    }

    function editarBoleta(id) {
        $.ajax({
            url: "Servicio/SBoletas.php",
            data: {
                tipo: 'get',
                id: id
            },
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $("#editId").val(response.id);
                $("#editNombre").val(response.nombre);
                $("#editDni").val(response.dni);
                $("#editNumeroDeCuotas").val(response.numero_de_cuotas);
                $("#editFechaEmision").val(response.fecha_emision);
                $("#editPagoFinal").val(response.pago_final);
            },
            error: function(xhr, status) {
                console.log("Error al obtener datos de la boleta:", status);
            }
        });
    }

    function eliminarBoleta(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "Servicio/SBoletas.php",
                    data: {
                        tipo: 'delete',
                        id: id
                    },
                    type: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        getList(''); // Actualiza la lista de boletas
                        Swal.fire({
                            icon: 'success',
                            title: 'Boleta eliminada con éxito',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    },
                    error: function(xhr, status) {
                        console.log("Error al eliminar boleta:", status);
                    }
                });
            }
        });
    }
</script>
