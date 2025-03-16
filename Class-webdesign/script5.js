
let classActivities, midTerm, finalExam;


document.addEventListener('DOMContentLoaded', function() {
    
    classActivities = document.getElementById('ClassActivities');
    midTerm = document.getElementById('MidTerm');
    finalExam = document.getElementById('FinalExam');

    
    [classActivities, midTerm, finalExam].forEach(input => {
        input.addEventListener('input', function() {
            if (this.value > 100) this.value = 100;
            if (this.value < 0) this.value = 0;
        });
    });
});


function getValues() {
    return {
        activities: Number(classActivities.value) || 0,
        midterm: Number(midTerm.value) || 0,
        final: Number(finalExam.value) || 0
    };
}

function calculateTotal() {
    try {
        const values = getValues();
        const total = values.activities + values.midterm + values.final;
        
        document.getElementById('totalResult').value = total;
        alert(`Total marks: ${total}`);
        return total;
    } catch (error) {
        alert('Error calculating total. Please check your inputs.');
        console.error('Calculation error:', error);
        return 0;
    }
}

function calculateAverage() {
    try {
        const total = calculateTotal();
        const average = total / 3;
        
        document.getElementById('averageResult').value = average.toFixed(2);
        alert(`Average marks: ${average.toFixed(2)}`);
    } catch (error) {
        alert('Error calculating average. Please check your inputs.');
        console.error('Calculation error:', error);
    }
}