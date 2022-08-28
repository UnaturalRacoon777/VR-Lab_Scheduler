// =======================  T   A   B   L   E   FUNCTIONS   ========================



//Function below forces #tableForm to only do something when type-"submit"  button is pressed.
//In this case, it's the save button

function editable()
{
    const table = document.getElementById("tableDevice");
    const cells = table.getElementsByClassName('programs');
    var change;
    
    for (let i = 0; i < cells.length; i++)
    {
        cells[i].onclick = function() 
        {
            if (this.hasAttribute('data-clicked'))
            {
                return;
            }

            this.setAttribute('data-clicked', 'yes');
            this.setAttribute('data-text', this.innerHTML); //this. represents the current cell, so here we are setting data-text = (text insidet the cell)

            const input = document.createElement('input'); // create the input element to change the data in cell
            input.setAttribute('type', 'text');
            input.setAttribute('name', 'programs');
            input.value = this.innerHTML;  // set the input element's value = to the text inside cell
            input.style.width = "320px";
            input.style.fontFamily = "inherit";
            input.style.fontSize = "inherit";
            input.style.textAlign = "inherit";
            input.style.backgroundColor = "rgb(255, 144, 144)";


            input.onblur = function()
            {
                var td = input.parentElement;
                var original_cell = input.parentElement.getAttribute('data-text');
                var current_cell = this.value;

                if (current_cell != original_cell && change === true) // only goes through the comparison process when the enter button was pressed
                {
                    // if the text is different, it must mean that there was a change
                    // so we can save it to the datbase.
                    td.removeAttribute('data-clicked');
                    td.removeAttribute('data-text');
                    change = false;
                    td.innerHTML = current_cell;
                }
                else
                {
                    td.removeAttribute('data-clicked');
                    td.removeAttribute('data-text');
                    td.innerHTML = original_cell;
                    change = false;
                }
            }

            input.addEventListener("keyup", function(event)
            {
                if (event.key === 'Enter')
                {
                    change = true;
                    this.blur();
                }
            })

            this.innerHTML = '';
            this.append(input);
            this.firstElementChild.select();
        }
    }
}

function notEditable()
{
    const table = document.getElementById("tableDevice");
    const cells = table.getElementsByClassName('programs');
    
    for (let i = 0; i < cells.length; i++)
    {
        cells[i].onclick = function()
        {
            if (!this.hasAttribute('data-clicked'))
            {
                return;
            }

            td.removeAttribute('data-clicked');
            td.removeAttribute('data-text');
        }
    }
}

document.querySelector(".edit").addEventListener("click",() => {
    
    document.querySelector(".cancel").style.display = "block";
    document.querySelector(".removeForm").style.display = "inline";

    document.querySelector("#editMsg").style.visibility = "visible";
    editable();
});

document.querySelector(".cancel").addEventListener("click",() => {
    
    document.querySelector(".cancel").style.display = "none";
    document.querySelector(".removeForm").style.display = "none";

    document.querySelector("#editMsg").style.visibility = "hidden";
    document.querySelector("#deviceName").style.visibility = "hidden";
    document.querySelector("#programsList").style.visibility = "hidden";
    document.querySelector("#save-btn").style.visibility = "hidden";
    notEditable();
});

document.querySelector(".add").addEventListener("click",() =>
{
    document.querySelector(".cancel").style.display = "block";

    document.querySelector("#deviceName").style.visibility = "visible";
    document.querySelector("#programsList").style.visibility = "visible";
    document.querySelector("#save-btn").style.visibility = "visible";
});