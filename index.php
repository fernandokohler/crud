<?php require "topo.php" ?>
<?php
require "class/Colaborador.php";
if (isset($_POST['nome']) && isset($_POST['cpf']) && isset($_POST['dt_nascimento'])) {
    $colaborador = new Colaborador();
    $colaborador->setDtNascimento($_POST['dt_nascimento']);
    $colaborador->setCpf($_POST['cpf']);
    $colaborador->setNome($_POST['nome']);
    if ($colaborador->save()) {
        $msg = "Registro criado com sucesso.";
    } else {
        $msg = "Ocorreu um erro inesperado.";
    }
    header('Location: /');
}
?>


    <div class="row">
        <div class="col-md-12">
            <h1>Colaborador</h1>
        </div>
    </div>
<?php if (isset($msg)) : ?>
    <div class="alert alert-info" role="alert">
        <?= $msg ?>
    </div>
<?php endif; ?>
    <div class="row">
        <div class="col-md-12">
            <h3>Lista</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#novo">
                <b>Novo</b>
            </button>
        </div>
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th class="text-center">
                        Nome
                    </th>
                    <th class="text-center">
                        CPF
                    </th>
                    <th class="text-center">
                        Nascimento
                    </th>
                    <th class="text-center">
                        Ação
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach (Colaborador::get() as $col) : ?>
                    <tr>
                        <td class="text-center"><?= $col->getNome() ?></td>
                        <td class="text-center"><?= $col->getCpf() ?></td>
                        <td class="text-center"><?= date('d-m-Y', strtotime($col->getDtNascimento())) ?></td>
                        <td class="text-center">
                            <a class="btn btn-primary" target="_blank" href="editar/<?= $col->getCdColaborador() ?>">Editar</a>
                            <a class="btn btn-danger"
                               onclick="return confirm('Deseja deletar o colaborador <?= $col->getNome() ?>?')"
                               href="excluir/<?= $col->getCdColaborador() ?>">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>

                </tfoot>
            </table>
        </div>
    </div>

    <div id="novo" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Novo Colaborador</h4>
                </div>
                <div class="modal-body">
                    <form method="post" id="form-colaborador" name="form-colaborador" action="#">
                        <div class="alert alert-danger erro hide" role="alert"></div>
                        <div class="form-group">
                            <label for="nome">Nome:</label>
                            <input type="text" class="form-control" id="nome" name="nome"
                                   value="">
                        </div>
                        <div class="form-group">
                            <label for="cpf">CPF:</label>
                            <input type="text" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="11" id="cpf" name="cpf"
                                   value="">
                        </div>
                        <div class="form-group">
                            <label for="dt_nascimento">Data de Nascimento:</label>
                            <input type="text" class="form-control" name="dt_nascimento" id="dt_nascimento"
                                   value="">
                        </div>
                        <button type="submit" class="btn btn-success">
                            <b>Enviar</b>
                        </button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    <script type="text/javascript" src="/js/utils.js"></script>
    <script type="text/javascript" src="/js/colaborador.js"></script>
<?php require "rodape.php" ?>