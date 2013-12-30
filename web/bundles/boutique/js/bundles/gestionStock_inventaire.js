$(document).ready( function () {
    $('.inventaire_article_quantite_field').live('keypress', function(e) {
        if(e.which == 13 && $(this).val().length > 0) {
            var form = $(this).parent();
            var articleRow = $(this).parent().parent().parent();

            form.ajaxSubmit({
                target: articleRow,
                replaceTarget: true,
                type: 'post'            
            });
            return false;
        }
    });
    
    $('.inventaire_article_quantite_field').live('focusout', function() {
        var form = $(this).parent();
        var articleRow = $(this).parent().parent().parent();
        if( $(this).val().length > 0 ) {
            form.ajaxSubmit({
                target: articleRow,
                replaceTarget: true,
                type: 'post'
            });
        }
    });
    
    $('#inventaire_cloture').live('click', function(e) {
        var message = "Cette opération n'est pas réversible. Etes-vous certain de vouloir finaliser cet inventaire ? \n\n"
                    + "Finaliser cet inventaire : \n"
                    + " - Ne vous permettra pas de le modifier par la suite en cas d'erreur,\n"
                    + " - Va calculer le total du stock HT, ainsi que les pertes estimées en fonction de l'inventaire,\n"
                    + " - Mettra à jour la quantité de stock de tous les articles pour lesquels la quantité calculée ne sera pas identique à celle du système.\n";
        if( !confirm ( message ) ) {
           e.preventDefault();
           return false;
        }
    });
    
    $('#add_divers_form').dialog({
      autoOpen: false,
      height: 300,
      width: 600,
      modal: true,
      close: function() {
        allFields.val( "" ).removeClass( "ui-state-error" );
      }
    });
    
    $( "#inv_divers_add" ).live('click', function(e) {
        e.preventDefault();
        $( "#add_divers_form" ).dialog( "open" );
    });
    
    $( "#close_new_divers" ).live('click', function(e) {
        e.preventDefault();
        $( "#add_divers_form" ).dialog( "close" );
    });
    
    $('#quantify_article_form').dialog({
        autoOpen: false,
        height: 530,
        width: 600,
        modal: true,
        close: function() {
            $('#inv_search_article_field').val('');
            $('#article_search_results').empty();
            allFields.val( "" ).removeClass( "ui-state-error" );
        }
    });
    
    $( "#inv_article_quantify" ).live('click', function(e) {
        e.preventDefault();
        $( "#quantify_article_form" ).dialog( "open" );
    });
    
    $( "#close_quantify_article" ).live('click', function(e) {
        e.preventDefault();
        $('#inv_search_article_field').val('');
        $('#article_search_results').empty();
        $( "#quantify_article_form" ).dialog( "close" );
    });

    $('#inv_article_quantity_submit').live('click', function(e) {
        e.preventDefault();
        var form = $("#article_quantity_form_table");

        if( $('#inventaire_article_quantity_field').val().length > 0 ) {
            form.ajaxSubmit({
                type: 'post',
                success: function() {
                    location.reload();
                }
            });
            return false;
        }
    });
    
    $('#inv_search_article_submit').live('click', function(e) {
        $('#search_inv_article_form').ajaxSubmit({
            target: '#article_search_results',
            replaceTarget: true,
            type: 'post'
        });
        return false;
    });
})


