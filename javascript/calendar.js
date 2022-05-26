const months = ["January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
];
const dayOfWeek = ["Sunday", "Monday", "Tuesday", "Thursday", "Friday", "Saturday"];



let leftbtn;
let rightbtn;
let yrmonth;
let selectedDay = null;
let dateInput;
const calendarGrids = [];

const now = new Date();
const date = {
    year: now.getFullYear(),
    month: now.getMonth(),
    day: now.getDate()
};


document.addEventListener("DOMContentLoaded", function() {
    const startingIndex = new Date(date.year, date.month, 1).getDay();

    leftbtn = document.getElementById('calendar-left');
    rightbtn = document.getElementById('calendar-right');
    yrmonth = document.getElementById('calendar-header-text');
    dateInput = document.getElementById('calendar-input');

    // Retrieve the 7x6 calendar grids
    for (let i = 1; i <= 7*6; ++i)
        calendarGrids.push( document.querySelector(`.calendar-grid${i}`) );

    setYearMonthText();
    setDays();
    setSelectedDay( calendarGrids[date.day + startingIndex - 1] );

    leftbtn.addEventListener('click', setPrevmonth);
    rightbtn.addEventListener('click', setNextMonth);
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

    dateInput.value = `${date.year}-${date.month.toString().padStart(2, "0")}-${date.day.toString().padStart(2, "0")}`;
}



// Clears selected day selection
function clearSelectedDay() {
    if (!selectedDay) return;
    selectedDay.classList.remove('calendar-day-selected');
    selectedDay = null;
    dateInput.value = '';
}