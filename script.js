// opens confirmation pane if user wants to be redirected
function confirmRedirect() {
    var isConfirmed = confirm("Redirecting you to another page. Are you sure you want to continue?");
    
    if (isConfirmed) {
        alert("Redirecting you to another page..."); 
        return true; 
    }
    
    return false; 
}