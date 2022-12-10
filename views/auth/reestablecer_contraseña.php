<div class="contenedor reestablecer">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Coloca tu nueva contraseña</p>

        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

        <?php if($mostrar) { ?>

        <form class="formulario" method="POST">
            <!--
            <div class="campo">
                <label for="email">Email</label>
                <input type="email"
                       id="email"
                       placeholder="Tu email"
                       name="email">
            </div>
        -->
            <div class="campo">
                <label for="password">Password</label>
                <input type="password"
                       id="password"
                       placeholder="Tu Password"
                       name="password">
            </div>
        
                <input type="submit" class="boton" value="Guardar contraseña">
        </form>

        <?php } ?>

        <div class="acciones">
            <a href="/crear">Aun no tienes una cuenta? Obtener una</a>
            <a href="/olvide">¿Olvidaste tu contraseña? Recuperala</a>
        </div>
    </div> <!--CONTENEDOR-sm -->
</div>