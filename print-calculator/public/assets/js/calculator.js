// This file contains JavaScript code for the dynamic calculator functionality.

document.addEventListener('DOMContentLoaded', () => {
    const materialSelect = document.getElementById('material');
    const formatSelect = document.getElementById('format');
    const finishingSelect = document.getElementById('finishing');
    const quantityInput = document.getElementById('quantity');
    const resultContainer = document.getElementById('result');
    const calculateButton = document.getElementById('calculate');

    calculateButton.addEventListener('click', async () => {
        const materialId = materialSelect.value;
        const formatId = formatSelect.value;
        const finishingId = finishingSelect.value;
        const quantity = quantityInput.value;

        if (!materialId || !formatId || !finishingId || !quantity) {
            alert('Por favor, preencha todos os campos.');
            return;
        }

        try {
            const response = await fetch(`/api/calculator?material=${materialId}&format=${formatId}&finishing=${finishingId}&quantity=${quantity}`);
            const data = await response.json();

            if (data.success) {
                resultContainer.innerHTML = `Preço Total: R$ ${data.price.toFixed(2)}`;
            } else {
                resultContainer.innerHTML = 'Erro ao calcular o preço.';
            }
        } catch (error) {
            console.error('Erro:', error);
            resultContainer.innerHTML = 'Erro ao calcular o preço.';
        }
    });
});