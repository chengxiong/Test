$(".table tr td.cont_show").on('click',function(){
    $(this).parent().next('.cont_list').toggle();
});