/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function ToutAbonner() {
    var parent = document.getElementById("parent");
    var label = document.getElementById("label");
    var input = document.getElementsByTagName("input");

    if (parent.checked === true) {
        for (var i = 0; i < input.length; i++) {
            if (input [i].type == "checkbox" && input[i].id == "Child_Checkbox" && input[i].checked == false) {
                input[i].checked = true;
                label.innerHTML = "Tout abonnées";
            }
        }
    } else if (parent.checked === false) {
        for (var i = 0; i < input.length; i++) {
            if (input [i].type == "checkbox" && input[i].id == "Child_Checkbox" && input[i].checked == true) {
                input[i].checked = false;
                label.innerHTML = "S'abonner à tout";
            }
        }
    }
}



function ToutDesabonner() {
    var parent = document.getElementById("parent1");
    var label = document.getElementById("label1");
    var input = document.getElementsByTagName("input");

    if (parent.checked === true) {
        for (var i = 0; i < input.length; i++) {
            if (input [i].type == "checkbox" && input[i].id == "Child_Checkbox1" && input[i].checked == false) {
                input[i].checked = true;
                label.innerHTML = "Tout désabonnées";
            }
        }
    } else if (parent.checked === false) {
        for (var i = 0; i < input.length; i++) {
            if (input [i].type == "checkbox" && input[i].id == "Child_Checkbox1" && input[i].checked == true) {
                input[i].checked = false;
                label.innerHTML = "Se désabonner à tout";
            }
        }
    }
}
