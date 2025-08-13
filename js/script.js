// Example: Display an alert when the page is loaded
window.onload = function() {
    console.log("JavaScript file is linked successfully!");
    alert("Welcome to the Inventory Dashboard!");
};

// Additional JavaScript functionality can go here
// Menu Toggle Functionality
const menuToggle = document.getElementById('menuToggle');
const sidebar = document.getElementById('sidebar');
const content = document.getElementById('content');

// Toggle sidebar visibility on mobile view
menuToggle.addEventListener('click', () => {
    sidebar.classList.toggle('collapsed');
    content.classList.toggle('collapsed');
});

// Animation for Home Icon
const homeIcon = document.querySelector('.home-icon img');

// Adding hover effect to the home icon
homeIcon.addEventListener('mouseover', () => {
    homeIcon.style.transform = 'scale(1.1)';
    homeIcon.style.boxShadow = '0 8px 16px rgba(0,0,0,0.2)';
});

homeIcon.addEventListener('mouseout', () => {
    homeIcon.style.transform = 'scale(1)';
    homeIcon.style.boxShadow = '0 4px 8px rgba(0,0,0,0.1)';
});

// Gradient Animation Control for Background
let gradientKeyframeStyles = `
    @keyframes gradientAnimation {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
`;

let styleSheet = document.createElement('style');
styleSheet.type = 'text/css';
styleSheet.innerText = gradientKeyframeStyles;
document.head.appendChild(styleSheet);

// If you want more animations or JavaScript behavior, you can extend this file.
