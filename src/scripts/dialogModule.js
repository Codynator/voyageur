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


function fillInput(input, par, val) {
    input.value = val;
    par.innerHTML = val;
}