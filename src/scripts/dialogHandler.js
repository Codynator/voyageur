const destinationOpen = document.getElementById('btn-destination');
const dialogDestination = document.getElementById('dialog-destination');
const destinationClose = document.getElementById('btn-destination-close');

destinationOpen.addEventListener('click', () => {
    dialogDestination.showModal();
});
destinationClose.addEventListener('click', () => {
    dialogDestination.close();
});
