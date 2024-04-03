function createXmlHttpRequestObject(){
       
    var xmlHttp ;

    if (window.ActiveXObject) {
          try{

                 xmlHttp= new ActiveXObject("microsoft.XMLHTTP");


          }catch(e){

             xmlHttp = false;
          }


    }else{
          try{

             xmlHttp = new XMLHttpRequest();
          }catch(e){

             xmlHttp = false;
          }
    }

    if (!xmlHttp) 

       alert("cant create that object hosss!");
     else
         
         return xmlHttp;

}


function gett(){

    var xhr=createXmlHttpRequestObject();
    
    xhr.onreadystatechange = function p(){
        // On ne fait quelque chose que si on a tout reèµ et que le serveur est ok
        if(xhr.readyState ==4 && xhr.status == 200){
                donnees = xhr.responseText;
                
                //alert(donnees);
                console.log(donnees);
                // reload();
           
        // On se sert de innerHTML pour rajouter les options a la liste
        //alert(type);
        
        
        }

    }
    xhr.open("GET","http://127.0.0.1:8001/sync/getData",true);
    // ne pas oublier è¡ pour le post
    xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    // xhr.send();
}


function post_sync(){

           //alert("data");
           var pin=document.getElementById('getpin').value;
           var id=localStorage.getItem("idpack");
           var montant=localStorage.getItem("montantpack");
           var data = {"pin" : pin,"id" : id,"montant" : montant};
           alert(data['montant']);
           var url= base_url+"Compte/confirm_achat";
           var result = post_ajax(url,data);
           //alert(result);
           var details = JSON.parse(result);
           //$('#plan').html(details);

       }


function get_sync(){

           var url="http://127.0.0.1:8001/sync/getData";// base_url+"Admin/activ_user";
           var result = get_ajax(url);
           alert(result);
           //var details = JSON.parse(result);
           //console.log(result);
           //$('#plan').html(details);

       }


function desact_user(data){

           //alert("data");
           
           var data = {"idclient" : data};
           var url=base_url+"Admin/desact_user";
           var result = post_ajax(url,data);
           //alert(result);
           var details = JSON.parse(result);
           //$('#plan').html(details);

       }


function devenir(id,dat){

           //alert(id);
           //alert(dat);
           
           var data = {"idclient" : id, "fonction" : dat};
           var url=base_url+"Admin/devenir";
           var result = post_ajax(url,data);
           //alert(result);
           var details = JSON.parse(result);
           //$('#plan').html(details);

       }

function requett(data){

           alert(data);
           var motif = $('#motif').val();
           
           var data = {"motif" : motif,"fonction" : data};
           var url=base_url+"Compte/requett";
           var result = post_ajax(url,data);
           //alert(result);
           var details = JSON.parse(result);
           //$('#plan').html(details);

       }



function validemande(data){

           //alert(data);          
           var data = {"idclient" : data};
           var url=base_url+"Admin/validemande";
           var result = post_ajax(url,data);
           //alert(result);
           location.reload();
           var details = JSON.parse(result);
           //reload();
           //$('#plan').html(details);
       }

function annuldemande(data){

           //alert(data);          
           var data = {"idclient" : data};
           var url=base_url+"Admin/annuldemande";
           var result = post_ajax(url,data);
           //alert(result);
           location.reload();
           var details = JSON.parse(result);
           //reload();
           //$('#plan').html(details);
       }






   function load_pack_enreg_tab(){
       //var q = q;
       //var start = start;
   var xhr=createXmlHttpRequestObject();
   
   xhr.onreadystatechange = function p(){
       // On ne fait quelque chose que si on a tout reèµ et que le serveur est ok
       if(xhr.readyState ==4 && xhr.status == 200){
               donnees = xhr.responseText;
               
               //alert(donnees);
          
       // On se sert de innerHTML pour rajouter les options a la liste
       //alert(type);
       //var details = JSON.parse(result);
       alert(donnees);
       document.getElementById('pack_enreg').innerHTML =donnees;
       //alert(details);
       // if (type == 'Depot') {
       //     document.getElementById('corpsvalidation').innerHTML =donnees;
       // } else {
       //     document.getElementById('corpsretraitvalidation').innerHTML =donnees;
       // }
       
       }

   }
   xhr.open("POST",base_url+"Tab/enreg_tab",true);
   // ne pas oublier è¡ pour le post
   xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
   xhr.send();
}


function dataSync(url0, url1){
    getDataSync(url0);
    getDataSync(url1);

}


function getDataSync(url) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'Access-Control-Allow-Origin': '*',
            'Access-Control-Allow-Methods' :'*',
            'Access-Control-Allow-Headers' :'*',
        }
     });
    $.ajax({
        type: "GET",
        url: url,
        success: function(response) {
            console.log(response);
        },
        error: function (jqXHR, textStatus, errorThrown){
            console.log(jqXHR);
        },
        });
        
 }



function get_sync_ajax(url1, url2) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'Access-Control-Allow-Origin': '*',
            'Access-Control-Allow-Methods' :'*',
            'Access-Control-Allow-Headers' :'*',
        }
     });
    $.ajax({
        type: "GET",
        url: url1,
        dataType: "json",
        success: function(response) {
            console.log(response);
            //post_ajax_local(url2, response)
            //alert(response);
            //location.reload();
            //return response;
        },
        error: function (jqXHR, textStatus, errorThrown){
            console.log(jqXHR);
        },
        });
        
 }


 function post_ajax_local(url, data) {
    //alert($('meta[name="csrf-token"]').attr('content'));
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
     });

    // dataType: 'JSON',
    // contentType: false,
    // cache: false,
    // processData: false,

    $.ajax({
        type: "POST",
        url: url,
        data: JSON.stringify(2),
        dataType: "json",
        success: function(response) {
            console.log(response);
            //alert(response);
            //location.reload();
            //return response;
        },
        error: function (jqXHR, textStatus, errorThrown){
            console.log(data);
        },
        });
        
 }


function get_ajax(url) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
     });
    var result = '';
    $.ajax({
        type: "GET",
        url: url,
        dataType: "json",
        success: function(response) {
            result = response;
            //console.log(response);
            //alert(response);
            //location.reload();
            return response;
        },
        error: function(response) {
            result = 'response';
            return response;
        },
        });

        return result;
        
 }


function post_ajax(url, data) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Accept': 'application/json'
        }
     });
    // {_token: $('meta[name="csrf-token"]').attr('content')}
   $.ajax({
       type: "POST",
       url: url,
       data: data,
       dataType: "json",
       success: function(response) {
           result = response;
           alert(response);
           //location.reload();
       },
       error: function (jqXHR, textStatus, errorThrown){
                        console.log(data);
                    },
       });
       
}