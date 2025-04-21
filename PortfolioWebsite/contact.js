document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();
    document.getElementById('contactResult').innerText = 'Thank you for your message!';
    this.reset();
});
