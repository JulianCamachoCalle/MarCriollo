<div class="card-body table-responsive p-0">
    <div class="d-flex justify-content-between mb-3">
        <div class="d-flex align-items-center">
            <div class="form-group mr-2">
                <input type="text" class="form-control" id="txtBuscar" placeholder="Buscar...">
            </div>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarFactura">
                <i class="fa fa-plus"></i> Agregar
            </button>
        </div>
    </div>
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>RUC</th>
                <th>Razón Social</th>
                <th>Dirección Fiscal</th>
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

<!-- Modal para agregar factura -->
<div class="modal fade" id="modalAgregarFactura" tabindex="-1" role="dialog" aria-labelledby="modalAgregarFacturaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAgregarFacturaLabel">Agregar Factura</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario de agregar factura -->
                <form id="formAgregarFactura" method="POST">
                    <input type="hidden" name="tipo" value="add">
                    <div class="form-group">
                        <label for="agregarNombre">Nombre:</label>
                        <input type="text" class="form-control" id="agregarNombre" name="nombre">
                    </div>
                    <div class="form-group">
                        <label for="agregarRUC">RUC:</label>
                        <input type="text" class="form-control" id="agregarRUC" name="RUC">
                    </div>
                    <div class="form-group">
                        <label for="agregarRazonSocial">Razón Social:</label>
                        <input type="text" class="form-control" id="agregarRazonSocial" name="razon_social">
                    </div>
                    <div class="form-group">
                        <label for="agregarDireccionFiscal">Dirección Fiscal:</label>
                        <input type="text" class="form-control" id="agregarDireccionFiscal" name="direccion_fiscal">
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

<!-- Modal para editar factura -->
<div class="modal fade" id="modalEditarFactura" tabindex="-1" role="dialog" aria-labelledby="modalEditarFacturaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarFacturaLabel">Editar Factura</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario de editar factura -->
                <form id="formEditarFactura" method="POST">
                    <input type="hidden" name="tipo" value="edit">
                    <input type="hidden" id="editId" name="edit_id">
                    <div class="form-group">
                        <label for="editNombre">Nombre:</label>
                        <input type="text" class="form-control" id="editNombre" name="edit_nombre">
                    </div>
                    <div class="form-group">
                        <label for="editRUC">RUC:</label>
                        <input type="text" class="form-control" id="editRUC" name="edit_RUC">
                    </div>
                    <div class="form-group">
                        <label for="editRazonSocial">Razón Social:</label>
                        <input type="text" class="form-control" id="editRazonSocial" name="edit_razon_social">
                    </div>
                    <div class="form-group">
                        <label for="editDireccionFiscal">Dirección Fiscal:</label>
                        <input type="text" class="form-control" id="editDireccionFiscal" name="edit_direccion_fiscal">
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

        // Evento cuando se envía el formulario de agregar factura
        $("#formAgregarFactura").submit(function(event) {
            event.preventDefault(); // Evita que se envíe el formulario automáticamente

            // Prepara los datos del formulario para enviar mediante AJAX
            var formData = $(this).serialize();

            $.ajax({
                url: "Servicio/SFacturas.php",
                data: formData,
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    $('#modalAgregarFactura').modal('hide'); // Cierra el modal después de agregar la factura
                    getList(''); // Actualiza la lista de facturas
                    Swal.fire({
                        icon: 'success',
                        title: 'Factura agregada con éxito',
                        showConfirmButton: false,
                        timer: 1500
                    });
                },
                error: function(xhr, status) {
                    console.log("Error al agregar factura:", status);
                }
            });
        });

        // Evento cuando se muestra el modal de edición de factura
        $('#modalEditarFactura').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Botón que activó el modal
            var facturaId = button.data('facturaid'); // ID de la factura obtenido del botón
            editarFactura(facturaId);
        });

        // Evento cuando se envía el formulario de edición de factura
        $("#formEditarFactura").submit(function(event) {
            event.preventDefault(); // Evita que se envíe el formulario automáticamente

            // Prepara los datos del formulario para enviar mediante AJAX
            var formData = $(this).serialize();

            $.ajax({
                url: "Servicio/SFacturas.php",
                data: formData,
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    $('#modalEditarFactura').modal('hide'); // Cierra el modal después de guardar cambios
                    getList(''); // Actualiza la lista de facturas
                    Swal.fire({
                        icon: 'success',
                        title: 'Factura editada con éxito',
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
            url: "Servicio/SFacturas.php",
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
                    tabla += "<td>" + response[i]['RUC'] + '</td>';
                    tabla += "<td>" + response[i]['razon_social'] + '</td>';
                    tabla += "<td>" + response[i]['direccion_fiscal'] + '</td>';
                    tabla += "<td>" + response[i]['fecha_emision'] + '</td>';
                    tabla += "<td>" + response[i]['pago_final'] + '</td>';
                    tabla += '<td>';
                    tabla += '<button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditarFactura" data-facturaid="' + response[i]['id'] + '"><i class="fa fa-edit"></i></button> ';
                    tabla += '<button class="btn btn-danger btn-sm" onclick="eliminarFactura(' + response[i]['id'] + ')"><i class="fa fa-trash"></i></button>';
                    tabla += '</td>';
                    tabla += '</tr>';
                }
                $("#TbData").html(tabla);
            },
            error: function(xhr, status) {
                console.log("Error al obtener lista de facturas:", status);
            }
        });
    }

    function editarFactura(id) {
        $.ajax({
            url: "Servicio/SFacturas.php",
            data: {
                tipo: 'get',
                id: id
            },
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $("#editId").val(response.id);
                $("#editNombre").val(response.nombre);
                $("#editRUC").val(response.RUC);
                $("#editRazonSocial").val(response.razon_social);
                $("#editDireccionFiscal").val(response.direccion_fiscal);
                $("#editFechaEmision").val(response.fecha_emision);
                $("#editPagoFinal").val(response.pago_final);
            },
            error: function(xhr, status) {
                console.log("Error al obtener datos de la factura:", status);
            }
        });
    }

    function eliminarFactura(id) {
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
                    url: "Servicio/SFacturas.php",
                    data: {
                        tipo: 'delete',
                        id: id
                    },
                    type: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        getList(''); // Actualiza la lista de facturas
                        Swal.fire({
                            icon: 'success',
                            title: 'Factura eliminada con éxito',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    },
                    error: function(xhr, status) {
                        console.log("Error al eliminar factura:", status);
                    }
                });
            }
        });
    }
</script>
