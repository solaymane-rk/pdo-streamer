<?php 
$destacado = null;
$normales = [];
foreach($content as $s) {
    if($s['destacado']) $destacado = $s;
    else $normales[] = $s;
}

?>

<h1>Lista de Streamers</h1>

<h2>Destacado</h2>

<div>
    <?php if($destacado): ?>
        <div class="card mb-4">
            <img src="<?php echo $destacado['avatar']; ?>" class="card-img-top rounded-circle mx-auto mt-3" alt="avatar" style="width:100px;height:100px;">
            <div class="card-body text-center">
                <h5 class="card-title"><?php echo $destacado['username']; ?></h5>
                <p class="card-text"><?php echo $destacado['nombre_real']; ?></p>
                <span class="badge bg-warning"><?php echo number_format($destacado['followers']); ?> followers</span>
            </div>
        </div>
    <?php endif; ?>
</div>

<h2>Otros Streamers</h2>

<div class="row g-4">
    <?php foreach($normales as $s): ?>
        <div class="col-md-3">
            <div class="card text-center">
                <form method="POST">
                    <input type="hidden" name="destacar_id" value="<?php echo $s['id']; ?>">
                    <button class="btn btn-success m-2" type="submit">Destacar</button>
                </form>
                <img src="<?php echo $s['avatar']; ?>" class="card-img-top rounded-circle mx-auto mt-3" alt="avatar" style="width:80px;height:80px;">
                <div class="card-body text-center">
                    <h5 class="card-title"><?php echo $s['username']; ?></h5>
                    <p class="card-text"><?php echo $s['nombre_real']; ?></p>
                    <span class="badge bg-primary"><?php echo number_format($s['followers']); ?> followers</span>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>