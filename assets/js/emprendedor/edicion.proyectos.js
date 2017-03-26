/**
 * Created by franc on 3/26/2017.
 */
$(document).ready(function () {

    function redirect(uri,attr) {
        pathArray = location.href.split( '/' );
        protocol = pathArray[0];
        host = pathArray[2];
        if(host.includes(".org")){
            if(attr==""){
                url = protocol + '//' + host + '/' + uri;
            }
            else{
                url = protocol + '//' + host + '/' + uri + '/' + attr;
            }
        }
        else {
            if(attr==""){
                url = protocol + '//' + host + '/hazquesuceda/' + uri;
            }
            else{
                url = protocol + '//' + host + '/hazquesuceda/' + uri + '/' + attr;
            }
        }
        window.location.href = url;
    }


    $("#btnRegresar").click(function(){
        redirect("misproyectos","");
    });


});
