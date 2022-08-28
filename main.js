///User Icon drop down menu toggle On/Off  
document.querySelector(".user-icon").addEventListener("click",() => {

    if (document.querySelector(".dropdown").style.display !== "block")
    {
        document.querySelector(".dropdown").style.display = "block";
    }
    else 
    {
        document.querySelector(".dropdown").style.display = "none";
    }
    
});
