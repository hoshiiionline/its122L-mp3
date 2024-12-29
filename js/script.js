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
  var isConfirmed = confirm("Are you sure you want to delete this record?");
  
  if (isConfirmed) {
      alert("Record has been deleted!"); 
      return true; 
  }
  
  return false; 
}

// Function to confirm user edit
function confirmEditUser() {
  var isConfirmed = confirm("Are you sure you want to make changes to this record?");
  
  if (isConfirmed) {
      alert("Record has been updated!"); 
      return true; 
  }
  
  return false; 
}

function makeEditable() {
    // Make all form fields editable
    document.getElementById('firstName').removeAttribute('readonly');
    document.getElementById('lastName').removeAttribute('readonly');
    document.getElementById('email').removeAttribute('readonly');
    //document.getElementById('birthMonth').removeAttribute('readonly');
    //document.getElementById('birthDate').removeAttribute('readonly');
    //document.getElementById('birthYear').removeAttribute('readonly');
    
    // Enable gender radio buttons
    //document.getElementById('male').removeAttribute('disabled');
    //document.getElementById('female').removeAttribute('disabled');
    //document.getElementById('other').removeAttribute('disabled');
    
    // Change background color back to normal
    document.querySelectorAll('input[readonly]').forEach(function(input) {
        input.style.backgroundColor = '';
    });
    document.querySelectorAll('input[disabled]').forEach(function(input) {
        input.style.backgroundColor = '';
    });

    // Show Submit and Cancel buttons
    document.getElementById('actionButtons').style.display = 'block';

    document.getElementById('updateButton').style.display = 'none';
}

function switchChangePassword(){
    document.getElementById('change-details').style.display = 'none';

    document.getElementById('change-password').style.display = 'block';
}

function switchChangeDetails(){
    document.getElementById('change-details').style.display = 'block';

    document.getElementById('change-password').style.display = 'none';
}

// Initially set background color for readonly and disabled inputs
window.onload = function() {
    document.querySelectorAll('input[readonly]').forEach(function(input) {
        input.style.backgroundColor = '#f0f0f0';  // Light gray color
    });
    document.querySelectorAll('input[disabled]').forEach(function(input) {
        input.style.backgroundColor = '#f0f0f0';  // Light gray color
    });
};

function cancelEdit() {
    // Reset all fields to non-editable
    document.getElementById('firstName').setAttribute('readonly', true);
    document.getElementById('lastName').setAttribute('readonly', true);
    document.getElementById('email').setAttribute('readonly', true);
    //document.getElementById('birthMonth').setAttribute('readonly', true);
    //document.getElementById('birthDate').setAttribute('readonly', true);
    //document.getElementById('birthYear').setAttribute('readonly', true);

    // Disable gender radio buttons
    document.getElementById('male').setAttribute('disabled', true);
    document.getElementById('female').setAttribute('disabled', true);
    document.getElementById('other').setAttribute('disabled', true);

    // Change background color to gray for readonly and disabled fields
    document.querySelectorAll('input[readonly]').forEach(function(input) {
        input.style.backgroundColor = '#f0f0f0';  // Light gray color
    });
    document.querySelectorAll('input[disabled]').forEach(function(input) {
        input.style.backgroundColor = '#f0f0f0';  // Light gray color
    });

    // Hide Submit and Cancel buttons
    document.getElementById('actionButtons').style.display = 'none';

    document.getElementById('updateButton').style.display = 'block';
}