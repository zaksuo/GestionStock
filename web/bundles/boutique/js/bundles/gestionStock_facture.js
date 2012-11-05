$(document).ready(function(){
    $(".facture_article_row:odd").css('background', '#bcd5e6');
    
    $('#search_facture_article_field').keyup(function() {
        if($('#search_facture_article_field').val().length >= 2 ) {

            $('#search_facture_article_form').ajaxSubmit({
                target: '#search_results',
                replaceTarget: false,
                //clearForm: true,
                //resetForm: true,
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
                $("#facture_erreurs").html("Cet article a déjà  été ajouté à la facture. Augmentez la quantité pour en ajouter.").fade(30);
            }
            else {
                $.ajax({
                    url : url,
                    success: function( data ) {
                        $('.facture_empty').hide();
                        $("#facture_article_list ul.facture_content").append(data);
                        $(".facture_article_row:odd").css('background', '#bcd5e6');
                    }
                });
                $("#search_results").empty();
            }
    });

    $('.facture_article_quantite_field').live('keyup', function() {
        var value = $(this).val();
        
        var id_article = $(this).parent().parent().parent().parent().attr('id');
        var prix_total_ht = $(this).parent().parent().parent().children('.prix_total_ht');

        var form = $(this).parent();

        var total_ht = getArticlePrixTotalHt(form, value, prix_total_ht);
        var total_tva = updateArticleTvaTotal(id_article);
        if( total_ht || total_tva ) updateFactureTotal();
    });

    function getArticlePrixTotalHt(form, value, updateField) {
        if( value == parseFloat(value) || value == parseInt(value) ) {
            form.ajaxSubmit({
                target: updateField,
                replaceTarget: false,
                type: 'post'
            });
            return true;
        }
        else {
            $("#facture_erreurs").html("La valeur saisie n'est pas conforme, ce doit Ãªtre un dÃ©cimal ou un entier").fade(30);
            return false;
        }
    }

    function updateArticleTvaTotal(idFactArticle) {
        var url = "getArticleTotalTva"
        $.ajax({
            url : url,
            success: function( data ) {
                $('#'+idFactArticle+" facture_article_tva article_tva").html(data);
                alert(data);
            }
        });
    }

    function updateFactureTotal() {
        var id_facture = $("#id_facture").text();
        var url = "updateTotal"
        $.ajax({
            url : url,
            success: function( data ) {
                $("#facture_total").replaceWith(data);
            }
        });
    }
});


