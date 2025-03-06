document.addEventListener('DOMContentLoaded', function() {
    // Get the calculate button and add event listener
    const calculateButton = document.querySelector('input[value="Calculate"]');
    calculateButton.addEventListener('click', calculateSum);

    // Add input event listeners for validation
    const num1Input = document.getElementById('num1');
    const num2Input = document.getElementById('num2');

    [num1Input, num2Input].forEach(input => {
        input.addEventListener('input', function() {
            // Only allow numbers and decimal point
            this.value = this.value.replace(/[^0-9.]/g, '');
        });
    });
});

function calculateSum() {
    // Get the input values
    let num1 = document.getElementById('num1').value;
    let num2 = document.getElementById('num2').value;

    // Validate inputs
    if (!num1 || !num2) {
        alert('Please enter both numbers!');
        return;
    }

    // Convert string inputs to numbers
    num1 = Number(num1);
    num2 = Number(num2);

    // Check if conversion was successful
    if (isNaN(num1) || isNaN(num2)) {
        alert('Please enter valid numbers!');
        return;
    }

    try {
        // Calculate sum
        let sum = num1 + num2;
        
        // Display result
        const resultInput = document.getElementById('result');
        resultInput.value = sum;

        // Show success message
        alert(`Calculation successful! Sum is: ${sum}`);

    } catch (error) {
        console.error('Calculation error:', error);
        alert('An error occurred during calculation.');
    }
}

// Reset function
function resetFields() {
    document.getElementById('num1').value = '';
    document.getElementById('num2').value = '';
    document.getElementById('result').value = '';
}

// Add reset button to HTML
document.addEventListener('DOMContentLoaded', function() {
    const cell13 = document.querySelector('.cell-13');
    const resetButton = document.createElement('input');
    resetButton.type = 'button';
    resetButton.value = 'Reset';
    resetButton.onclick = resetFields;
    cell13.querySelector('p').appendChild(resetButton);
});