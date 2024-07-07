<div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombres</th>
                <th>Dirección</th>
                <th>Distrito</th>
                <th>Correo</th>
            </tr>
        </thead>
        <tbody id="TbData">
            <!-- Aquí se llenará dinámicamente la tabla -->
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
        // Al cargar la página, obtener la lista inicial
        getList('');
    });

    function getList(bus) {
        $.ajax({
            url: "Servicio/SUsuarios.php",
            data: {
                tipo: 'list',
                txtbus: bus
            },
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                // Procesar la respuesta JSON aquí
                let tabla = "";
                for (let i = 0; i < response.length; i++) {
                    tabla += "<tr>";
                    tabla += "<td>" + response[i]['id'] + '</td>';
                    tabla += "<td>" + response[i]['nombres'] + '</td>';
                    tabla += "<td>" + response[i]['direccion'] + '</td>';
                    tabla += "<td>" + response[i]['distrito'] + '</td>';
                    tabla += "<td>" + response[i]['correo'] + '</td>';
                    tabla += "</tr>";
                }
                $("#TbData").html(tabla);
            },
            error: function(xhr, status, error) {
                // Manejar errores de solicitud AJAX
                console.log("Error en la solicitud AJAX:", status, error);
                console.log("Respuesta completa:", xhr.responseText);
                $("#TbData").html("<tr><td colspan='5'>Error al obtener los datos.</td></tr>");
            }
        });

    }
</script>