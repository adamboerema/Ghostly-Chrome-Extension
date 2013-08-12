/**
 * Placemark script is used to detect images on a page and create
 * the interface for the 
 * 
 * @author Adam Boerema
 * @author Rob Dozier
 * 
 */

var activate = {
	onState : null,
	interval : null,	
	
	init : function(){
		activate.onState = true;
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
					if(onState == true){
						activate.addEvents(images[i]);
					} else{
						activate.removeEvents(images[i]);
					}
				}	
			}
		}, 500);
	},
	addEvents : function(e) {
		console.log('add');
		if(!e.classList.contains('tagger-image')){
			e.classList.add('tagger-image');
			activate.wrap(e);
		}
	},
		
	removeEvents : function(e) {
		console.log('remove');
		if(e.classList.contains('tagger-image')){
			var clone = e,
				originalParent = e.parentNode.parentNode;
				
			originalParent.removeChild(e.parentNode);
			originalParent.appendChild(clone);
			clone.classList.remove('tagger-image');
		}
	},
	
	/**
	 * Wrap element with a container div element
 	 * @param {Object} el
	 */
	wrap : function(e){
		var parent = e.parentNode,
			clone = e,
			height = e.height,
			width = e.width;

		//Setup container element
		var container = document.createElement('div');
		container.className = 'tagger-container';
		
		//add and setup the overlay 
		var overlay = document.createElement('div');
		overlay.className = 'tagger-overlay';
		overlay.style.height = height + 'px';
		overlay.style.width = width + 'px';
		overlay.onclick = function(){
			alert(e.src);
			return false;
		}
		
 		//Set up the DOM
		parent.removeChild(e);
		container.appendChild(clone);
		container.appendChild(overlay);
		parent.appendChild(container);

		
	}
}

activate.init();
