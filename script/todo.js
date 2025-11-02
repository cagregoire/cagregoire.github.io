
// Load saved items from localStorage on page load
let items = JSON.parse(localStorage.getItem('items')) || [];
renderList();

function addItem(event) {

    event.preventDefault();

    const input = document.getElementById("todo_input"); // Find the input element with todo_input id
    const item_text = input.value.trim(); 

    // Empty input check
    if (!item_text) {
        alert("Please enter a task before adding item.");
        return;
    }

    const newItem = {
        text: item_text,
        id: Date.now() // Unique ID based on timestamp
    };

    items.push(newItem);
    localStorage.setItem('items', JSON.stringify(items)); // Save updated items to localStorage

    renderItem(newItem.text, newItem.id);
    input.value = ""; // Wipe input field after renderItem
}

// Render the entire list
function renderList() {
    items.forEach(item => {
        renderItem(item.text, item.id);
    });
}

function renderItem(item_text, id) {

    const list = document.getElementById("todo_list"); // Find the ul element with todo_list id
    const listItem = document.createElement("li"); // New li element created

    listItem.dataset.id = id;

    // Span for task text
    const text_span = document.createElement("span");
    text_span.textContent = item_text;
    listItem.appendChild(text_span);

    // Span for trash button + styling
    const trash_span = document.createElement("button");
    trash_span.classList.add('fas', 'fa-trash');
    trash_span.style.cursor = "pointer";
    trash_span.style.marginLeft = "8px";
    trash_span.style.color = "red";
    listItem.appendChild(trash_span);

    // Remove the li element from ul on click
    trash_span.addEventListener('click', function() {
        listItem.remove();
        items = items.filter(x => x.id !== id); // Remove item from array
        localStorage.setItem('items', JSON.stringify(items)); // Update localStorage
    });

    list.appendChild(listItem); // Add li to ul
}