<?php 
    include_once("templates/header.php")
?>
<div id="app" class="container">

    <a class="back" href="<?= $BASE_URL ?>product.php"> <i class="ph-arrow-left"></i> Voltar</a>

    <h2>Cadastrar Produto</h2>
 
    <form action="<?= $BASE_URL ?>helpers/process.php" method="POST">
        <input type="hidden" name="type" value="create"> 
        <div class="input-group">
            <label for="cod_prod">Codigo do produto</label>
            <input type="text" name="cod_prod" value="<?= $product["cod_prod"]; ?>" >
        </div>
        <div class="input-group">
            <label for="name">Nome</label>
            <input type="text" name="name" value="<?= $product["name"]?>" >
        </div>
        <div class="input-group">
            <label for="measure">Unidade de medida</label>
            <input type="text" name="measure" value="<?= $product["measure"] ?>" >
        </div>
        <div class="input-group">
            <label for="price">Preço</label>
            <input type="text" name="price" value="<?= $product["price"] ?>">
        </div>
        <button type="submit">Cadastrar</button>
    </form>
</div>
<?php 
    include_once("templates/footer.php")
?>