const headerContainer = document.getElementsByClassName('header-container')[0];
const buttons = headerContainer.querySelectorAll('button');
console.log(buttons);
const inputs = headerContainer.querySelectorAll('input');

for (let i = 0; i < buttons.length; i++) {
    console.log(buttons[i]);
    console.log(inputs[i+1]);

    buttons[i].addEventListener('click', (event) => {
        event.preventDefault();
        inputs[i+1].value = `Lorem ${i}`;
    });
}
