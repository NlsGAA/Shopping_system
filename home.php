<?php
if (!isset($_SESSION['logado'])) {
    header('location: login.php');
}


include_once('php_action/db_connect.php');
include_once('includes/header.php');
include_once('includes/navbar.php');


$sql = "SELECT * FROM itens";
$result = mysqli_query($conn, $sql);
?>
<div class="col-md-6 offset-md-2">
    <?php
    if (mysqli_num_rows($result) > 0) {

        while ($dados = mysqli_fetch_array($result)) :
    ?>

            <div class="card" style="width: 18rem;">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h4 class="card-text"><?= $dados['name']; ?></h4>
                    <h4 class="iten_value"><?= $dados['value']; ?></h4>
                    <p class="card-text"><?= $dados['description']; ?></p>
                </div>
            </div>

    <?php
        endwhile;
    } else {
        echo 'Ainda não há nenhum item registrado!';
    }
    ?>
</div>
<?php include_once('includes/footer.php'); ?>