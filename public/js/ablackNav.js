 //open popup
 function showpopup(params) {
    var popup=document.getElementById(params); //get popup id through the parameter
    
    popup.style.transform = 'translate(-50%, -50%) scale(1)'; //change popup style onclick - show it 

        
  }
function hidepopup(params) {
  var popup=document.getElementById(params);    //get popup id through the parameter   
  
  popup.style.transform = 'translate(-50%, -50%) scale(0)';  //change popup style onclick - hide it
  
}