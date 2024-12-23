// opens confirmation pane if user wants to be redirected
function confirmRedirect() {
    var isConfirmed = confirm("Redirecting you to another page. Are you sure you want to continue?");
    
    if (isConfirmed) {
        alert("Redirecting you to another page..."); 
        return true; 
    }
    
    return false; 
}

// opens confirmation pane if user wants to submit registration form
function confirmRegister() {
    var isConfirmed = confirm("Are you sure you want to submit this form?");
    
    if (isConfirmed) {
        return true; 
    }
    
    return false; 
}