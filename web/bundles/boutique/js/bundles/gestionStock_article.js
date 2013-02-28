$(document).ready(function(){   
   $('#search_article').live('keypress', function(e) {
       if(e.which == 13 || $('#search_article').val().length >= 2) {
           $('#search_article').val( $('#search_article').val() + String.fromCharCode(e.which) );
           $('#search_article_form').ajaxSubmit({
               target: '#search_results',
               replaceTarget: false,
               //clearForm: true,
               //resetForm: true,
               type: 'post'
           });
           return false;
       }
   });
   
   $('#btn-search').live('click', function(e) {
       e.preventDefault();
       $('#search_article_form').ajaxSubmit({
            target: '#search_results',
            replaceTarget: false,
            //clearForm: true,
            //resetForm: true,
            type: 'post'
       });
   });
   
 });


