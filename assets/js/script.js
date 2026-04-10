document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form');
    form.addEventListener('submit', (e) => {
        const dataInput = document.getElementById('data_nascimento');
        if (!dataInput.value) {
            alert('Por favor, insira sua data de nascimento para continuar.');
            e.preventDefault(); // Cancela o envio do formulário 
        }
    });
});