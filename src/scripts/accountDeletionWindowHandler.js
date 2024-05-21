const deleteBtn = document.getElementById('delete-btn');
const cancelBtn = document.getElementById('cancel-btn');
const deletionPassword = document.getElementsByName('deletionPassword')[0];
const confirmationDiv = document.querySelector('.confirmation-div');


deleteBtn.addEventListener('click', () => {confirmationDiv.style.display = 'flex'});
cancelBtn.addEventListener('click', () => {
    confirmationDiv.style.display = 'none';
    deletionPassword.value = '';
});
