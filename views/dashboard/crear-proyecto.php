<?php include_once __DIR__ . '/header-dashbord.php'; ?>

<div class="contenedor-sm">
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

    <form class="formulario" method="POST" action="/crear-proyecto">
        
        <?php include_once __DIR__ . '/formulario-proyecto.php'; ?>
        <input type="submit" value="Crear Proyecto">
    </form>
</div>

<?php include_once __DIR__ . '/footer-dashboard.php' ?>