/**
 * Placemark script is used to detect images on a page and create
 * the interface for the 
 * 
 * @author Adam Boerema
 * @author Rob Dozier
 * 
 */

var activate = {
	onState : false,
	interval : null,
	
	init : function(){
		if(activate.onState){
			activate.onState = false;
		} else {
			activate.onState = true;
		}
		console.log('changed the cursor');
		//Change cursor on click and off if user clicks
		console.log(activate.onState);
		document.body.style.cursor = 'wait';
		activate.alterImages(activate.onState);
		
		document.body.onclick = function(){
			activate.onState = false;
			window.clearInterval(activate.interval);
			document.body.style.cursor = '';
			activate.alterImages(activate.onState);
		}
	},
	
	alterImages : function(onState) {
		var images = document.images;
		activate.interval = setInterval(function(){
			for(i=0; i < images.length; i++){
				if(images[i].height > 150 || images[i].width > 150){
					//add class
					if(onState){
						activate.addEvents(images[i]);
					} else{
						activate.removeEvents(images[i]);
					}
				}	
			}
		}, 500);
	},
	addEvents : function(e) {
		
		if(!e.classList.contains('tagged')){
			e.classList.add('tagged');
			e.onclick = function(){
				alert(e.src);
			}
		}
	},
		
	removeEvents : function(e) {
		e.classList.remove('tagged');
		e.onclick = function(){
			return false;
		}
	}

}

activate.init();
