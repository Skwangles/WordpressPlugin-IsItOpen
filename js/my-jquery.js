function setTrue(isTrue){
	if(isTrue){
	document.getElementById("status").innerHTML = "The Shop is Open";
	}
	else{
		document.getElementById("status").innerHTML = "The Shop is Closed";
	}
}




function openShop()
{
	setTrue(true);
	//the following POST code has been taken from https://pastebin.com/3VxAWpqZ and modified.
	           //noConflict wrapper
 
              //event
            
                 //event
            
    jQuery.ajax({
        type: 'POST',
		
        url: my_ajax_object.ajax_url,
        data: {action: 'open_pressed'}, 
        dataType:"json",
         success:function(response){
            alert(response);                  
        },
        error: function(response){
            alert(response+ " open error");
        }
    });                            
}




function closeShop(){

	//the following POST code has been taken from https://pastebin.com/3VxAWpqZ and modified.
	         //noConflict wrapper
 
              //event
       setTrue(false);    
    jQuery.ajax({
        type: 'POST',
		
        url: my_ajax_object.ajax_url,
        data: {action: 'close_pressed'}, 
        dataType:"json",
         success:function(response){
            alert(response);                  
        },
        error: function(response){
            alert(response + "close error");
        }
    }); 
                                     
		
  
}
