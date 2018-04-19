$(function(){
    
    'use strict';
    
    var $messageSuccess = $('meta[name="message-success"]');
    var $messageError = $('meta[name="message-error"]');
    
    if($messageSuccess.length){                // Permette di creare il messaggio di conferma
        toastr.success($messageSuccess.attr('content'));
    }
    
    if($messageError.length){             // Permette di creare il messaggio d'errore
        toastr.error($messageError.attr('content'));
    }
    
});