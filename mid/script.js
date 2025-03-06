// Student Marks Calculator functionality
document.addEventListener('DOMContentLoaded', function() {
    const totalBtn = document.getElementById('totalBtn');
    const resetBtn = document.getElementById('resetBtn');
    
    if (totalBtn) {
        totalBtn.addEventListener('click', calculateTotal);
    }
    
    if (resetBtn) {
        resetBtn.addEventListener('click', resetForm);
    }
    
    function calculateTotal() {
        const mark1 = parseFloat(document.getElementById('mark1').value) || 0;
        const mark2 = parseFloat(document.getElementById('mark2').value) || 0;
        
        // Calculate the total marks
        const total = mark1 + mark2;
        
        // Display the result
        alert(`Total marks: ${total}`);
        
        // You could also add the total to the form instead of using an alert
        // For example, create a result element in the HTML and update it here
    }
    
    function resetForm() {
        document.getElementById('marksForm').reset();
    }
});