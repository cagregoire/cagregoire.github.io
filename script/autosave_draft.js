// Grabs title heading + text content
const titleInput = document.getElementById('title');
const storyInput = document.getElementById('story');

let saveTimer;

// Grabs saved draft from localStorage if there is one
window.addEventListener('DOMContentLoaded', () => {
    const savedDraft = JSON.parse(localStorage.getItem('draftPost'));
    if (savedDraft) {
        if (savedDraft.title) titleInput.value = savedDraft.title;
        if (savedDraft.story) storyInput.value = savedDraft.story;
    }
});

// Auto save after 2 seconds of AFK
function autoSave() {
    clearTimeout(saveTimer);
    saveTimer = setTimeout(() => {
        const draft = {
            title: titleInput.value,
            story: storyInput.value
        };
        localStorage.setItem('draftPost', JSON.stringify(draft));
        console.log('Draft saved'); // optional for debugging
    }, 2000);
}

// Apply the auto save function to both input fields
titleInput.addEventListener('input', autoSave);
storyInput.addEventListener('input', autoSave);

// If user writes blog and successfully posts, content need to be wiped so when a new post is made, old draft does not appear
document.querySelector('form').addEventListener('submit', () => {
    localStorage.removeItem('draftPost');
});