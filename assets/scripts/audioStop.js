
// Arrêter l'audio avant de quitter la page
console.log('ENTER STOP AUDIO JS FILE! 🎉');
window.addEventListener('unload', function() {
    console.log('ENTER STOP AUDIO! 🎉');
    const audio = document.getElementById('backgroundMusic');
    if (audio) {
        console.log('STOP AUDIO! 🎉');
        audio.pause();
        audio.currentTime = 0;
    }
});
