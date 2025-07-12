document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', (e) => {
        e.preventDefault(); // Prevent default link behavior
        const target = document.querySelector(e.target.getAttribute('href'));
        if(target){
            window.scrollTo({top:target.offsetTop, behavior: 'smooth'});
        }
    });
});