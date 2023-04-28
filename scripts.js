function displayDate() {
    var date = new Date();
    var options = {
      weekday: 'long',
      year: 'numeric',
      month: 'long',
      day: 'numeric'
    };
    var formattedDate = date.toLocaleDateString('en-US', options);
    document.getElementById('date').innerHTML = formattedDate;
  }

// Get the button and popup elements
const suggestionBtn = document.getElementById('suggestion-btn');
const createBtn = document.getElementById('create-btn');
const suggestionPopup = document.getElementById('suggestion-popup');
const createPopup = document.getElementById('create-popup');
const closePopupBtn1 = document.getElementById('close-popup-btn1');
const closePopupBtn2 = document.getElementById('close-popup-btn2');
const closePopupBtn3  = document.getElementById("close-popup-btn3");
const abtBtn = document.getElementById('about-btn');
const aboutPopup = document.getElementById("about-popup");


// Add an event listener to the button to open the popup
suggestionBtn.addEventListener('click', function() {
  suggestionPopup.style.display = 'block';
});

// Add an event listener to the button to open the popup
createBtn.addEventListener('click', function() {
  createPopup.style.display = 'block';
});

// Add an event listener to the close button to close the popup
closePopupBtn1.addEventListener('click', function() {
  createPopup.style.display = 'none';
});

// Add an event listener to the close button to close the popup
closePopupBtn2.addEventListener('click', function() {
  suggestionPopup.style.display = 'none';
});
  
// Add a click event listener to the button
abtBtn.addEventListener("click", function() {
  aboutPopup.style.display = "block";
});

// Add a click event listener to the close button
  closePopupBtn3.addEventListener("click", function() {
    aboutPopup.style.display = "none";
});

let addRowButtons = document.querySelectorAll('.add-btn');
addRowButtons.forEach(button => {
    button.addEventListener('click', function() {
        if (!button.classList.contains('added')) {
            let row = button.closest('tr');
            let newRow = row.cloneNode(true);
            let suggTable = document.querySelector('.sugg-table tbody');
            suggTable.appendChild(newRow);
            button.classList.add('added');
        } else {
            alert('Already added to list');
        }
    });
});

let createForm = document.querySelector('#create-form');

createForm.addEventListener('submit', function(event) {
    event.preventDefault();
    let idInput = document.querySelector('input[name="id"]');
    let titleInput = document.querySelector('input[name="title"]');
    let sectorInput = document.querySelector('input[name="sector"]');
    let instructorInput = document.querySelector('input[name="instructor"]');
    let newRow = document.createElement('tr');
    let idCell = document.createElement('td');
    let titleCell = document.createElement('td');
    let sectorCell = document.createElement('td');
    let instructorCell = document.createElement('td');
    let actionCell1 = document.createElement('td');
    let actionCell2 = document.createElement('td');
    idCell.textContent = idInput.value;
    titleCell.textContent = titleInput.value;
    sectorCell.textContent = sectorInput.value;
    instructorCell.textContent = instructorInput.value;
    actionCell1.innerHTML = '<div class="section"><button id="about"><img src="images/about.png" alt="" title="" width="30" height="30"></button></div>';
    actionCell2.innerHTML = '<div class="section"><button id="add" class="add-btn"><img src="images/add-1.png" alt="" title="" width="30" height="30"></button></div>';
    newRow.appendChild(idCell);
    newRow.appendChild(titleCell);
    newRow.appendChild(sectorCell);
    newRow.appendChild(instructorCell);
    newRow.appendChild(actionCell1);
    newRow.appendChild(actionCell2);
    let tableBody = document.querySelector('table tbody');
    tableBody.appendChild(newRow);
    idInput.value = '';
    titleInput.value = '';
    sectorInput.value = '';
    instructorInput.value = '';
});


// Position the popup in the center of the screen
const windowWidth = window.innerWidth;
const windowHeight = window.innerHeight;
const popupWidth = suggestionPopup.offsetWidth;
const popupHeight = suggestionPopup.offsetHeight;
suggestionPopup.style.top = (windowHeight - popupHeight) / 2 + 'px';
suggestionPopup.style.left = (windowWidth - popupWidth) / 2 + 'px';

const tableContainer = document.querySelector('.table-container');

let isDown = false;
let startX;
let scrollLeft;

tableContainer.addEventListener('mousedown', e => {
  isDown = true;
  startX = e.pageX - tableContainer.offsetLeft;
  scrollLeft = tableContainer.scrollLeft;
});

tableContainer.addEventListener('mouseleave', () => {
  isDown = false;
});

tableContainer.addEventListener('mouseup', () => {
  isDown = false;
});

tableContainer.addEventListener('mousemove', e => {
  if (!isDown) return;
  e.preventDefault();
  const x = e.pageX - tableContainer.offsetLeft;
  const walk = (x - startX) * 3;
  tableContainer.scrollLeft = scrollLeft - walk;
});



