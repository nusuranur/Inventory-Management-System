// admin.js
<script src="admin.js"></script>

// Toggle the sidebar when the menu button is clicked (for mobile view)
const menuToggle = document.getElementById('menuToggle');
const sidebar = document.getElementById('sidebar');
const content = document.getElementById('content');

// Sidebar toggle functionality for mobile view
menuToggle.addEventListener('click', () => {
    sidebar.classList.toggle('collapsed');
    content.classList.toggle('collapsed');
});

// Smooth hover effect for stats boxes
const statsBoxes = document.querySelectorAll('.stat-box');

statsBoxes.forEach(box => {
    box.addEventListener('mouseover', () => {
        box.style.transform = 'scale(1.05)';
        box.style.boxShadow = '0px 8px 16px rgba(0, 0, 0, 0.2)';
    });
    box.addEventListener('mouseout', () => {
        box.style.transform = 'scale(1)';
        box.style.boxShadow = '0px 4px 8px rgba(0, 0, 0, 0.1)';
    });
});

// Handle Sidebar Toggle when clicking outside (for desktop)
document.addEventListener('click', (event) => {
    if (!sidebar.contains(event.target) && !menuToggle.contains(event.target)) {
        sidebar.classList.remove('collapsed');
        content.classList.remove('collapsed');
    }
});

// Smooth Scroll for Admin Stats Boxes
document.querySelectorAll('.stat-box').forEach(box => {
    box.addEventListener('mouseenter', () => {
        box.style.transition = 'transform 0.3s ease, box-shadow 0.3s ease';
        box.style.transform = 'scale(1.1)';
        box.style.boxShadow = '0px 8px 20px rgba(0, 0, 0, 0.2)';
    });

    box.addEventListener('mouseleave', () => {
        box.style.transition = 'transform 0.3s ease, box-shadow 0.3s ease';
        box.style.transform = 'scale(1)';
        box.style.boxShadow = '0px 4px 10px rgba(0, 0, 0, 0.1)';
    });
});

// Animation for Admin Stats
const stats = document.querySelectorAll('.stat-box');
let isAnimated = false;
window.addEventListener('scroll', () => {
    if (!isAnimated && window.scrollY + window.innerHeight >= document.body.offsetHeight) {
        stats.forEach((stat, index) => {
            setTimeout(() => {
                stat.style.opacity = '1';
                stat.style.transform = 'scale(1)';
            }, index * 300);
        });
        isAnimated = true;
    }
});

// Close the Sidebar if clicked on menu toggle
menuToggle.addEventListener('click', () => {
    const menuToggleIcon = document.querySelector('.menu-toggle i');
    if (sidebar.classList.contains('collapsed')) {
        menuToggleIcon.classList.replace('fa-bars', 'fa-times');
    } else {
        menuToggleIcon.classList.replace('fa-times', 'fa-bars');
    }
});
