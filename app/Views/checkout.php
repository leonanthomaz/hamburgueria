<?php
// print_r($cart);
echo "<pre>";
print_r($cart);
echo "********";
echo "<pre>";
print_r($client);

if(isset($_SESSION['total'])){
    $total = $_SESSION['total'];
}
?>

<?php foreach($cart as $item):?>            
    <h1><?php echo $item['p_nome'] ?></h1>
<?php endforeach; ?>

<?php foreach($client as $item):?>            
    <h1><?php echo $item['c_nome'] ?></h1>
<?php endforeach; ?>
