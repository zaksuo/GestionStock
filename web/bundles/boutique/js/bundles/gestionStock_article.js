$(document).ready(function(){   
   $('#search_article_field').keyup(function() {
       if($('#search_article_field').val().length >= 2 ) {
           
           $('#search_article_form').ajaxSubmit({
               target: '#search_results',
               replaceTarget: false,
               //clearForm: true,
               //resetForm: true,
               type: 'post'
           });
           
       }
   });
 });


