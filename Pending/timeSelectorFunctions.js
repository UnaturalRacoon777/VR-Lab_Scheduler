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