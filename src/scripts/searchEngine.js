const headerContainer = document.getElementsByClassName('header-container')[0];
const buttons = headerContainer.querySelectorAll('button');
const inputs = headerContainer.querySelectorAll('input');

const dialogs = headerContainer.querySelectorAll('dialog');
const dialogsConfirm = headerContainer.getElementsByClassName('btn-dialog-confirm');
const dialogsClose = headerContainer.getElementsByClassName('btn-dialog-close');


for (const [index, dialog] of dialogs.entries()) {
    buttons[index].addEventListener('click', () => {
       openModal(dialog);
    });

    dialogsClose[index].addEventListener('click', (event) => {
        event.preventDefault();
        closeModal(dialog);
    });
}
