const months = ["January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
];
const dayOfWeek = ["Sunday", "Monday", "Tuesday", "Thursday", "Friday", "Saturday"];


// HTML elements
let leftbtn;
let rightbtn;
let yrmonth;
let overlay;
let yeartext;
let leftyrbtn;
let rightyrbtn;
const monthGrids = [];
const calendarGrids = [];
let selectedDay = null;
let dateInput;


const now = new Date();
const date = {
    year: now.getFullYear(),
    month: now.getMonth(),  // 0 indexed
    day: now.getDate()
};


document.addEventListener("DOMContentLoaded", function() {
    let startingIndex = new Date(date.year, date.month, 1).getDay();

    leftbtn = document.getElementById('calendar-left');
    rightbtn = document.getElementById('calendar-right');
    yrmonth = document.getElementById('calendar-header-text');
    dateInput = document.getElementById('calendar-input');
    overlay = document.querySelector('.calendar-overlay');
    leftyrbtn = document.getElementById('calendar-yr-left');
    rightyrbtn = document.getElementById('calendar-yr-right');
    yeartext = document.getElementById('calendar-overlay-year-text');

    // Retrieve the 7x6 calendar grids
    for (let i = 1; i <= 7*6; ++i)
        calendarGrids.push( document.querySelector(`.calendar-grid${i}`) );
    // Retrieve the 4x3 month grids
    for (let i = 1; i <= 4*3; ++i) {
        const monthGrid = document.querySelector(`.calendar-mon${i}`);
        monthGrids.push( monthGrid );
        monthGrid.addEventListener('click', ()=> selectMonth(i-1) );
    }

    // If initial value is provided to the calendar input
    if (dateInput && dateInput.value && new Date(dateInput.value).valueOf()) {
        const d = new Date(dateInput.value);
        date.year = d.getFullYear();
        date.month = d.getMonth();
        date.day = d.getDate();

        startingIndex = new Date(date.year, date.month, 1).getDay();

        setYearMonthText();
        setDays();
        setSelectedDay( calendarGrids[date.day + startingIndex - 1] );
    }
    // Else just use today's date on client computer
    else {
        setYearMonthText();
        setDays();
        setSelectedDay( calendarGrids[date.day + startingIndex - 1] );
    }


    leftbtn.addEventListener('click', setPrevmonth);
    rightbtn.addEventListener('click', setNextMonth);
    yrmonth.addEventListener('click', openYearMonthOverlay);
    leftyrbtn.addEventListener('click', setPreviousYear);
    rightyrbtn.addEventListener('click', setNextYear);
});



// Event handler when user clicks the '<' to switch to previous month
function setPrevmonth() {

    if (date.month === 0) {
        date.year = date.year - 1;
        date.month = 11;
    } else {
        date.month = date.month - 1;
    }
    
    setYearMonthText();
    setDays();
    clearSelectedDay();
}



// Event handler when user clicks the '>' to switch to next month
function setNextMonth() {
    if (date.month === 11) {
        date.year = date.year + 1;
        date.month = 0;
    } else {
        date.month = date.month + 1;
    }

    setYearMonthText();
    setDays();
    clearSelectedDay();
}



// Sets the header month text, as in "Febuary 2022"
function setYearMonthText() {
    yrmonth.innerText = `${months[ date.month ] } ${ date.year }`;
}


// Fills in the calendar with the dates from 1...30 or 31 with reference to current year and month
function setDays() {
    // Clear the existing content of the grids
    calendarGrids.forEach((g)=> g.innerHTML = "");

    // Get starting index within the array to append to, due to the first day can be various days of week
    const startingIndex = new Date(date.year, date.month, 1).getDay();

    // Get number of days in this month.
    const noOfDays = new Date(date.year, date.month+1, 0).getDate();

    // Append the buttons
    for (var i = 0; i < noOfDays; ++i) {
        calendarGrids[startingIndex + i].appendChild( getButton(i+1) );
    }
}


// A factory for the button in the calendar grid. [ 1 ][ 2 ][ 3 ]...
function getButton(day) {
    const button = document.createElement('button');
    button.classList.add('button', 'calendar-button');
    button.type = "button";
    button.innerText = day;
    button.addEventListener('click', ()=> {
        date.day = day;
        setSelectedDay(button);
    });
    return button;
}



// Event handler when user clicks on one of the days in the calendar.
function setSelectedDay(grid) {
    clearSelectedDay(); 

    selectedDay = grid;
    date.day = parseInt( selectedDay.innerText );

    selectedDay.classList.add('calendar-day-selected');

    //! Remember that date.month starts from 0. We need to recover that.
    dateInput.value = `${date.year}-${(date.month+1).toString().padStart(2, "0")}-${date.day.toString().padStart(2, "0")}`;
}



// Clears selected day selection
function clearSelectedDay() {
    if (!selectedDay) return;
    selectedDay.classList.remove('calendar-day-selected');
    selectedDay = null;
    dateInput.value = '';
}


// Opens the year / month selection
function openYearMonthOverlay() {
    // Slide in the overlay
    overlay.classList.add('open');

    // Set the year using current year value
    yeartext.innerText = `Year ${date.year}`;
}


function setPreviousYear() {
    --date.year;
    yeartext.innerText = `Year ${date.year}`;
}


function setNextYear() {
    ++date.year;
    yeartext.innerText = `Year ${date.year}`;
}


function selectMonth(month) {
    clearSelectedDay();

    // Set month
    date.month = month;

    // Close overlay
    overlay.classList.remove('open');

    // Redraw the calendar.
    setYearMonthText();
    setDays();
}


// Sets the calendar with the value of dateInput, if not empty
function setCalendarWithInputValue() {
    
}