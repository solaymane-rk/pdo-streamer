<h1>Lista de Streamers</h1>

<?php 
$destacado = null;
$normales = [];
foreach($content as $s) {
    if($s['destacado']) $destacado = $s;
    else $normales[] = $s;
}
?>

<?php if($destacado): ?>
    <div class="card mb-4" style="width: 18rem;">
        <img src="<?php echo $destacado['avatar']; ?>" class="card-img-top rounded-circle mx-auto mt-3" alt="avatar" style="width:100px;height:100px;">
        <div class="card-body text-center">
            <h5 class="card-title"><?php echo $destacado['username']; ?></h5>
            <p class="card-text"><?php echo $destacado['nombre_real']; ?></p>
            <span class="badge bg-warning"><?php echo number_format($destacado['followers']); ?> followers</span>
        </div>
    </div>
<?php endif; ?>

<div class="row g-4">
    <?php foreach($normales as $s): ?>
        <div class="col-md-3">
            <div class="card" style="width: 18rem;">
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