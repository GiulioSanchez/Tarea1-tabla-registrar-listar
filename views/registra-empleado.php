<!DOCTYPE html>
<html lang="en">

<head>
  <title>Registrar empleado</title>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
  <div class="container">
    <div class="card mt-4 border-primary">
      <div class="card-header bg-warning text-light">Registar Empleado</div>

      <div class="card-body">
        <form action="" id="formRegEmp">
          <div class="mb-3">
            <label for="sede" class="form-lable">SEDES :</label>
            <select name="sede" id="sede" class="form-control form-select shadow" required>
              <option value="">Selecionar</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="apellidos" class="form-lable">Apellidos :</label>
            <input type="text" id="apellidos" class="form-control" required />
          </div>

          <div class="mb-3">
            <label for="nombres" class="form-lable">Nombres :</label>
            <input type="text" id="nombres" class="form-control" required />
          </div>

          <div class="row">
            <div class="col-md-4 mb-3">
              <label for="nrodoc" class="form-lable">Numero Documento :</label>
              <input minlength="8" type="text" id="nrodoc" class="form-control text-end" required />
            </div>

            <div class="col-md-4 mb-3">
              <label for="fechanac" class="form-lable">Fecha Nacimiento :</label>
              <input type="text" id="fechanac" class="form-control text-end" required placeholder="Año-Mes-Día"/>
            </div>

            <div class="col-md-4 mb-3">
              <label for="telefono" class="form-lable">Telefono :</label>
              <input type="text" id="telefono" class="form-control text-end" required minlength="9"/>
            </div>

            <div class="mb-3 text-end">
              <button class="btn btn-success" id="guardar" type="submit">
                GUARDAR DATOS
              </button>
              <button class="btn btn-danger" type="reset">CANCELAR</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      function $(id) {
        return document.querySelector(id);
      }

      (function() {

        fetch(`../controllers/sede.controller.php?operacion=listar`)
          .then(respuesta => respuesta.json())
          .then(datos => {
            console.log(datos)

            datos.forEach(element => {
              
              const tagOption = document.createElement("option");
              tagOption.value = element.idsede
              tagOption.innerHTML = element.sede
              $("#sede").appendChild(tagOption)
            });
          })
          .catch(e => {
            console.error(e)
          });
      })();

      $("#formRegEmp").addEventListener("submit", (event) => {
        event.preventDefault();

        if (confirm("Desea registrar empleado?")) {
          const parametros = new FormData();
          parametros.append("operacion", "add");

          parametros.append("idsede", $("#sede").value);
          parametros.append("apellidos", $("#apellidos").value);
          parametros.append("nombres", $("#nombres").value);
          parametros.append("nrodoc", $("#nrodoc").value);
          parametros.append("fechanac", $("#fechanac").value);
          parametros.append("telefono", $("#telefono").value);

          fetch(`../controllers/empleado.controller.php`, {
              method: "POST",
              body: parametros,
            })
            .then(respuesta => respuesta.text())
            .then(datos => {
              if (datos.idsede > 0) {
                $("#formRegEmp").reset();
                alert(`Empleado registrado con ID : ${datos.idempleado}`);
              }
            })
            .catch(e => {
              console.error(e);
            });
        }
      });
    })
  </script>
</body>

</html>