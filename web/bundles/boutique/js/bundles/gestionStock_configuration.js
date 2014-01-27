$(document).ready(function() {
    $('.datepicker').datepicker({
        dateFormat: 'dd/mm/yy',
        showWeek: true,
        firstDay: 1
    });
    $(".datepicker").datepicker($.datepicker.regional['fr']);
    
    $('a.disabled').live('click',  function(e) {
       e.preventDefault(); 
    });
    
    $('.listeArticles .pagination a').live('click', function( e ) {
        e.preventDefault();
        var url = $(this).attr('href');
        
        if( !$(this).parent().hasClass('disabled') ) {
            $.ajax( {
                type: 'GET',
                url: url,
                cache: false
            })
                .done(function(data) {
                    $('.listeArticles').html(data);
                });
        }
    });
    
    $('.listeArticles .addArticle').live('click', function( e ) {
        e.preventDefault();
        var link = $(this);
        var url = $(this).attr('href');
        
        if( !$(this).hasClass('disabled') ) {
            $.ajax( {
                type: 'GET',
                url: url,
                cache: false
            })
                .done(function(data) {
                    $('.listeArticlesCampagne').append(data);
                })
                .always(function() {
                    link.addClass('disabled');
                });
        }
    });
    
    $('.listeArticlesCampagne .removeArticle').live('click', function( e ) {
        e.preventDefault();
        var row_id = $(this).parent().parent().attr('id');
        var art = "a" + row_id.substr(1, (row_id.length)-1);
        var url = $(this).attr('href');
        
        $.ajax( {
            type: 'GET',
            url: url,
            cache: false
        })
            .done(function() {
                $('#'+row_id).remove();
            })
            .always(function() {
                $("#" + art + " .addArticle").removeClass('disabled');
            });
    });
});