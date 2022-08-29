$(function(){
    $.ajaxSetup({
        cache: true
    });
    $.getScript("http://127.0.0.1/strony/praca/scripts/functions", function(){
        bind();
    });
});