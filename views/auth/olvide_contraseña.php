<div class="contenedor olvide">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Recupera tu contraseña</p>

        <form class="formulario" method="POST" action="/olvide">
            <div class="campo">
                <label for="email">Email</label>
                <input type="email"
                       id="email"
                       placeholder="Tu email"
                       name="email">
            </div>
        
                <input type="submit" class="boton" value="Enviar instrucciones">
        </form>

        <div class="acciones">
            <a href="/">¿Ya tienes una cuenta? Inicia sesion</a>
            <a href="/crear">¿Aun no tienes una cuenta? Obtener una</a>
        </div>
    </div> <!--CONTENEDOR-sm -->
</div>