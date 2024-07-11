// button functions
function login(){
location.href = "/account-setup.php";
}

function register(){
location.href = "/account-setup.php";
}

// functions to update the active navigation item based on scroll position (design nung napuntahan)
function updateActiveNavItem() {
    const designSection = document.getElementById('design');
    const blogSection = document.getElementById('blog');
    const aboutSection = document.getElementById('about');
    const navLinks = document.querySelectorAll('.nav-menu ul li a');

    const designTop = designSection.offsetTop;
    const blogTop = blogSection.offsetTop;
    const aboutTop = aboutSection.offsetTop;
    const scrollTop = window.scrollY;

    if (scrollTop >= aboutTop) {
        navLinks.forEach(link => {
            link.classList.remove('active');
        });
        navLinks[3].classList.add('active');
    } else if (scrollTop >= blogTop) {
        navLinks.forEach(link => {
            link.classList.remove('active');
        });
        navLinks[2].classList.add('active');
    } else if (scrollTop >= designTop) {
        navLinks.forEach(link => {
            link.classList.remove('active');
        });
        navLinks[1].classList.add('active');
    } else {
        navLinks.forEach(link => {
            link.classList.remove('active');
        });
        navLinks[0].classList.add('active');
    }
}

// function to handle click event on navigation items and scroll to corresponding sections. (kung san mapupunta)
function handleNavClick(event) {
    event.preventDefault();
    const targetId = event.target.getAttribute('href').substring(1);
    const targetSection = document.getElementById(targetId);
    const targetOffset = targetSection.offsetTop;

    window.scrollTo({
        top: targetOffset,
        behavior: 'smooth'
    });
}

// Add event listeners for scroll and navigation item click
window.addEventListener('scroll', updateActiveNavItem);
document.querySelectorAll('.nav-menu ul li a').forEach(link => {
    link.addEventListener('click', handleNavClick);
});

function toggleMenu() {
    const navMenu = document.getElementById('navMenu');
    navMenu.classList.toggle('active');
}
