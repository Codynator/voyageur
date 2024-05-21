const openFormBtn = document.getElementById('open-form-btn');
const closeFormBtn = document.querySelector('.btn-dialog-close');
const dialog = document.querySelector('dialog');

openFormBtn.addEventListener('click', () => { openModal(dialog) });
closeFormBtn.addEventListener('click', (event) => {
    event.preventDefault();
    closeModal(dialog)
});

document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
        event.preventDefault();
        closeModal(dialog);
    }
});