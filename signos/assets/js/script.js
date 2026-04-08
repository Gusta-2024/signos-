document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('signo-form');
    const inputData = document.getElementById('data_nascimento');

    form.addEventListener('submit', function(event) {
        // Obtém o valor da data
        const dataValor = inputData.value;

        // Validação básica: verifica se o campo está vazio
        if (!dataValor) {
            alert("Por favor, selecione uma data de nascimento válida.");
            event.preventDefault(); // Impede o envio do formulário
            return;
        }

        // Validação de data futura: não permite datas maiores que hoje
        const dataSelecionada = new DateTime(dataValor);
        const hoje = new DateTime();

        if (dataSelecionada > hoje) {
            alert("A data de nascimento não pode ser no futuro!");
            event.preventDefault();
            return;
        }
        
        console.log("Formulário validado com sucesso. Enviando para o PHP...");
    });
});