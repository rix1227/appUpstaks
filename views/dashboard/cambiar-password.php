<?php include_once __DIR__ . '/header-dashbord.php'; ?>

<div class="contenedor-sm">
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

    <a href="/perfil" class="enlace">Volver al perfil</a>

    <form class="formulario" method="POST" action="/cambiar-password">
        <DIV class="campo">
            <label for="nombre">Contraseña actual</label>
            <input 
                type="password"
                name="password_actual"
                placeholder="Tu contraseña actual">
        </DIV>

        <DIV class="campo">
            <label for="email">Contraseña nueva</label>
            <input 
                type="password"
                name="password_nuevo"
                placeholder="Escribe tu nueva contraseña ">
        </DIV>

        <input 
            type="submit" value="Guardar cambios">
    </form>
</div>
<?php include_once __DIR__ . '/footer-dashboard.php' ?>