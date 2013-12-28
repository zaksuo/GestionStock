$(document).ready( function () {
    $('.inventaire_article_quantite_field').live('keypress', function(e) {
        if(e.which == 13) {
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
        
        form.ajaxSubmit({
            target: articleRow,
            replaceTarget: true,
            type: 'post'
        });
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
    
})


