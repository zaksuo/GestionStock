$(document).ready(function(){   
    $('#boutique_databasebundle_clienttype_telephone').live('keypress', function(e) {
        if( !IsNumeric(String.fromCharCode(e.which)) ) {
            return false;
        }
    });
    
    function IsNumeric(input){
        var RE = /^-{0,1}\d*\.{0,1}\d+$/;
        return (RE.test(input));
    }
 });
