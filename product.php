<?php 
    include_once("helpers/url.php");
    include_once("templates/headerSearch.php");

    if(isset($_SESSION['filter'])) { 
        $data = $_SESSION['filter'];
    }else{
        $data = $_SESSION['products'];
    }

?>

    <div id="app" class="container">
        <?php if(isset($printMsg) && $printMsg != ""): ?> 
            <div id="msg">
                <button id="close-msg">
                    <img src="<?= $BASE_URL ?>assets/img/close-icon.svg" alt="Fechar">
                </button>
                <?= strval($printMsg) ?>
            </div>
        <?php endif; ?>

        <div class="header">
            <h2>Produtos</h2>

            <a id="add-product" href="<?= $BASE_URL ?>create.php">
                <i class="ph-plus ph-xl"></i>
                Adicionar Produto
            </a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Nome</th>
                    <th>Unidade de Medida</th>
                    <th>Valor</th>
                    <th>Data de Cadastro</th>
                    <th>Data de Alteração</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>  
            <?php if(count($products) > 0): ?>
                <?php foreach($data as $product): ?>
                    <tr>
                        <td><?= $product["cod_prod"]; ?></td>
                        <td><?= $product["name"]; ?></td>
                        <td><?= $product["measure"]; ?> </td>
                        <td><?= $product["price"]; ?></td>
                        <td><?= $product["created_at"]; ?></td>
                        <td><?= $product["updated_at"]; ?></td>
                        <td>
                            <a href="<?= $BASE_URL ?>update.php?id=<?=$product["id"]?>" class="btn-update" title="Atualizar" ><i class="ph-pencil ph-xl"></i> Atualizar</a>
                            <form class="delete" action="<?= $BASE_URL; ?>helpers/process.php" method="POST">
                                <input type="hidden" name="type" value="delete">
                                <input type="hidden" name="id" value="<?= $product["id"]; ?>">
                                <button class="btn-remove" title="Remover"> <i class="ph-trash ph-xl"></i> Remover</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="empty-table">
                    <div class="content">
                        <h2>Nenhum produto foi adicionado ainda.</h2>
                    </div>
                    </td>
                </tr>
            <?php endif; ?>     
            </tbody>            
        </table>
    </div>

    <div class="modal-wrapper">
        <div class="modal card">
            <button class="close" aria-label="close modal">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 6.41L17.59 5L12 10.59L6.41 5L5 6.41L10.59 12L5 17.59L6.41 19L12 13.41L17.59 19L19 17.59L13.41 12L19 6.41Z" fill="#0C3440" fill-opacity="0.6"/>
                </svg>                    
            </button>
        </div>
    </div>
<?php 
    include_once("templates/footer.php")
?>