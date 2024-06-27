<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $preguntas = array(
        "genero",
        "pregunta-trabajo",
        "preguntas-caracteristicas",
        "pregunta-problema",
        "preguntas-ayuda",
        "preguntas-cambio",
        "preguntas-presion",
        "preguntas-decisiones",
        "pregunta-liderazgo",
        "pregunta-responsabilidad",
        "pregunta-lider"
    );

    foreach ($preguntas as $pregunta) {
        if (!isset($_POST[$pregunta]) || empty(trim($_POST[$pregunta]))) {
            $mensajeError = "Por favor, responde todas las preguntas antes de enviar el formulario.";
            echo "<script>alert('".$mensajeError."'); window.location.href = 'pruebas.php';</script>";
            exit; 
        }
    }
    if (isset($_SESSION['respuestas_enviadas']) && $_SESSION['respuestas_enviadas'] === true) {
        $mensajeError = "Ya has enviado tus respuestas. No puedes enviarlas de nuevo.";
        echo "<script>alert('".$mensajeError."'); window.location.href = 'pruebas.php';</script>";
        exit; 
    } 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tecempleo";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die(json_encode(array("error" => "Conexión fallida: " . $conn->connect_error)));
    }

    if (isset($_SESSION['id'])) {
        $id_usuario = $_SESSION['id'];
    } else {
        die(json_encode(array("error" => "No se ha iniciado sesión. Por favor, inicie sesión primero.")));
    }

    $sql_check = "SELECT * FROM respuestas_encuesta WHERE id_usuario = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("i", $id_usuario);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        $_SESSION['respuestas_enviadas'] = true;
        die(json_encode(array("error" => "Ya se han enviado respuestas para este usuario.")));
    }

    $sql = "INSERT INTO respuestas_encuesta (id_usuario, genero, pregunta_trabajo, pregunta_caracteristicas, pregunta_problema, pregunta_ayuda, pregunta_cambio, pregunta_presion, pregunta_decisiones, pregunta_liderazgo, pregunta_responsabilidad, pregunta_lider) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die(json_encode(array("error" => "Error al preparar la consulta: " . $conn->error)));
    }
    $genero = $_POST['genero'];
    $pregunta_trabajo = $_POST['pregunta-trabajo'];
    $pregunta_caracteristicas = $_POST['preguntas-caracteristicas'];
    $pregunta_problema = $_POST['pregunta-problema'];
    $pregunta_ayuda = $_POST['preguntas-ayuda'];
    $pregunta_cambio = $_POST['preguntas-cambio'];
    $pregunta_presion = $_POST['preguntas-presion'];
    $pregunta_decisiones = $_POST['preguntas-decisiones'];
    $pregunta_liderazgo = $_POST['pregunta-liderazgo'];
    $pregunta_responsabilidad = $_POST['pregunta-responsabilidad'];
    $pregunta_lider = $_POST['pregunta-lider'];
    $stmt->bind_param("isssssssssss", $id_usuario, $genero, $pregunta_trabajo, $pregunta_caracteristicas, $pregunta_problema, $pregunta_ayuda, $pregunta_cambio, $pregunta_presion, $pregunta_decisiones, $pregunta_liderazgo, $pregunta_responsabilidad, $pregunta_lider);
    $stmt->execute();

    if ($stmt === false) {
        die(json_encode(array("error" => "Error al ejecutar la consulta: " . $conn->error)));
    }

    $stmt->close();
    $conn->close();

    $_SESSION['respuestas_enviadas'] = true;
    echo json_encode(array("success" => "¡Las respuestas se enviaron correctamente!"));
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pruebas | Psicotecnicas</title>
    <link rel="icon" href="img/Logo.png">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="../cssTecEmpleo/pruebas.css">
    <link rel="icon" href="../img/Logo.png">
</head>
<body>
<a href="../TecEmpleo.php" class="back-link"><i class="ri-arrow-go-back-line"></i></a>
<br>

<div class="contenedor-pruebas">
    <h1>¡Bienvenido A Nuestras Pruebas Psicotécnicas!</h1>
    <p>En este espacio podrás responder para analizar tu selección.</p>
    <br>
