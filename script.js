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

const cards = document.querySelectorAll('.card');

cards.forEach(card => {
  card.addEventListener('click', () => {
    cards.forEach(c => c.classList.remove('active'));

    card.classList.add('active');
  });
});

//
document.addEventListener('DOMContentLoaded', () => {
  const cards = document.querySelectorAll('.card');

  cards.forEach(card => {
      card.addEventListener('click', () => {
          const altText = card.alt;

          // Send the alt text to the server using fetch
          fetch('alt_retrieve.php', {
              method: 'POST',
              headers: {
                  'Content-Type': 'application/x-www-form-urlencoded',
              },
              body: 'alt=' + encodeURIComponent(altText),
          })
          .then(response => response.text())
          .then(data => {
              console.log('PHP variable set:', data);
          })
          .catch(error => console.error('Error:', error));
      });
  });
});

// Function to confirm user deletion
function confirmDeleteUser() {
  var isConfirmed = confirm("Are you sure you want to delete this user?");
  
  if (isConfirmed) {
      alert("User has been deleted!"); 
      return true; 
  }
  
  return false; 
}

// Function to confirm user edit
function confirmEditUser() {
  var isConfirmed = confirm("Are you sure you want to make changes to user?");
  
  if (isConfirmed) {
      alert("User record has been updated!"); 
      return true; 
  }
  
  return false; 
}