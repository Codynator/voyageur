function openModal(modal) {
    modal.showModal();
    modal.style.display = 'flex';
}


function closeModal(modal) {
    modal.close();
    modal.style.display = 'none';
}


function clearForm(inputs, par) {
    par.innerHTML = '';
    for (const input of inputs) {
        input.checked = false;
    }
}


function presentValues(par, values) {
    const vals = values.map(function(val) {
         return val = val.includes('"') ? val.slice(1, -1) : val;
    });
    par.innerHTML = vals.join(', ');
}


function getValues(inputs) {
    const values = [];

    for (const input of inputs) {
        if (input.checked) {
            values.push(input.value);
        }
    }

    return values;
}