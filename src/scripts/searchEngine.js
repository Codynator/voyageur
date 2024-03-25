const headerContainer = document.getElementsByClassName('header-container')[0];
const buttons = headerContainer.querySelectorAll('button');
const inputs = [];

const dialogs = headerContainer.querySelectorAll('dialog');
const dialogsConfirm = headerContainer.getElementsByClassName('btn-dialog-confirm');
const dialogsClose = headerContainer.getElementsByClassName('btn-dialog-close');
const airportRelated = headerContainer.getElementsByClassName('airport-related');
const airportRelatedInputs = airportRelated[1].querySelectorAll('input');


for (elm of airportRelated) {
    elm.style.display = 'none';
}

for (const [index, dialog] of dialogs.entries()) {
    inputs.push(dialog.querySelectorAll('input'));
    
    buttons[index].addEventListener('click', () => {
       openModal(dialog);
    });

    dialogsClose[index].addEventListener('click', (event) => {
        event.preventDefault();
        clearForm(inputs[index], buttons[index].querySelector('p'));
        closeModal(dialog);
    });

    dialogsConfirm[index].addEventListener('click', (event) => {
        event.preventDefault();
        const selectedVals = getValues(inputs[index]);
        presentValues(buttons[index].querySelector('p'), selectedVals);
        closeModal(dialog);
    });
}

inputs[1][0].addEventListener('change', () => {
    if (inputs[1][0].checked) {
        airportRelated[0].style.display = 'inline';
        airportRelated[1].style.display = 'block';
    } else {
        airportRelated[0].style.display = 'none';
        airportRelated[1].style.display = 'none';
        airportRelatedInputs.forEach(input => {
            input.checked = false;
        })
    }
});
