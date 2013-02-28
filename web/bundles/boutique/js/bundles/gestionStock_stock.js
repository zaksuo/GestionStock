$(document).ready(function(){

    $('#delete_stock').live('click', function(e) {
       if( !confirm('Il est impossible de revenir en arrière après suppression. Etes vous certain de vouloir supprimer cette entrée de stock ?') ) {
           e.preventDefault();
       } 
    });

/*
    $('.select_restock_link').live('click', function(e) {
        e.preventDefault();
        
        var id = $(this).parent().attr('id');
        var code = $(this).parent().parent().children('.article_code').text();
        var name = $(this).parent().parent().children('.article_libelle').text();
        
        var url = $(this).attr('href');

        $.ajax({
            url : url,
            success: function( data ) {
                $("#restock_form").html(data);
            }
        });
        //$('#boutique_databasebundle_stocktype_idArticle').val(id);
        //$('#search_article_field').val(code+" - "+name);
        $("#search_results").empty();
        $("#restock_selected_article").text("L'article '"+code+" - "+name+"' a été sélectionné pour le restockage.");
      
   });
*/
});