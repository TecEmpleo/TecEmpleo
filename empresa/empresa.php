<?php
include 'conexionempresa.php';

$ciudades = array("Bogotá D.C", "Medellín", "Cali", "Barranquilla", "Cartagena", "Santa Marta", "Pereira", "Bucaramanga", "Cúcuta", "Ibagué", "Pasto", "Manizales", "Neiva", "Armenia", "Villavicencio", "Soledad", "Valledupar", "Montería", "Popayán", "Buenaventura", "Sincelejo", "Bello", "Barrancabermeja", "Tuluá", "Palmira", "Envigado", "Santa Cruz de Lorica", "Girardot", "Tumaco", "Facatativá", "Maicao", "Zipaquirá", "Florencia", "Puerto Tejada", "Riohacha", "Quibdó", "Arauca", "Sogamoso", "Duitama", "Magangué", "Girón", "Yopal", "Ipiales", "Tunja", "Ciénaga", "Villa del Rosario", "Ríohacha", "Chía", "Fusagasugá", "Granada", "Madrid", "Jamundí", "Cartago", "Turbo", "Aguachica", "Sabanalarga", "Yumbo", "Espinal", "Barrancas", "Lorica", "Santander de Quilichao", "Chinchiná", "Caldas", "Caucasia", "Villanueva", "Campo de la Cruz", "La Estrella", "Ubate", "Fundación", "Funza", "Chigorodó", "Ciénaga de Oro", "El Bagre", "Túquerres", "Montelíbano", "Patía", "Candelaria", "Ocaña", "Piedecuesta", "San Andrés", "La Virginia", "Ayapel", "La Unión", "San Marcos", "Villamaría", "Garzón", "El Carmen de Bolívar", "Florida", "Cimitarra", "La Tebaida", "Socorro", "Arjona", "La Jagua de Ibirico", "San Gil", "Chaparral", "Roldanillo",  "San Juan Nepomuceno", "San José del Guaviare", "La Plata", "El Cerrito", "San Carlos", "La Mesa", "San Onofre", "Pivijay", "Repelón", "San José de Cúcuta", "Guadalajara de Buga", "Soplaviento", "La Dorada", "Turbaco", "Chiquinquirá", "Aracataca", "La Cruz", "San Benito Abad", "Lebrija", "La Hormiga", "Galapa", "Purificación", "Pacho", "El Carmen de Viboral", "Plato", "Sabaneta", "El Banco", "El Santuario", "Villapinzón", "Rionegro", "La Ceja", "Sabanagrande", "Puerto Berrío", "El Retén", "Sahagún", "El Dovio", "Ciénaga", "Guacarí", "Yolombó", "San Pablo", "Buga", "Marinilla", "Sabanalarga", "Cereté", "Pamplona", "Líbano", "Ciénaga de Oro", "Samaniego", "Yopal", "Anserma", "Neira", "Villeta", "Espinal", "Chinú", "Santa Rosa de Cabal", "Pueblo Nuevo", "Samaná", "Jamundi", "Puerto Berrío", "Andes", "Planeta Rica", "Barbosa", "Honda", "Candelaria", "Túquerres", "Santo Tomás", "Vélez", "Carmen de Apicalá", "Istmina", "Villavieja", "Puerto López", "Granada", "Yarumal", "Campoalegre", "San Juan del Cesar");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["crear"])) {
        $ciudad = $_POST["ciudad"];
        $direccion = $_POST["direccion"];
        $email = $_POST["email"];
        $telefono = $_POST["telefono"];
        $nombreEmpresa = $_POST["nombreEmpresa"];
        $error = false;
        $errorEmail = '';
        $errorTelefono = '';

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorEmail = 'El correo electrónico no es válido';
            $error = true;
        }

        if (!ctype_digit($telefono)) {
            $errorTelefono = 'El teléfono solo debe contener números';
            $error = true;
        }

        if (!$error) {
            $sql = "INSERT INTO empresa (Ciudad_emp, Direccion_emp, Email_emp, Telefono_emp, Nombre_emp) VALUES ('$ciudad', '$direccion', '$email', '$telefono', '$nombreEmpresa')";
            if ($conn->query($sql) === TRUE) {
                echo '<script>$("#agregarEmpresaModal").modal("hide");</script>';
                echo '<span class="success-message">Empresa creada con éxito</span><br>';
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}
$sql = "SELECT * FROM empresa"; 
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Empresa Administracion</title>
  <link rel="stylesheet" href="../cssPanel/empresa.css">
    <link rel="shortcut icon" href="emp.png">
    <link rel="shortcut icon" href="favicon.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../cssPanel/panel.css">
</head>
<div class="menu-btn" onclick="toggleNav()">&#9776;</div>
<div id="myMenu" class="menu">
<div class="search-container">
    <form id="searchForm">
        <i class="ri-search-line"></i>
        <input type="text" id="searchInput" placeholder="Buscar...">
        <button type="button" onclick="searchFolders()">Buscar</button>
    </form>
</div>
<center>
    <a href="javascript:void(0)" class="close-btn" onclick="toggleNav()">&times;</a>
    <a href="../Administrador.php"><i class="ri-home-2-fill"></i>TecEmpleo</a>
    <a href="../categoria/categorias.php"><i class="ri-home-2-fill"></i>categorias</a>
    <a href="../vacante/vacante.php"><i class="ri-graduation-cap-fill"></i>Vacantes</a>
    
</div>
<body>
    <div class="container">
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#agregarEmpresaModal">
            Crear Empresa
        </button>

        <h1>Lista de Empresas</h1>
        <br>
        <form method="get" action="">
            <table>
            <tr>
            <td>
                <div class="form-group">
                    <input type="text" name="buscar" class="form-control" placeholder="Buscar por nombre de empresa">
                </div>
            </td>
             <td>

               <button type="submit" class="btn btn-primary mb-3">
                Buscar
               </button>
               
               
               <button type="button" class="btn btn-primary mb-3" onclick="window.history.back();">
                Volver
               </button>
            </td>
            </tr>
        </form>
        </table>
        <br>
        
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Ciudad</th>
                <th>Dirección</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Nombre de la Empresa</th>
                <th>Acciones</th>
            </tr>
            <?php
            $buscar = "";

            if (isset($_GET['buscar'])) {
                $buscar = $_GET['buscar'];
            }

            $sql = "SELECT * FROM empresa";
            if (!empty($buscar)) {
                $sql .= " WHERE Nombre_emp LIKE '%$buscar%'";
            }
            
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id_empresa"] . "</td>";
                    echo "<td>" . $row["Ciudad_emp"] . "</td>";
                    echo "<td>" . $row["Direccion_emp"] . "</td>";
                    echo "<td>" . $row["Email_emp"] . "</td>";
                    echo "<td>" . $row["Telefono_emp"] . "</td>";
                    echo "<td>" . $row["Nombre_emp"] . "</td>";
                    echo "<td><a href='editarempresa.php?id=" . $row["id_empresa"] . "'>Editar</a> | 
                          <a href='eliminarempresa.php?id=" . $row["id_empresa"] . "'>Eliminar</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No se encontraron empresas.</td></tr>";
            }
            ?>
        </table>
    </div>
<div class="modal fade" id="agregarEmpresaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear Empresa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="crearEmpresaForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                        <label for="ciudad">Ciudad:</label>
                        <select name="ciudad" class="form-control" required>
                            <?php
                            foreach ($ciudades as $ciudad_option) {
                                echo "<option value='$ciudad_option'>$ciudad_option</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="direccion">Dirección:</label>
                        <input type="text" name="direccion" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" name="email" id="email" class="form-control" required>
                        <span id="errorEmail" class="error-message"><?php echo $errorEmail; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono:</label>
                        <input type="text" name="telefono" id="telefono" class="form-control" required>
                        <span id="errorTelefono" class="error-message"><?php echo $errorTelefono; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="nombreEmpresa">Nombre de la Empresa:</label>
                        <input type="text" name="nombreEmpresa" class="form-control" required>
                    </div>
                    <button type="submit" name="crear" class="btn btn-primary btn-crear">Crear Empresa</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="../javascript/menu.js"></script>
<script src="../javascript/empresa.js"></script>
</body>
</html>
