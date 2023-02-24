<?php
// echo "<pre>";
// print_r($data);
// echo "********";
?>

<h1>Compra finalizada com sucesso!</h1>

<?php foreach($data["info"] as $info): ?>
    <h1><?php echo $info["pd_codigo"] ?></h1>
<?php endforeach; ?>
