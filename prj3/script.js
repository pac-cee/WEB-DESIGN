function validateInputs() {
    let courseWorks = parseFloat(document.getElementById('courseWorks').value) || 0;
    let midTerm = parseFloat(document.getElementById('midTerm').value) || 0;
    let finalExam = parseFloat(document.getElementById('finalExam').value) || 0;

    // Validate input ranges
    if (courseWorks < 0 || courseWorks > 30) {
        alert('Course Works marks must be between 0 and 30');
        document.getElementById('courseWorks').value = '';
        return null;
    }

    if (midTerm < 0 || midTerm > 30) {
        alert('Mid Term marks must be between 0 and 30');
        document.getElementById('midTerm').value = '';
        return null;
    }

    if (finalExam < 0 || finalExam > 40) {
        alert('Final Exam marks must be between 0 and 40');
        document.getElementById('finalExam').value = '';
        return null;
    }

    return { courseWorks, midTerm, finalExam };
}

function calculateTotal() {
    const marks = validateInputs();
    if (!marks) return;

    const totalMarks = marks.courseWorks + marks.midTerm + marks.finalExam;
    document.getElementById('total').value = totalMarks;
    return totalMarks;
}

function calculateAverage() {
    const totalMarks = calculateTotal();
    if (!totalMarks) return;

    const average = totalMarks / 3;
    document.getElementById('average').value = average.toFixed(2);
    return average;
}

function calculateGrade() {
    const totalMarks = calculateTotal();
    if (!totalMarks) return;

    let grade;
    if (totalMarks >= 70 && totalMarks <= 100) {
        grade = "A";
    } else if (totalMarks >= 60 && totalMarks < 70) {
        grade = "B";
    } else if (totalMarks >= 50 && totalMarks < 60) {
        grade = "C";
    } else {
        grade = "Failed";
    }
    document.getElementById('grade').value = grade;
    return grade;
}

/*
function calculateMarks() {
    // Define validation rules for each input field
    const validationRules = {
        courseWorks: { min: 0, max: 30 },
        midTerm: { min: 0, max: 30 },
        finalExam: { min: 0, max: 40 }
    };
    
    // Get and validate all input values
    const inputs = {};
    for (const [fieldId, rules] of Object.entries(validationRules)) {
        const value = parseFloat(document.getElementById(fieldId).value) || 0;
        
        if (value < rules.min || value > rules.max) {
            alert(`${fieldId.replace(/([A-Z])/g, ' $1').replace(/^./, str => str.toUpperCase())} marks must be between ${rules.min} and ${rules.max}`);
            document.getElementById(fieldId).value = '';
            return;
        }
        
        inputs[fieldId] = value;
    }
    
    // Calculate total marks
    const totalMarks = Object.values(inputs).reduce((sum, value) => sum + value, 0);
    document.getElementById('total').value = totalMarks;
    
    // Calculate average (dividing by number of assignments, not hardcoded 3)
    const average = totalMarks / Object.keys(inputs).length;
    document.getElementById('average').value = average.toFixed(2);
    
    // Determine grade using a more maintainable approach
    const gradeRanges = [
        { min: 70, max: 100, grade: "A" },
        { min: 60, max: 69, grade: "B" },
        { min: 50, max: 59, grade: "C" },
        { min: 0, max: 49, grade: "Failed" }
    ];
    
    const grade = gradeRanges.find(range => 
        totalMarks >= range.min && totalMarks <= range.max
    )?.grade || "Failed";
    
    document.getElementById('grade').value = grade;
} */