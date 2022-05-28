
const months = ["January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
];
const dayOfWeek = ["Sunday", "Monday", "Tuesday", "Thursday", "Friday", "Saturday"];


document.addEventListener('DOMContentLoaded', function() {
    const day = document.getElementById('date-day');
    const month = document.getElementById('date-mon');
    const dow = document.getElementById('date-dow');
    const hr = document.getElementById('clock-hr');
    const min = document.getElementById('clock-min');
    const sec = document.getElementById('clock-sec');
    const ampm = document.getElementById('clock-ampm');
    const colons = document.querySelectorAll('.clock-colon');

    setTime(day, month, dow, hr, min, sec, ampm, colons)
    setInterval(()=> setTime(day, month, dow, hr, min, sec, ampm, colons), 1000);
});




function setTime(day, month, dow, hr, min, sec, ampm, colons) {
    // Date value
    const now = new Date();
    
    day.innerText = now.getDate();
    month.innerText = months[ now.getMonth() ];
    dow.innerText = `(${dayOfWeek[ now.getDay() ]})`;
    hr.innerText = `${(now.getHours() % 12 === 0)? 12: now.getHours() % 12}`.padStart(2, "0");
    min.innerText = `${now.getMinutes()}`.padStart(2, "0");
    sec.innerText = `${now.getSeconds()}`.padStart(2, "0");
    ampm.innerText = (now.getHours() >= 12)? "PM": "AM";

}