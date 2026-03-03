// Confirm delete before proceeding
function confirmDelete() {
    return confirm("Are you sure you want to delete this record?");
}


// Simple form validation for empty fields
function validateForm(form) {
    let inputs = form.querySelectorAll("input[required]");
    
    for (let i = 0; i < inputs.length; i++) {
        if (inputs[i].value.trim() === "") {
            alert("Please fill all required fields.");
            return false;
        }
    }

    return true;
}


// Show current date automatically in date fields (optional)
function setTodayDate(inputId) {
    const today = new Date().toISOString().split('T')[0];
    document.getElementById(inputId).value = today;
}