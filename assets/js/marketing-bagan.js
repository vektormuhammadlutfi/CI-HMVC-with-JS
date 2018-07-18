$(function(){
    var members;
    $.ajax({
        url: window.base_url + "chart_marketing/load_data",
        async:false,
        success:function(records){
            members=$.parseJSON(records)
        }
    })

        //id_marketing,id_atasan,nm_marketing
        for(var i = 0; i < members.length; i++){
            
            var member = members[i];
            
            if(i==0){
                $("#mainContainer").append("<li class="+member.level+" id="+member.id_marketing+"><br>"+member.nm_marketing+"<br>Jamaah Langsung : "+member.total_jamaah+"</li>")
            }else{
                
                if($('#pr_'+member.id_atasan).length<=0){
                  $('#'+member.id_atasan).append("<ul id='pr_"+member.id_atasan+"'><li class="+member.level+" id="+member.id_marketing+"><br>"+member.nm_marketing+"<br>Jamaah Langsung : "+member.total_jamaah+"</li></ul>")
                }
                else{
                  $('#pr_'+member.id_atasan).append("<li class="+member.level+" id="+member.id_marketing+"><br>"+member.nm_marketing+"<br>Jamaah Langsung : "+member.total_jamaah+"</li>")
                 }
                
            }
        }

    $("#mainContainer").orgChart({container: $("#main"),interactive: true, fade: true, speed: 'slow'}); 

}); 