$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

$(document).ready(function () {
    //Initialize tooltips
    $('.nav-tabs > li a[title]').tooltip();
    
    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

        var $target = $(e.target);
    
        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });

    setTimeout(function(){
        move();
    },2150);

    setTimeout(function(){
        var $active = $('.wizard .nav-tabs li.active');
        $active.next().removeClass('disabled');
        nextTab($active);
        $('#passo2').addClass('concluido');
    },3000);

    $(".prev-step").click(function (e) {
        var $active = $('.wizard .nav-tabs li.active');
        prevTab($active);
    });
    
    var tamanhoLateral = $('.menu-lateral').height();
    var larguraBody = $('body').width();
    var alturaBody = $('body').height();
    if(larguraBody>1187){
        $('.conteudo-chat').height(tamanhoLateral-190);
        $('.scrollbar-chat').height(tamanhoLateral-190);    
    }else if(larguraBody<770){
        $('.conteudo-chat').height(alturaBody-250);
        $('.scrollbar-chat').height(alturaBody-250);
        $('.ul-lateral').html('');
        $('.ul-lateral').html('');
    }else if(larguraBody<780){
        $('.ul-lateral').html('');
    }else{
        $('.scrollbar-chat').height(tamanhoLateral-250);    
    }
    
    
    var tamanhoForm = $('.envolve-form').width();
    $('.InputAddOn-field').width(tamanhoForm-115);

    function move() {
        var elem = document.getElementById("myBar"); 
        var width = 1;
        var id = setInterval(frame, 10);
        function frame() {
            if(width>=30) {
                clearInterval(id);
            } else {
                width++; 
                elem.style.width = width + '%'; 
            }
        }
    }
    setTimeout(function(){
        $('.lista-notificacoes').append('<tr><td class="text-center">10/12/2016 02:39</td><td>Duis semper, purus vitae consectetur porta, ipsum neque venenatis neque, at mollis velit nisi sed urna.</td></tr>');
    },3800);
});

function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}

function goBack() {
    window.history.back();
}