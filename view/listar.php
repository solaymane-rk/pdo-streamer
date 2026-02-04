<?php 

$destacado = null;
$normales = [];

foreach($content as $s) {
    if($s['destacado']) $destacado = $s;
    else $normales[] = $s;
}

$visitas = $_SESSION['total_visitas'];
$username = $_SESSION['username'];

$username_formated = ucfirst($username);

$titulo = '';

if ($visitas == 1) {
    $titulo = "<h1>Bienvenido por primera vez {$username_formated}!</h1>";
} else {
    $titulo = <<<HTML
        <h1>Bienvenido de nuevo {$username_formated}! </h1>
        <p>Has visitado este sitio <b>{$visitas}</b> veces.</p>
        HTML;
}

?>

<div class="alert alert-secondary text-center">
    <h1><?= $titulo ?></h1>
</div>

<h2 class="text-success">Destacado</h2>

<div>
    <?php if($destacado): ?>
        <div class="card bg-success mb-4">
            <img src="<?= $destacado['avatar']; ?>" class="card-img-top rounded-circle mx-auto mt-3" alt="avatar" style="width:100px;height:100px;">
            <div class="card-body text-center">
                <h5 class="card-title"><?= $destacado['username']; ?></h5>
                <p class="card-text"><?= $destacado['nombre_real']; ?></p>
                <span class="badge bg-warning"><?= number_format($destacado['followers']); ?> followers</span>
            </div>
        </div>
    <?php endif; ?>
</div>

<h2 class="text-primary">Otros Streamers</h2>

<div class="row g-4">
    <?php foreach($normales as $s): ?>
        <div class="col-md-3">
            <div class="card bg-primary-subtle text-center">
                
                <img src="<?= $s['avatar']; ?>" class="card-img-top rounded-circle mx-auto mt-3" alt="avatar" style="width:80px;height:80px;">
                <div class="card-body text-center">
                    <h5 class="card-title"><?= $s['username']; ?></h5>
                    <p class="card-text"><?= $s['nombre_real']; ?></p>
                    <span class="badge bg-primary"><?= number_format($s['followers']); ?> followers</span>
                </div>
                <form method="POST">
                    <input type="hidden" name="destacar_id" value="<?= $s['id']; ?>">
                    <button class="btn btn-success m-2" type="submit">Destacar</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>