</div>
<br>
<form id="formulario-encuesta" method="POST">
    <div id="contenedor-genero" class="contenedor-centralizado">
        <h1>Seleccione su género:</h1>
        <div>
            <input type="radio" id="genero-hombre" name="genero" value="hombre">
            <label for="genero-hombre">Hombre</label>
        </div>
        <br>
        <div>
            <input type="radio" id="genero-mujer" name="genero" value="mujer">
            <label for="genero-mujer">Mujer</label>
        </div>
        <br>
        <div>
            <input type="radio" id="genero-no-especificado" name="genero" value="no-especificado">
            <label for="genero-no-especificado">No especificado</label>
        </div>
        <br>
        <button id="btn-siguiente-genero" type="button">Siguiente</button>
    </div>

       <div id="contenedor-otra-pregunta" class="contenedor-centralizado" style="display: none;">
        <h1>Ante un problema complejo en el trabajo, ¿cuál sería tu primera acción?</h1>
        <div>
            <input type="radio" id="pregunta" name="pregunta-problema" value="Intentar resolverlo por ti mismo.">
            <label for="pregunta">Intentar resolverlo por ti mismo.</label>
        </div>
        <br>
        <div>
            <input type="radio" id="pregunta-dos" name="pregunta-problema" value="Pedir ayuda a un colega.">
            <label for="pregunta-dos">Pedir ayuda a un colega.</label>
        </div>
        <br>
        <div>
            <input type="radio" id="pregunta-tres" name="pregunta-problema" value="Consultar recursos en línea.">
            <label for="pregunta-tres">Consultar recursos en línea.</label>
        </div>
        <br>
        <button id="btn-siguiente-pregunta" type="button">Siguiente</button>
        <button id="btn-atras" type="button">Atrás</button>
    </div>


    <div id="contenedor-otra-pregunta-2" class="contenedor-centralizado" style="display: none;">
    <h1>¿Cómo manejas las situaciones de alta presión en el trabajo?</h1>
    <div>
        <input type="radio" id="pregunta-1" name="pregunta-trabajo" value="Mantengo la calma y busco soluciones de manera sistemática">
        <label for="pregunta-1">Mantengo la calma y busco soluciones de manera sistemática.</label>
    </div>
    <br>
    <div>
        <input type="radio" id="pregunta-2" name="pregunta-trabajo" value="Busco apoyo en compañeros o superiores para resolver la situación">
        <label for="pregunta-2">Busco apoyo en compañeros o superiores para resolver la situación.</label>
    </div>
    <br>
    <div>
        <input type="radio" id="pregunta-3" name="pregunta-trabajo" value="Me resulta difícil manejar la presión y puedo sentirme abrumado">
        <label for="pregunta-3">Me resulta difícil manejar la presión y puedo sentirme abrumado.</label>
    </div>
    <br>
    <button id="btn-siguiente-pregunta-2" type="button">Siguiente</button>
    <button id="btn-atras-2" type="button">Atrás</button>
</div>

<div id="contenedor-otra-pregunta-3" class="contenedor-centralizado" style="display: none;">
    <h1>¿Qué característica es más importante para un líder efectivo?</h1>
    <div>
        <input type="radio" id="preguntas-1" name="preguntas-caracteristicas" value="La capacidad de resolver problemas">
        <label for="preguntas-1">La capacidad de resolver problemas.</label>
    </div>
    <br>
    <div>
        <input type="radio" id="preguntas-2" name="preguntas-caracteristicas" value="Inspirar y motivar a los miembros del equipo">
        <label for="preguntas-2">Inspirar y motivar a los miembros del equipo</label>
    </div>
    <br>
    <div>
        <input type="radio" id="preguntas-3" name="preguntas-caracteristicas" value="Manejar apropiadamente el trabajo en equipo">
        <label for="preguntas-3">Manejar apropiadamente el trabajo en equipo.</label>
    </div>
    <br>
    <button id="btn-siguiente-pregunta-3" type="button">Siguiente</button>
    <button id="btn-atras-3" type="button">Atrás</button>
