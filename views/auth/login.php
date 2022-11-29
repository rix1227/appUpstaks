<div class="contenedor login">
    <h1 class="uptask">UpTask</h1>
    <P class="tagline">Crea y administra tus proyectos</P>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Iniciar Sesion</p>

        <form class="formulario" method="POST" action="/">
            <div class="campo">
                <label for="email">Email</label>
                <input type="email"
                       id="email"
                       placeholder="Tu email"
                       name="email">
            </div>

            <div class="campo">
                <label for="password">Password</label>
                <input type="password"
                       id="password"
                       placeholder="Tu Password"
                       name="password">
            </div>
        
                <input type="submit" class="boton" value="Iniciar Sesion">
        </form>

        <div class="acciones">
            <a href="/crear">Aun no tienes una cuenta? Obtener una</a>
            <a href="/olvide">¿Olvidaste tu contraseña? Recuperala</a>
        </div>
    </div> <!--CONTENEDOR-sm -->
</div>