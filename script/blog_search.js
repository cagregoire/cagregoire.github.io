function searchPosts() {
    
    // Sanitize input search text to lowecase to make it easier
    const searchTerm = document.getElementById("searchInput").value.toLowerCase();

    const posts = document.querySelectorAll(".leftcolumn .card");
    const noResults = document.querySelector(".leftcolumn .noResults");
    let shown = 0;

    let anyShown = false; //tracks if any posts are visible/matched

    // Loop through every post available
    posts.forEach(post => {

        const title = post.querySelector("h2").innerText.toLowerCase();

        // This combines all the paragraphs of each articles into one single string, makes searching easier
        let bodyText = "";
        post.querySelectorAll("p").forEach(p => {
            bodyText += p.innerText.toLowerCase() + " ";
        });

        // Matching logic
        const matches = title.includes(searchTerm) || bodyText.includes(searchTerm);

        if (searchTerm === "") {
            post.style.display = ""; // Reset all when empty
            anyShown = true;
            return;
        }

        // I wanted to show max 4 posts, so the page doesnt shift too much
        if (matches && shown < 4) {
            post.style.display = "";
            shown++;
            anyShown = true;
        } else {
            post.style.display = "none";
        }
    });
    noResults.style.display = anyShown ? "none" : "block"; // no result message when no posts are visible
}

