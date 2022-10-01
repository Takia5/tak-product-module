$(document).ready(function(){
    $('#productType').on('change', function(){
    var typevalue = $(this).val();                 
    $("div.hide").hide();
    $("#"+typevalue).show();
    });

});
//Closing function ********************************************


function setValuesBook(GotID){

    var gotWeight=document.getElementById(GotID).value;
    var book_weight="Weight: "+gotWeight+ "KG";;
    document.getElementById("productSize").setAttribute("value", book_weight);

 }//Closing   function setValuesBook() ********************************************

                  
function setValuesfuniture(){          

    var furniture_height=document.getElementById("height").value;
    var furniture_width=document.getElementById("width").value;
    var furniture_length=document.getElementById("length").value;
    var dimensions="Dimensions:"+furniture_height+"X"+furniture_width+"X"+furniture_length;
    dimensions=  dimensions.replace(/XX/g,'');
    document.getElementById("productSize").setAttribute("value", dimensions);

}//Closing  function setValuesfuniture() ********************************************

function setValuesDvd(){ 

    var dvd_size=document.getElementById("size").value;
    var dvd_size="Size:"+dvd_size+" " + "MB"; 
    document.getElementById("productSize").setAttribute("value", dvd_size);

}//Closing  function setValuesDvd() ********************************************
