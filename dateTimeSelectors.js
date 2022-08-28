// Calendar Scripts
const date = new Date();

function showCalendar()
{
    // saves the user current date and will be used as the starting point to render the calendar

    const month = date.getMonth() + 1;
    const year = date.getFullYear();

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

    monthDays.innerHTML = days; // this contains all the days that got created by the previous for loops

    document.querySelectorAll(".days div").forEach  // allows to select a specific day in the calendar that will be used to make reservations based on date and time
    (   day => {
            day.addEventListener("click", event => {
                if (day.className == 'prev-date') // if a previous date is clicked, the calendar will update to that date's month
                {
                    date.setMonth(date.getMonth() - 1);
                    showCalendar();
                }
                else if (day.className == 'next-date') // if a previous date is clicked, the calendar will update to that date's month
                {
                    date.setMonth(date.getMonth() + 1);
                    showCalendar();
                }
                else // if day clicked is from current displayed month, that day is selected
                {
                    document.querySelector('.selectedDate p span').innerHTML = `${month}/${event.currentTarget.innerText}/${year}`;

                    var src = document.getElementById("slDate");
                    var dest = document.getElementById("dateInput");
                    dest.value = src.innerText;
                }
            });
    });
}

//  add function to calendar arrows
document.querySelector(".prev").addEventListener("click",() => {
    date.setMonth(date.getMonth() - 1);
    showCalendar();
});

document.querySelector(".next").addEventListener("click",() => {
    date.setMonth(date.getMonth() + 1);
    showCalendar();
});

// when the month is clicked, calendar returns to user's curret date
document.querySelector(".date h1").addEventListener("click",() => {
    date.setFullYear(new Date().getFullYear());
    date.setMonth(new Date().getMonth());
    showCalendar();
});

showCalendar();// must exist to load the calendar on load/refresh

// =======================      T   I   M  E    Selectors      ========================

// Available times increment by 30 minutes
var startTime;

function buildToSelector()
{
    const fromTimes = document.querySelector(".toSelector");

    let times = '';

    for (let i = startTime; i < 22.5; i+=.5)
    {
        if (i == 12 || i == 12.5)
        {
            if ((i % 1) != 0)
            {
                times += `<option value="${i-.5}:30 PM">${i-.5}:30 PM</option>`;
            }
            else
            {
                times += `<option value="${i}:00 PM">${i}:00 PM</option>`;
            }
        }
        else if (i > 12 && i < 22.5)
        {
            if ((i % 1) != 0)
            {
                const hour = ((i-.5)-12).toString().padStart(2,"0");
                times += `<option value="${hour}:30 PM">${hour}:30 PM</option>`;
            }
            else
            {
                const hour = ((i)-12).toString().padStart(2,"0");
                times += `<option value="${hour}:00 PM">${hour}:00 PM</option>`;
            }
        }
        else if (i == 22)
        {
            times += `<option value="${i-12}:00 PM">${i-12}:00 PM</option>`;
        }
        else
        {
            if ((i % 1) != 0)
            {
                const hour = ((i-.5)).toString().padStart(2,"0");
                times += `<option value="${hour}:30 AM">${hour}:30 AM</option>`;
            }
            else
            {
                const hour = ((i)).toString().padStart(2,"0");
                times += `<option value="${hour}:00 AM">${hour}:00 AM</option>`;
            }
        }
    }
    fromTimes.innerHTML = times;
}

const buildFromSelector = () =>
{
    const fromTimes = document.querySelector(".fromSelector");

    let times = '';

    for (let i = 7; i < 23; i++)
    {
        if (i == 12)
        {
            times += `<option value="${i}:00 PM">${i}:00 PM</option>`;
            times += `<option value="${i}:30 PM">${i}:30 PM</option>`;
        }
        else if (i > 12 && i < 22)
        {
            const hour = (i-12).toString().padStart(2,"0");
            times += `<option value="${hour}:00 PM">${hour}:00 PM</option>`;
            times += `<option value="${hour}:30 PM">${hour}:30 PM</option>`;
        }
        else if (i == 22)
        {
            times += `<option value="${i-12}:00 PM">${i-12}:00 PM</option>`;
        }
        else
        {
            const hour = i.toString().padStart(2,"0");
            times += `<option value="${hour}:00 AM">${hour}:00 AM</option>`;
            times += `<option value="${hour}:30 AM">${hour}:30 AM</option>`;
        }
    }
    fromTimes.innerHTML = times;
}

buildFromSelector(); // create the 'From' time selector

// The function below gets the time selected in the FROM selector and based on that time,
// the available times for the TO time selector is determined.
var fromSelector = document.getElementById('fromSelector');
function updateToSelector()
{
    const fromTimeSelected = fromSelector.options[fromSelector.selectedIndex].innerText;
    const intHour = parseInt(fromTimeSelected.slice(0,2));
    const meridiem = fromTimeSelected.slice(6,7);
    const isHalf = fromTimeSelected.slice(3,4);

    if (intHour == 12)
    {
        console.log(intHour);
        if (isHalf == '3')
        {
            startTime = 13;
        }
        else
        {
            startTime = 12.5;
        }
        buildToSelector();
    }
    else if (meridiem == 'P' && intHour >= 1)
    {
        if (isHalf == '3')
        {
            startTime = (intHour + 1) + 12;
        }
        else if (intHour == 10)
        {
            startTime = 22;
        }
        else
        {
            startTime = (intHour + .5) + 12;
        }
        buildToSelector();
    }
    else
    {
        if (isHalf == '3')
        {
            startTime = (intHour + 1);
        }
        else
        {
            startTime = (intHour + .5);
        }
        buildToSelector();
    }
}
fromSelector.onchange = updateToSelector; // When there is a change with the fromSelector, the function updateToSelector is ran
updateToSelector(); // Loads the initial difference between the FROM selector

select_element.onchange = function() {
    var elem = (typeof this.selectedIndex === "undefined" ? window.event.srcElement : this);
    var value = elem.value || elem.options[elem.selectedIndex].value;
    alert(value);
}

