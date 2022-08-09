// Calendar Scripts
const date = new Date(); // saves the user current date and will be used as the starting point to render the calendar

const showCalendar = () =>
{
    const months =
    [
        "January", "February", "March", "April", "May", "June",
        "July", "August","September", "October", "November", "December"
    ];

    date.setDate(1);

    const monthDays = document.querySelector(".days");

    const lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate(); // gets the last day value of the current month 

    const prevLastDay = new Date(date.getFullYear(), date.getMonth(), 0).getDate(); // gets the last day of the previous month

    const firstDayIndex = date.getDay(); // get the week-day index value (sun = 0, mon = 1, tues . . .)

    const lastDayIndex = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDay(); // get the week index value of the last day

    const nextDays = 7 - lastDayIndex - 1; // get how many blank days are left after the last day of the month to fill the week

    document.querySelector('.date h1').innerHTML = months[date.getMonth()]; // Sets Month name in calendar based on user's device time

    document.querySelector('.date p').innerHTML = new Date(date.getFullYear(), 0).getFullYear(); //gets the user's device current date year

    let days = "";

    for(let x = firstDayIndex; x > 0; x--) // set the first day of month to the correct weekday index and display previous last days of month until first sunday is reached
    {
        days += `<div class="prev-date">${prevLastDay - x + 1}</div>`;
    }

    for(let i = 1; i <= lastDay; i++) // Automatically add days from 1 to final day values of month on the candelar
    {
        if(i === new Date().getDate() && date.getMonth() === new Date().getMonth() && date.getFullYear() === new Date().getFullYear()) // if the date being added is the same as the user's device date, highlight it
        {
            days += `<div class="today">${i}</div>`;
        }
        else
        {
            days += `<div>${i}</div>`; // if current date being rendered does not match user device date, don't do anything to it.
        }
    }

    for (let y = 1; y <= nextDays; y++) // add the day of the next month until the last sat of month is reached.
    {
        days += `<div class="next-date">${y}</div>`;
    }

    monthDays.innerHTML = days;   
};


//  add Function of calendar arrows
document.querySelector(".prev").addEventListener("click",() => {
    date.setMonth(date.getMonth() - 1);
    showCalendar();
});

document.querySelector(".next").addEventListener("click",() => {
    date.setMonth(date.getMonth() + 1);
    showCalendar();
});

document.querySelector('.date h1').addEventListener("click",() => {
    date.setFullYear(new Date().getFullYear());
    date.setMonth(new Date().getMonth());
    showCalendar();
});

showCalendar(); //Show current date when loaded

/* User Icon drop down menu toggle On/Off  */
function toggleDropMenu() {
    var x = document.getElementById("toggle");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
  }