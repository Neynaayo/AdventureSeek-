
//mute video function

// Add to cart function
function addToCart(activity) {
    const custEmail = "<?php echo $_SESSION['email']; ?>";
  
    if (!custEmail) {
      alert('Please log in to add items to your cart.');
      return;
    }
  
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'addToCart.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  
    xhr.onload = function() {
      if (xhr.status === 200) {
        const response = xhr.responseText.trim();
        if (response === 'success') {
          Swal.fire({
            title: 'Success!',
            text: 'Activity added to cart successfully!',
            icon: 'success',
            confirmButtonText: 'Go to Cart'
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = 'cart.php'; // Redirect to cart page
            }
          });
        } else {
          Swal.fire({
            title: 'Error!',
            text: 'Error adding activity to cart.',
            icon: 'error',
            confirmButtonText: 'OK'
          });
        }
      }
    };
  
    xhr.onerror = function() {
      Swal.fire({
        title: 'Error!',
        text: 'Error adding activity to cart.',
        icon: 'error',
        confirmButtonText: 'OK'
      });
    };
  
    xhr.send(`activity=${encodeURIComponent(activity)}&custEmail=${encodeURIComponent(custEmail)}`);
  }



// Search Activities function FROM SEARCHING PAGE
function searchActivities() {
    var activitySearch = document.getElementById('SportType-search').value;
    var locationSearch = document.getElementById('location-search').value;
    
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var activities = JSON.parse(xhr.responseText);
                displayActivities(activities);
            } else {
                console.error('Error: ' + xhr.status);
            }
        }
    };
    
    xhr.open('GET', 'searchActivities.php?sportTypeSearch=' + encodeURIComponent(activitySearch) + '&locationSearch=' + encodeURIComponent(locationSearch));
    xhr.send();
}

// Function to display activities in the activities-container
function displayActivities(activities) {
    var activitiesContainer = document.getElementById('activities-container');
    activitiesContainer.innerHTML = ''; // Clear previous results

    if (activities.length > 0) {
        activities.forEach(function(activity) {
            var activityElement = document.createElement('div');
            activityElement.classList.add('activity');

            var activityImage = document.createElement('div');
            activityImage.classList.add('activity-image');
            activityImage.style.backgroundImage = 'url("img/' + activity.pic + '")';
            activityElement.appendChild(activityImage);

            var activityInfo = document.createElement('div');
            activityInfo.classList.add('activity-info');
            activityInfo.innerHTML = `
                <h3>${activity.ActivityName}</h3>
                <p>${activity.ActivityDescription}</p>
                <p>Price (Child): RM${activity.PriceChild}</p>
                <p>Price (Adult): RM${activity.PriceAdult}</p>
                <p>Location: ${activity.LocationName}</p>
                <p>Sport Type: ${activity.SportType}</p>
                <button onclick="addToCart('${activity.ActivityName}')">
                    <i class='fas fa-cart-plus'></i> Add to Cart
                </button>
            `;
            activityElement.appendChild(activityInfo);

            activitiesContainer.appendChild(activityElement);
        });
    } else {
        activitiesContainer.innerHTML = '<p>No activities found.</p>';
    }
}


// Confirm Logout
const confirmLogout = document.getElementById("confirm-logout");
const cancelLogout = document.getElementById("cancel-logout");

confirmLogout.addEventListener("click", () => {
    alert("You have been logged out.");
    window.location.href = "logout.php"; // Redirect to logout.php
});

cancelLogout.addEventListener("click", () => {
    document.getElementById("dashboard").click();
});

// Additional menu and navbar functionality
let menu = document.querySelector('#menu-btn');
let navbar = document.querySelector('.header .navbar');

menu.onclick = () => {
    menu.classList.toggle('fa-times');
    navbar.classList.toggle('active');
};

window.onscroll = () => {
    menu.classList.remove('fa-times');
    navbar.classList.remove('active');
};

document.querySelector('#close-edit').onclick = () => {
    document.querySelector('.edit-form-container').style.display = 'none';
    window.location.href = 'admin.php';
};

function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    sidebar.classList.toggle("show");
  
    const content = document.querySelector(".content");
    if (sidebar.classList.contains("show")) {
      content.style.marginLeft = "250px";
    } else {
      content.style.marginLeft = "0";
    }
  }
  
  function showPage(pageId) {
    // Hide all pages
    const pages = document.querySelectorAll(".page");
    pages.forEach((page) => (page.style.display = "none"));
  
    // Show the selected page
    const page = document.getElementById(pageId);
    page.style.display = "block";
  
    // Update the active class on the sidebar menu
    const items = document.querySelectorAll(".sidebar-list-item");
    items.forEach((item) => {
      item.classList.remove("active");
    });
  
    // Set the clicked item as active
    const activeItem = Array.from(items).find((item) =>
      item.innerHTML.includes(pageId.replace("-", " "))
    );
    activeItem.classList.add("active");
  } 


  confirmLogout.addEventListener("click", () => {
    alert("You have been logged out.");
    window.location.href = "login.html"; // Redirect to login page or home page
  });

  cancelLogout.addEventListener("click", () => {
    document.getElementById("dashboard").click();
  });


