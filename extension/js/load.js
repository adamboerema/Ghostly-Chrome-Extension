/**
 * Placemark script is used to detect images on a page and create
 * the interface for the 
 * 
 * @author Adam Boerema
 * @author Rob Dozier
 * 
 */

var placemark = {
	
	createButton : function(context, src){
		var button = document.createElement('button')
		button.innerHTML = "REAPER";
		button.value = src;
		button.class = 'reaper-button';
		button.style.zIndex = 99999999;
		button.style.left = '0%';
		button.style.top = '0%';
		button.style.position = 'absolute';
		button.style.height = '75px';
		button.style.width = '75px';
	    button.onclick = function(){
	    	alert('hi');
	    };
	    
	   context.parentNode.appendChild(button);
	}
}


//window.load = placemark.getImages()