</div>
    <div id="contenedor-otra-pregunta-4" class="contenedor-centralizado" style="display: none;">
        <h1>Como se relaciona con sus compañeros</h1>
        <div>
            <input type="radio" id="preguntas-uno" name="preguntas-ayuda" value="Apropiadamente">
            <label for="preguntas-uno">Apropiadamente</label>
        </div>
        <br>
        <div>
            <input type="radio" id="preguntas-dos" name="preguntas-ayuda" value="comunmente nos hacemos buenos amigos">
            <label for="preguntas-dos">comunmente nos hacemos buenos amigos.</label>
        </div>
        <br>
        <div>
            <input type="radio" id="preguntas-tres" name="preguntas-ayuda" value="Analizar la situación y buscar soluciones posibles.">
            <label for="preguntas-tres">Analizar la situación y buscar soluciones posibles</label>
        </div>
        <br>
        <button id="btn-siguiente-pregunta-4" type="button">Siguiente</button>
        <button id="btn-atras-4" type="button">Atrás</button>
    </div>

    <div id="contenedor-otra-pregunta-5" class="contenedor-centralizado" style="display: none;">
        <h1>¿Cómo reaccionarías si tuvieras que enfrentarte a un cambio repentino en el proceso de trabajo?</h1>
        <div>
            <input type="radio" id="preguntass-uno" name="preguntas-cambio" value="Resistir el cambio y tratar de mantener el proceso anterior.">
            <label for="preguntass-uno">Resistir el cambio y tratar de mantener el proceso anterior.</label>
        </div>
        <br>
        <div>
            <input type="radio" id="preguntass-dos" name="preguntas-cambio" value="Analizar la situación y buscar soluciones posibles.">
            <label for="preguntass-dos">Analizar la situación y buscar soluciones posibles.</label>
        </div>
        <br>
        <div>
            <input type="radio" id="preguntass-tres" name="preguntas-cambio" value="Esperar a que el cambio sea positivo y tomarlo con buena actitud.">
            <label for="preguntass-tres">Esperar a que el cambio sea positivo y tomarlo con buena actitud.</label>
        </div>
        <br>
        <button id="btn-siguiente-pregunta-5" type="button">Siguiente</button>
        <button id="btn-atras-5" type="button">Atrás</button>
    </div>

    <div id="contenedor-otra-pregunta-6" class="contenedor-centralizado" style="display: none;">
        <h1>¿Cómo manejarías una situación de alta presión en el trabajo donde hay múltiples demandas?</h1>
        <div>
            <input type="radio" id="preguntasss-uno" name="preguntas-presion" value="Pidiendo ayuda a los compañeros.">
            <label for="preguntasss-uno">Pidiendo ayuda a los compañeros.</label>
        </div>
        <br>
        <div>
            <input type="radio" id="preguntasss-dos" name="preguntas-presion" value="Intentar resolverlo por ti mismo.">
            <label for="preguntasss-dos"> Intentar resolverlo por ti mismo.</label>
        </div>
        <br>
        <div>
            <input type="radio" id="preguntasss-tres" name="preguntas-presion" value="Ignorando el estrés y esperando que desaparezca por sí solo.">
            <label for="preguntasss-tres">Ignorando el estrés y esperando que desaparezca por sí solo.</label>
        </div>
        <br>
        <button id="btn-siguiente-pregunta-6" type="button">Siguiente</button>
        <button id="btn-atras-6" type="button">Atrás</button>
