document.addEventListener('DOMContentLoaded', function() {
    const contentMap = {
        "Introduction": "Welcome to the Department of Computer Science and Engineering. Our department is dedicated to providing a solid education in the principles and practices of computing.",
        "Opportunities": "We offer a range of opportunities for students including internships, research projects, and industry collaborations to enhance their learning experience.",
        "Faculty Members": "Our faculty members are highly qualified and experienced professionals who are committed to excellence in teaching and research.",
        "Lab Facility": "Our department is equipped with state-of-the-art laboratory facilities that provide students with hands-on experience in various aspects of computing.",
        "News": "Stay updated with the latest news and events happening in our department. We regularly organize seminars, workshops, and conferences."
    };

    const links = document.querySelectorAll('.sidebar ul li a');
    const contentParagraph = document.getElementById('text');

    links.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const contentKey = this.getAttribute('data-content');
            contentParagraph.textContent = contentMap[contentKey];
        });
    });
});