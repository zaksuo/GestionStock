$(document).ready(function(){
    $(".facture_article_row:odd").css('background', '#bcd5e6');
    
    $('.facture_article_row').live('mouseover', function(){
        $(this).find('.facture_article_actions').show();
    }).live('mouseout', function() {
        $(this).find('.facture_article_actions').hide();
    });
    
    $('#search_facture_article_field').keyup(function() {
        if($('#search_facture_article_field').val().length >= 2 ) {

            $('#search_facture_article_form').ajaxSubmit({
                target: '#search_results',
                replaceTarget: false,
                type: 'post'
            });
        }
    });
   
    $('.select_facture_article_link').live('click', function(e) {
            e.preventDefault();

            var article_existant = false;;
            var_id_facture = $('#id_facture').text();
            var id_article = $(this).parent().attr('id');
            var url = $(this).attr('href');

            $("#facture_article_list tr").each( function() {
                if( $(this).attr('id') == id_article ) {
                    article_existant = true;
                }
            });

            if( article_existant ) {
                $("#facture_erreurs").html("Cet article a dÃ©jÃ Â  Ã©tÃ© ajoutÃ© Ã Â la facture. Augmentez la quantitÃ© pour en ajouter.").fade(30);
            }
            else {
                $.ajax({
                    url : url,
                    success: function( data ) {
                        $('.facture_empty').hide();
                        $("#facture_article_list ul.facture_content").append(data);
                        updateRowColors();
                    }
                });
                $("#search_results").empty();
            }
    });

    $('.facture_article_quantite_field').live('focusout', function() {
        var form = $(this).parent().parent().parent();
        
        var articleRow = form.parent();
        
        form.ajaxSubmit({
            target: articleRow,
            replaceTarget: true,
            success: updateRowColors,
            type: 'post'
        });
        
        updateFactureTotal();
    });

    $('.facture_article_actions a').live('click', function(e) {
        e.preventDefault();
        article_row = $(this).parent().parent();
        
        url = $(this).attr('href');
        
        $.ajax({
            url : url,
            success: function() {
                article_row.remove();
                updateRowColors();
            }
        });
    });

    function updateRowColors() {
        $(".facture_article_row:odd").css('background', '#bcd5e6');
    }

    function updateFactureTotal() {
        var url = "updateTotal"
        $.ajax({
            url : url,
            success: function( data ) {
                $("#facture_total").replaceWith(data);
            }
        });
    }
});