</div>
    <div id="contenedor-otra-pregunta-7" class="contenedor-centralizado" style="display: none;">
        <h1>¿Cuál es tu enfoque al tomar decisiones importantes en el trabajo?</h1>
        <div>
            <input type="radio" id="preguntasss-1" name="preguntas-decisiones" value="Decidir rápidamente.">
            <label for="preguntasss-1">Decidir rápidamente.</label>
        </div>
        <br>
        <div>
            <input type="radio" id="preguntasss-2" name="preguntas-decisiones" value="Consultar con colegas y analizar todas las alternativas antes de decidir.">
            <label for="preguntasss-2">Consultar con colegas y analizar todas las alternativas antes de decidir.</label>
        </div>
        <br>
        <div>
            <input type="radio" id="preguntasss-3" name="preguntas-decisiones" value="Dejar que otros tomen las decisiones por ti.">
            <label for="preguntasss-3">Dejar que otros tomen las decisiones por ti.</label>
        </div>
        <br>
        <button id="btn-siguiente-pregunta-7" type="button">Siguiente</button>
        <button id="btn-atras-7" type="button">Atrás</button>
    </div>
    <div id="contenedor-otra-pregunta-8" class="contenedor-centralizado" style="display: none;">
    <h1>¿Qué cualidades crees que son importantes para ser un líder eficaz en un equipo de trabajo?</h1>
    <div>
        <input type="radio" id="pregunta-respuesta-1" name="pregunta-liderazgo" value="Autoritarismo y control estricto sobre los miembros del equipo.">
        <label for="pregunta-respuesta-1">Autoritarismo y control estricto sobre los miembros del equipo.</label>
    </div>
    <br>
    <div>
        <input type="radio" id="pregunta-respuesta-2" name="pregunta-liderazgo" value="Empatía y habilidades para motivar a los demás.">
        <label for="pregunta-respuesta-2">Empatía y habilidades para motivar a los demás.</label>
    </div>
    <br>
    <div>
        <input type="radio" id="pregunta-respuesta-3" name="pregunta-liderazgo" value="Evitar la delegación de responsabilidades para mantener el control.">
        <label for="pregunta-respuesta-3">Evitar la delegación de responsabilidades para mantener el control.</label>
    </div>
    <br>
    <button id="btn-siguiente-pregunta-8" type="button">Siguiente</button>
    <button id="btn-atras-8" type="button">Atrás</button>
</div>
    <div id="contenedor-otra-pregunta-9" class="contenedor-centralizado" style="display: none;">
        <h1>¿Qué acciones consideras importantes para demostrar compromiso en el trabajo?</h1>
        <div>
            <input type="radio" id="preguntas-1-respuesta" name="pregunta-responsabilidad" value="Asumir responsabilidades adicionales.">
            <label for="preguntas-1-respuesta">Asumir responsabilidades adicionales.</label>
        </div>
        <br>
        <div>
            <input type="radio" id="preguntas-2-respuesta" name="pregunta-responsabilidad" value="Cumplir con los plazos y compromisos establecidos.">
            <label for="preguntas-2-respuesta">Cumplir con los compromisos establecidos.</label>
        </div>
        <br>
        <div>
            <input type="radio" id="preguntas-3-respuesta" name="pregunta-responsabilidad" value="Evitar asumir responsabilidades para no arriesgarse.">
            <label for="preguntas-3-respuesta">Evitar asumir responsabilidades adicionales para no arriesgarse.</label>
        </div>
        <br>
        <button id="btn-siguiente-pregunta-9" type="button">Siguiente</button>
        <button id="btn-atras-9" type="button">Atrás</button>
    </div>
<div id="contenedor-otra-pregunta-10" class="contenedor-centralizado" style="display: none;">
        <h1>¿Qué cualidades crees que son importantes para ser un líder eficaz en un equipo de trabajo?</h1>
        <div>
            <input type="radio" id="preguntass-one" name="pregunta-lider" value="Autoritarismo y control estricto sobre los miembros del equipo.">
            <label for="preguntass-one">Autoritarismo y control estricto sobre los miembros del equipo.</label>
        </div>
        <br>
        <div>
            <input type="radio" id="preguntass-two" name="pregunta-lider" value="Empatía y habilidades para motivar a los demás.">
            <label for="preguntass-two">Empatía y habilidades para motivar a los demás.</label>
        </div>
        <br>
        <div>
            <input type="radio" id="preguntass-tree" name="pregunta-lider" value="Evitar la delegación de responsabilidades para mantener el control.">
            <label for="preguntass-tree">Evitar la delegación de responsabilidades para mantener el control.</label>
        </div>
        <br>
        <button id="btn-atras-10" type="button">Atrás</button>
        <button id="btn-enviar-respuestas" type="submit">Enviar Respuestas</button>
    </div>
</form>
<br>
<footer class="footer">
    <div class="copyright">
        &copy; 2023 TecEmpleo. Todos los derechos reservados.
    </div>
</footer>



<script src="javascriptPruebas/pruebas.js"></script>
</body>
</html>