<?php
session_start();

include_once('includes/login_verification.php');
include_once('php_action/db_connect.php');
include_once('includes/header.php');
include_once('includes/navbar.php');

if (isset($_SESSION['message'])) {
    echo $_SESSION['message']['message'];
}

$sql = "SELECT * FROM itens";
$result = mysqli_query($conn, $sql);
?>
<div class="col-md-6 offset-md-2">
    <?php
    if (mysqli_num_rows($result) > 0) {

        while ($dados = mysqli_fetch_array($result)) :
    ?>
            <div class="card" style="width: 18rem;">

                <?php if ($_SESSION['logado']['level'] == 2) : ?>
                    <div class="container action_icon offset-md-8">
                        <a href="edit_product_form.php?id=<?= $dados['id'] ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                            </svg>
                        </a>
                        <a href="edit_product_form.php?id=<?= $dados['id'] ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                            </svg>
                        </a>
                    </div>
                <?php endif; ?>

                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h4 class="card-text"><?= $dados['title']; ?></h4>
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