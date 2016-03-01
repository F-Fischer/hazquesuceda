$(document).ready(function(){
    $('.pdf').fileValidator({
        onValidation: function(files){},
        onInvalid: function(validationType, file){}
    });
});