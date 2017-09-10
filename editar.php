<?php
require "topo.php";
require "class/Colaborador.php";

$url = $_SERVER["REQUEST_URI"];
$cd = end(explode("/", $url));
$colaborador = null;

/**
 * Seleciona o colaborador
 */
if (isset($cd)) {
    $colaborador = Colaborador::getPorCd($cd);
    if (!empty($colaborador)) {
        /**
         * Para pegar o primeiro da lista, afinal sempre irá retornar 1 quando existir
         */
        $colaborador = $colaborador[0];
        /**
         * Caso seja uma edição
         */
        if (isset($_POST['nome']) && isset($_POST['cpf']) && isset($_POST['dt_nascimento'])) {
            $colaborador->setDtNascimento($_POST['dt_nascimento']);
            $colaborador->setCpf($_POST['cpf']);
            $colaborador->setNome($_POST['nome']);
            if ($colaborador->update()) {
                $msg = "Registro alterado com sucesso.";
            } else {
                $msg = "Ocorreu um erro inesperado.";
            }
        }
    }
}
?>
<?php if ($colaborador) : ?>
    <div class="row">
        <div class="col-md-12">
            <h3>Editar Colaborador - <?= $colaborador->getNome() ?></h3>
        </div>
    </div>
    <div class="alert alert-danger erro hide" role="alert">
    </div>
    <?php if (isset($msg)) : ?>
        <div class="alert alert-info" role="alert">
            <?=$msg?>
        </div>
    <?php endif; ?>
    <div class="alert alert-danger success hide" role="alert">
    </div>
    <div class="row">
        <div class="col-md-12">
            <form method="post" id="form-colaborador" name="form-colaborador" action="#">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome"
                           value="<?= $colaborador->getNome() ?>">
                </div>
                <div class="form-group">
                    <label for="cpf">CPF:</label>
                    <input type="number" class="form-control" id="cpf" name="cpf"  onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="11" value="<?= $colaborador->getCpf() ?>">
                </div>
                <div class="form-group">
                    <label for="dt_nascimento">Data de Nascimento:</label>
                    <input type="text" class="form-control" name="dt_nascimento" id="dt_nascimento"
                           value="<?= date('d-m-Y', strtotime($colaborador->getDtNascimento())) ?>">
                </div>
                <button type="submit" class="btn btn-success">
                    <b>Enviar</b>
                </button>
                <a class="btn btn-primary" href="/index">
                    <b>Voltar</b>
                </a>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="/js/utils.js"></script>
    <script type="text/javascript" src="/js/colaborador.js"></script>
<?php else : ?>
    <div class="row">
        <div class="col-md-12">
            <h3>Editar Colaborador</h3>
        </div>

        <div class="col-md-12">
            <h5>Nenhum colaborador encontrado</h5>
        </div>
    </div>
<?php endif; ?>

<?php require "rodape.php" ?>
