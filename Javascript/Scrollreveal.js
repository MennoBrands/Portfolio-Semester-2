/* Maak window aan */
window.sr = ScrollReveal({ duration: 1000 });
/* Selecteer de id Container */
var ContentContainer = document.getElementById('Container');
/* De container <section> wordt na 200ms gereaveled */
sr.reveal(ContentContainer.getElementsByTagName('section'), 200);