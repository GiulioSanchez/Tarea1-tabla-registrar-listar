<!doctype html>
<html lang="es">

<head>
  <title>Tabla de empleados</title>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
  <div class="container-fluid" style="max-width:100rem;">
    <div class="card mt-2">
      <div class="card-header bg-secondary text-light">Buscar Empleado</div>
      <div class="card-body">
        <form action="">

          <a href="registra-empleado.php"><button type="button" class="btn btn-warning btn-block mb-3">Registrar</button></a>
          <a href="buscador-empleado.php"><button type="button" class="btn btn-warning btn-block mb-3">Buscar</button></a>

          <div class="form-control mb-3 table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Sede</th>
                  <th>Apellidos</th>
                  <th>Nombres</th>
                  <th>Numero documento</th>
                  <th>Fecha Nacimiento</th>
                  <th>telefono</th>
                </tr>
              </thead>
              <tbody class="table-striped" id="tabla">
              </tbody>
            </table>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script>
    
    document.addEventListener("DOMContentLoaded", () => {
      function $(id) { return document.querySelector(id); }
      (function() {
                const tbody = $("tabla");

                const parametros = new FormData();

                parametros.append("operacion", "listar")

                fetch("../controllers/empleado.controller.php", {
                        method: "POST",
                        body: parametros
                    })
                    .then(respuesta => respuesta.json())
                    .then(datos => {
                        datos.forEach(element => {
                            const tr = document.createElement("tr");

                            const td_sede = document.createElement("td");
                            td_sede.textContent = element.idsede;
                            tr.appendChild(td_sede);

                            const td_apellido = document.createElement("td");
                            td_apellido.textContent = element.apellidos;
                            tr.appendChild(td_apellido);

                            const td_nombre = document.createElement("td");
                            td_nombre.textContent = element.nombres;
                            tr.appendChild(td_nombre);

                            const td_nrodocumento = document.createElement("td");
                            td_nrodocumento.textContent = element.nrodocumento;
                            tr.appendChild(td_nrodocumento);

                            const td_fechanac = document.createElement("td");
                            td_fechanac.textContent = element.fechanac;
                            tr.appendChild(td_fechanac);

                            const td_telefono = document.createElement("td");
                            td_telefono.textContent = element.telefono;
                            tr.appendChild(td_telefono);

                            tbody.appendChild(tr);
                        });
                    })
                    .catch(e => {
                        console.error(e);
                    });
            })();
    });
  </script>
</body>
</html>