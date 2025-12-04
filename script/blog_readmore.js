// Listens for clicks on "Read more" buttons to show more blog content
document.addEventListener('DOMContentLoaded', () => {

    // Grab all read more buttons
    const buttons = document.querySelectorAll('.readMoreButton');

    buttons.forEach(btn => {
        btn.addEventListener('click', () => {
            const card = btn.closest('.card');
            const moreContent = card.querySelector('.moreContent');

            // Expand the exact content area needed
            if (moreContent.style.maxHeight && moreContent.style.maxHeight !== '0px') {
                // Collapse
                moreContent.style.maxHeight = '0';
                btn.textContent = 'Read more';
            } else {
                // Expand
                moreContent.style.maxHeight = moreContent.scrollHeight + 'px';
                btn.textContent = 'Show less';
            }
        });
    });
});
