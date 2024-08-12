<?php
require 'includes/config/database.php';
$db = conectarDB();

$errores = [];

//autenticar el usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (!$email) {
        $errores[] = 'El email no es valido';
    }

    if (!$password) {
        $errores[] = 'El password no es valido';
    }

    if (empty($errores)) {
        $query = "SELECT * FROM usuarios WHERE email = '{$email}'";
        $resultado = mysqli_query($db, $query);

        // var_dump($resultado);

        if ($resultado->num_rows) {
            $usuario = mysqli_fetch_assoc($resultado);
            $auth = password_verify($password, $usuario['password']);

            if ($auth) {
                //el usuario está autenticado
                session_start();

                $_SESSION['usuario'] = $usuario['email'];
                $_SESSION['login'] = true;

                header('Location: /bienesraices/admin/index.php');
            } else {
                $errores[] = 'La contraseña es incorrecta';
            }
        } else {
            $errores[] = 'El usuario no existe';
        }
    }

}


require 'includes/funciones.php';
incluirTemplate('header');
?>


<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar sesion</h1>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form method="POST" class="formulario">
        <fieldset>
            <legend>Email y password</legend>
            <label for="email">E-mail</label>
            <input id="email" name="email" type="email" placeholder="Tu email" required>

            <label for="password">Password</label>
            <input id="password" name="password" type="password" placeholder="Tu password" required>
        </fieldset>

        <input type="submit" value="Iniciar sesion" class="boton boton-verde">
    </form>
</main>

<?php
incluirTemplate('footer');
?>