/**
 * Created by luiz_ on 10/09/2017.
 */
$('#dt_nascimento').datepicker({
    format: 'dd-mm-yyyy'
});
$('#form-colaborador').submit(function (ev) {
    var erro = "";
    if ($("#nome").val().length <= 5) {
        erro += "Nome inválido, deve possuir no mínimo 5 caracteres.<br>";
    }
    if (!validarCPF($("#cpf").val())) {
        erro += "CPF inválido.<br>";
    }
    if (!validarDt($("#dt_nascimento").val())) {
        erro += "Data de nascimento inválida.<br>";
    }
    if (erro === ""){
        successValidation();
        return true;
    }

    erroValidation(erro);
    return false;
});

function erroValidation(msg) {
    $(".erro").show();
    $(".erro").text("");
    $(".erro").append(msg);
}
function successValidation() {
    $(".erro").hide();
    $(".erro").text("");
}