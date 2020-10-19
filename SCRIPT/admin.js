/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function openCity(evt, cityName) {
    // Declare all variables
    var i, tabcontentc, tablinksc;

    // Get all elements with class="tabcontent" and hide them
    tabcontentc = document.getElementsByClassName("tabcontentc");
    for (i = 0; i < tabcontentc.length; i++) {
        tabcontentc[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinksc = document.getElementsByClassName("tablinksc");
    for (i = 0; i < tablinksc.length; i++) {
        tablinksc[i].className = tablinksc[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpenc").click();




