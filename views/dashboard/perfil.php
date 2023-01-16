<?php include_once __DIR__ . '/header-dashbord.php'; ?>

<div class="contenedor-sm">
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

    <a href="/cambiar-password" class="enlace">Cambiar contraseña</a>

    <form class="formulario" method="POST" action="/perfil">
        <DIV class="campo">
            <label for="nombre">Nombre</label>
            <input 
                type="text"
                value="<?php echo $usuario->nombre; ?>"
                name="nombre"
                placeholder="Tu nombre">
        </DIV>

        <DIV class="campo">
            <label for="email">Email</label>
            <input 
                type="email"
                value="<?php echo $usuario->email; ?>"
                name="email"
                placeholder="Escribe tu correo ">
        </DIV>

        <input 
            type="submit" value="Guardar cambios">
    </form>
</div>
<?php include_once __DIR__ . '/footer-dashboard.php' ?>