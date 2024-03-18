const destinationOpen = document.getElementById('btn-destination');
const dialogDestination = document.getElementById('dialog-destination');
const destinationClose = document.getElementById('btn-destination-close');
const destinationConfirm = document.getElementById('btn-destination-confirm');
const formDestination = document.getElementById('form-destination');


destinationOpen.addEventListener('click', () => {openModal(dialogDestination)});

destinationClose.addEventListener('click', () => {
    closeModal(dialogDestination);
    clearForm(formDestination, inputs[1], buttons[0].querySelector('p'));
});

destinationConfirm.addEventListener('click', () => {
    closeModal(dialogDestination);
    const val = formDestination.destination.value;
    fillInput(inputs[1], buttons[0].querySelector('p'), val);
});

