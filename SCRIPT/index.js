/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var show_per_page = 5;
var current_page = 0;

function set_display(first, last) {
    $('#cartesB').children().css('display', 'none');
    $('#cartesB').children().slice(first, last).css('display', 'block');
}
function set_display2(first, last) {
    $('#cartesT').children().css('display', 'none');
    $('#cartesT').children().slice(first, last).css('display', 'block');
}

function set_display3(first, last) {
    $('#cartesA').children().css('display', 'none');
    $('#cartesA').children().slice(first, last).css('display', 'block');
}

function previous() {
    if ($('.active').prev('.page_link').length)
        go_to_page(current_page - 1);
}

function next() {
    if ($('.active').next('.page_link').length)
        go_to_page(current_page + 1);
}

function previous2() {
    if ($('.active').prev('.page_link').length)
        go_to_page2(current_page - 1);
}

function next2() {
    if ($('.active').next('.page_link').length)
        go_to_page2(current_page + 1);
}

function previous3() {
    if ($('.active').prev('.page_link').length)
        go_to_page3(current_page - 1);
}

function next3() {
    if ($('.active').next('.page_link').length)
        go_to_page3(current_page + 1);
}

function go_to_page(page_num) {
    current_page = page_num;
    start_from = current_page * show_per_page;
    end_on = start_from + show_per_page;
    set_display(start_from, end_on);
    $('.active').removeClass('active');
    $('#id' + page_num).addClass('active');
}

function go_to_page2(page_num) {
    current_page = page_num;
    start_from = current_page * show_per_page;
    end_on = start_from + show_per_page;
    set_display2(start_from, end_on);
    $('.active').removeClass('active');
    $('#sid' + page_num).addClass('active');
}

function go_to_page3(page_num) {
    current_page = page_num;
    start_from = current_page * show_per_page;
    end_on = start_from + show_per_page;
    set_display3(start_from, end_on);
    $('.active').removeClass('active');
    $('#id3' + page_num).addClass('active');
}

$(document).ready(function () {

    var number_of_pages = Math.ceil($('#cartesB').children().length / show_per_page);
    var number_of_pages2 = Math.ceil($('#cartesT').children().length / show_per_page);
    var number_of_pages3 = Math.ceil($('#cartesA').children().length / show_per_page);

    var nav = '<nav aria-label="Page navigation example" class="page"><ul class="pagination justify-content-center"><li class="page-item"><a class="page-link" href="javascript:previous();">Précédent<\/a>';
    var nav2 = '<nav aria-label="Page navigation example" class="page"><ul class="pagination justify-content-center"><li class="page-item"><a class="page-link" href="javascript:previous2();">Précédent<\/a>';
    var nav3 = '<nav aria-label="Page navigation example" class="page"><ul class="pagination justify-content-center"><li class="page-item"><a class="page-link" href="javascript:previous3();">Précédent<\/a>';

    var i = -1;
    while (number_of_pages > ++i) {
        nav += '<li class="page_link'
        if (!i)
            nav += ' active';
        nav += '" id="id' + i + '">';
        nav += '<a class="page-link" href="javascript:go_to_page(' + i + ')">' + (i + 1) + '<\/a>';
    }
    nav += '<li class="page-item"><a class="page-link" href="javascript:next();">Suivant<\/a><\/ul><\/nav>';

    $('#page_navigation').html(nav);
    set_display(0, show_per_page);

    var i = -1;
    while (number_of_pages2 > ++i) {
        nav2 += '<li class="page_link'
        if (!i)
            nav2 += ' active';
        nav2 += '" id="sid' + i + '">';
        nav2 += '<a class="page-link" href="javascript:go_to_page2(' + i + ')">' + (i + 1) + '<\/a>';
    }
    nav2 += '<li class="page-item"><a class="page-link" href="javascript:next2();">Suivant<\/a><\/ul><\/nav>';

    $('#page_navigation2').html(nav2);
    set_display2(0, show_per_page);

    var i = -1;
    while (number_of_pages3 > ++i) {
        nav3 += '<li class="page_link'
        if (!i)
            nav += ' active';
        nav3 += '" id="id3' + i + '">';
        nav3 += '<a class="page-link" href="javascript:go_to_page3(' + i + ')">' + (i + 1) + '<\/a>';
    }
    nav3 += '<li class="page-item"><a class="page-link" href="javascript:next3();">Suivant<\/a><\/ul><\/nav>';

    $('#page_navigation3').html(nav3);
    set_display3(0, show_per_page);

});
