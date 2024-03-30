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

// For each dialog element add opening, closing and confirming features to corresponding buttons.
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

// If in transport form the 'plane' option is choosen, show the form with airports.
inputs[1][0].addEventListener('change', () => {
    if (inputs[1][0].checked) {
        airportRelated[0].style.display = 'inline';
        airportRelated[1].style.display = 'block';
        for (let i = 1; i < inputs[1].length; i++) {
            inputs[1][i].checked = false;
            inputs[1][i].disabled = true;
        }
        airportRelatedInputs.forEach(input => {
            input.disabled = false;
        })
    } else {
        airportRelated[0].style.display = 'none';
        airportRelated[1].style.display = 'none';
        airportRelatedInputs.forEach(input => {
            input.checked = false;
        });
        for (let i = 1; i < inputs[1].length; i++) {
            inputs[1][i].disabled = false;
        }
    }
});
