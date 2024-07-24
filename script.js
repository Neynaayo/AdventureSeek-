//FOR ADD TO CART FUNCTION
document.addEventListener('DOMContentLoaded', function() {
  // Get the modal
  var modal = document.getElementById("orderModal");

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];

  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    modal.style.display = "none";
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
  // Handle form submission
  const form = document.getElementById('order-form');
  form.addEventListener('submit', function(event) {
    event.preventDefault();

    const email = form.email.value;
    const method = form.method.value;

    // Simulate AJAX request
    fetch('orderdetails.php', {
      method: 'POST',
      body: new FormData(form)
    })
    .then(response => response.text())
    .then(responseText => {
      // Assuming response is HTML content
      document.body.insertAdjacentHTML('beforeend', responseText);

      // Set modal content
      document.getElementById('modal-email').textContent = email;
      document.getElementById('modal-method').textContent = method;

      // Show modal
      modal.style.display = "block";
    })
    .catch(error => console.error('Error:', error));
  });
} );

//admin page

function toggleSidebar(event) {
  if (event) {
    event.stopPropagation();
  }
  const sidebar = document.getElementById("sidebar");
  const overlay = document.getElementById("overlay");
  sidebar.classList.toggle("show");
  overlay.classList.toggle("active");

  if (sidebar.classList.contains("show")) {
    document.body.style.overflow = 'hidden';
  } else {
    document.body.style.overflow = 'auto';
  }
}

function showPage(page) {
  // Remove active class from all links
  document.querySelectorAll('.sidebar-list-item').forEach(item => {
    item.classList.remove('active');
  });

  // Add active class to the current link
  document.getElementById(`${page}-link`).classList.add('active');

  // Update the content of the main section
  document.getElementById("main-content").innerHTML = '<div class="loader"></div>';
  fetch(`adminHome.php?page=${page}`)
    .then(response => response.text())
    .then(data => {
      document.getElementById("main-content").innerHTML = data;
    })
    .catch(error => console.error('Error loading the page:', error));
}


// Set the dashboard as the default page to display
window.onload = function() {
  const params = new URLSearchParams(window.location.search);
  const page = params.get('page') || 'dashboard';
  showPage(page);
};

// Close sidebar when clicking outside on mobile
document.addEventListener('click', function(event) {
  const sidebar = document.getElementById("sidebar");
  const menuToggle = document.getElementById("menuToggle");
  
  if (window.innerWidth <= 768 && sidebar.classList.contains("show")) {
    if (!sidebar.contains(event.target) && event.target !== menuToggle) {
      toggleSidebar();
    }
  }
});
