<?php 

$destacado = null;
$normales = [];

foreach($content as $streamer) {
    if($streamer['destacado']) $destacado = $streamer;
    else $normales[] = $streamer;
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
    <?php foreach($normales as $streamer): ?>
        <div class="col-md-3">
            <div class="card bg-primary-subtle text-center">
                
                <img src="<?= $streamer['avatar']; ?>" class="card-img-top rounded-circle mx-auto mt-3" alt="avatar" style="width:80px;height:80px;">
                <div class="card-body text-center">
                    <h5 class="card-title"><?= $streamer['username']; ?></h5>
                    <p class="card-text"><?= $streamer['nombre_real']; ?></p>
                    <span class="badge bg-primary"><?= number_format($streamer['followers']); ?> followers</span>
                </div>
                <form method="post" action="">
                    <input type="hidden" name="destacar_id" value="<?= $streamer['id']; ?>">
                    <button class="btn btn-success m-2" type="submit" name="action" value="destacar">Destacar</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>