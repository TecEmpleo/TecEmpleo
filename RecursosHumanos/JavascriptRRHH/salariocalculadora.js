document.addEventListener("DOMContentLoaded", function() {
    document.addEventListener("keydown", function(event) {
        const key = event.key;
        if (!isNaN(key) || key === '.' || key === ',') {
            appendToScreen(key);
        } else if (key === '+' || key === '-' || key === '*' || key === '/') {
            appendToScreen(key);
        } else if (key === 'Enter') {
            calculate();
        } else if (key === 'Backspace') {
            backspace();
        }
    });
});

function appendToScreen(value) {
    document.getElementById('screen').value += value;
}

function clearScreen() {
    document.getElementById('screen').value = '';
}

function backspace() {
    const screenValue = document.getElementById('screen').value;
    document.getElementById('screen').value = screenValue.slice(0, -1);
}

function calculate() {
    const expression = document.getElementById('screen').value;
    const result = eval(expression);
    document.getElementById('screen').value = result;
}