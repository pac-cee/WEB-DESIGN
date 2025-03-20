function calculateMarks() {
    // Get the numeric values (or default to 0 if empty)
    let courseWorks = parseFloat(document.getElementById('courseWorks').value) || 0;
    let midTerm = parseFloat(document.getElementById('midTerm').value) || 0;
    let finalExam = parseFloat(document.getElementById('finalExam').value) || 0;

    // Validate input ranges
    if (courseWorks < 0 || courseWorks > 30) {
        alert('Course Works marks must be between 0 and 30');
        document.getElementById('courseWorks').value = '';
        return;
    }

    if (midTerm < 0 || midTerm > 30) {
        alert('Mid Term marks must be between 0 and 30');
        document.getElementById('midTerm').value = '';
        return;
    }

    if (finalExam < 0 || finalExam > 40) {
        alert('Final Exam marks must be between 0 and 40');
        document.getElementById('finalExam').value = '';
        return;
    }

    // Calculate total (out of 100)
    let totalMarks = courseWorks + midTerm + finalExam;
    document.getElementById('total').value = totalMarks;

    // Average
    let average = totalMarks / 3;
    document.getElementById('average').value = average.toFixed(2);

    // Determine grade
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
}