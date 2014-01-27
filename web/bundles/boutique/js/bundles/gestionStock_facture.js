$(document).ready(function(){
    $('#search_facture_article_field').live('keypress', function(e) {
        if(e.which == 13 || $('#search_facture_article_field').val().length >= 2) {
            $('#search_facture_article_field').val( $('#search_facture_article_field').val() + String.fromCharCode(e.which) );
            $('#search_facture_article_form').ajaxSubmit({
                target: '#article_search_results',
                replaceTarget: false,
                type: 'post'
            });
            return false;
        }
    });
    
    $('#facture_client_search_field').live('keypress', function(e) {
       if(e.which == 13 || $('#facture_client_search_field').val().length >= 2 ) {
           $('#facture_client_search_field').val( $('#facture_client_search_field').val() + String.fromCharCode(e.which) );
           $('#facture_client_search_form').ajaxSubmit({
               target: '#client_search_results',
               replaceTarget: false,
               type: 'post'
           });
           return false;
       }
   });
   
   $('#client_search_form_btn').live('click', function(e) {
        e.preventDefault();
        $('#facture_client_search_form').ajaxSubmit({
            target: '#client_search_results',
            replaceTarget: false,
            type: 'post'
        });
   });
   
   $('#article_search_form_btn').live('click', function(e) {
        e.preventDefault();
        $('#search_facture_article_form').ajaxSubmit({
            target: '#article_search_results',
            replaceTarget: false,
            type: 'post'
        });
   });
   
    $('.add-article-btn').live('click', function(e) {
            e.preventDefault();

            var article_existant = false;
            var_id_facture = $('#id_facture').text();
            var id_article = $(this).parent().attr('id');
            var url = $(this).attr('href');

            $(".facture-form tbody tr").each( function() {
                if( $(this).attr('id') == id_article ) {
                    article_existant = true;
                }
            });

            if( article_existant ) {
                $("#facture_erreurs .modal-body").html("<p>Cet article a déjà été ajouté à la facture. Augmentez la quantité pour en ajouter.</p>");
                $("#facture_erreurs").modal("toggle");
            }
            
            else {
                $.ajax({
                    url : url,
                    success: function( data ) {
                        $('.facture_empty').hide();
                        $(".facture-form tbody").append(data);
                        updateFactureTotal();
                    }
                });
                $("#article_search_results").empty();
            }
    });

    $('.select_facture_client_link').live('click', function(e) {
        e.preventDefault();

        var_id_facture = $('#id_facture').text();
        var url = $(this).attr('href');

        $.ajax({
            url : url,
            success: function( data ) {
                $("#facture_client").html(data);
            }
        });
        $("#client_search_results").empty();
    });
    
    $('.facture_article_quantite_field').live('keypress', function(e) {
        if(e.which == 13) {
            var form = $(this).parent();
            var articleRow = $(this).parent().parent().parent();

            form.ajaxSubmit({
                target: articleRow,
                replaceTarget: true,
                type: 'post',
            beforeSubmit: function( arr, $form, options ) {
                var rem_id = ".rem" + articleRow.attr('id');
                $(rem_id).remove();
            },
            success : function() {
                updateFactureTotal();
            }
            });
            return false;
        }
    });
    
    $('.facture_article_quantite_field').live('focusout', function() {
        var form = $(this).parent();
        var articleRow = $(this).parent().parent().parent();
        
        form.ajaxSubmit({
            target: articleRow,
            replaceTarget: true,
            type: 'post',
            beforeSubmit: function( arr, $form, options ) {
                var rem_id = ".rem" + articleRow.attr('id');
                $(rem_id).remove();
            },
            success : updateFactureTotal
        });
    });

    $('.fact_action_menu a').live('click', function(e) {
        e.preventDefault();
        article_row = $(this).parent().parent();
        
        url = $(this).attr('href');
        
        $.ajax({
            url : url,
            success: function() {
                article_row.remove();
                updateFactureTotal();
            }
        });
    });

//    $('#facture_client_new').live('click', function(e) {
//       e.preventDefault();
//       $('#facture_client_new_container').removeClass('hidden');
//    });
//
//    $('#client_new_form_cancel').live('click', function(e) {
//        e.preventDefault();
//       $('#facture_client_new_container').addClass('hidden');
//    });
//    
    $('#facture_client_new_submit').live('click', function(e) {
        e.preventDefault();
        var form = $('#facture_client_new_form');
        form.ajaxSubmit({
            target: $('#facture_client'),
            replaceTarget: true,
            success: hideClientForm,
            resetForm: true,
            clearForm: true,
            type: 'post'
        });
    })


    function updateFactureTotal() {
        var url = "updateTotal"
        $.ajax({
            url : url,
            success: function( data ) {
                $(".facture-form tfoot").html(data);
            }
        });
    }
    
    function hideClientForm() {
        $('#facture_client_new_container').hide();
    }
});


