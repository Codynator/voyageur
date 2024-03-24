const headerContainer = document.getElementsByClassName('header-container')[0];
const buttons = headerContainer.querySelectorAll('button');
const inputs = [];

const dialogs = headerContainer.querySelectorAll('dialog');
const dialogsConfirm = headerContainer.getElementsByClassName('btn-dialog-confirm');
const dialogsClose = headerContainer.getElementsByClassName('btn-dialog-close');
const airportRelated = headerContainer.getElementsByClassName('airport-related');

for (elm of airportRelated) {
    elm.style.display = 'none';
}

for (const [index, dialog] of dialogs.entries()) {
    buttons[index].addEventListener('click', () => {
       openModal(dialog);
    });

    dialogsClose[index].addEventListener('click', (event) => {
        event.preventDefault();
        closeModal(dialog);
    });
    inputs.push(dialog.querySelectorAll('input'));
}

inputs[1][0].addEventListener('change', () => {
    if (airportRelated[0].style.display === 'none') {
        airportRelated[0].style.display = 'inline';
        airportRelated[1].style.display = 'block';
    } else {
        airportRelated[0].style.display = 'none';
        airportRelated[1].style.display = 'none';
    }
});
