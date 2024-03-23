function openModal(modal) {
    modal.showModal();
    modal.style.display = 'flex';
}


function closeModal(modal) {
    modal.close();
    modal.style.display = 'none';
}


function clearForm(form, input, par) {
    input.innerHTML = '';
    par.innerHTML = '';
    form.reset();
}


function fillInput(input, par, values) {
    input.value = values.join(', ');
    par.innerHTML = values.join(', ');
}


function getValues(inputs) {
    const values = [];

    for (const input of inputs) {
        if (input.checked) {
            values.push(input.value);
        }
    }

    return values;
}