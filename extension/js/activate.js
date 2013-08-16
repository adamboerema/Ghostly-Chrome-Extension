/**
 * Placemark script is used to detect images on a page and create
 * the interface for the 
 * 
 * @author Adam Boerema
 * @author Rob Dozier
 * 
 */
baseurl = 'http://ec2-184-72-189-254.compute-1.amazonaws.com';
//baseurl = 'http://extension.local';

var activate = {
	onState : null,
	interval : null,	
	
	init : function(){
		//Activate the cursor override
		document.getElementsByTagName('html')[0].classList.add('override-cursor');
		
		activate.onState = true;		
		activate.alterImages(activate.onState);
		
		document.body.onclick = function(){
			activate.disable();			
		}
	},
	disable: function(){
		activate.onState = false;
		window.clearInterval(activate.interval);
		document.getElementsByTagName('html')[0].classList.remove('override-cursor');
		activate.alterImages(activate.onState);
	},
	alterImages : function(onState) {
		var images = document.images;
		if(onState == true){
			activate.interval = setInterval(function(){
				for(i=0; i < images.length; i++){
					if(images[i].height > 150 || images[i].width > 150){
						activate.addEvents(images[i]);
					}	
				}
			}, 500);
		} else {
			for(i=0; i < images.length; i++){
				activate.removeEvents(images[i]);
			}
		}
	},
	addEvents : function(e) {
		//console.log('add');
		if(!e.classList.contains('tagger-image')){
			e.classList.add('tagger-image');
			activate.wrap(e);
		}
	},
		
	removeEvents : function(e) {
		//console.log('remove');
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
		container.style.position = 'relative';
		
		//add and setup the overlay 
		var overlay = document.createElement('div');
		overlay.className = 'tagger-overlay';
		overlay.style.height = height + 'px';
		overlay.style.width = width + 'px';
		overlay.onclick = function(){
			activate.sendImage(e.src);
			activate.disable();
			return false;
		}
		
 		//Set up the DOM
		parent.removeChild(e);
		container.appendChild(clone);
		container.appendChild(overlay);
		parent.appendChild(container);
	},
	sendImage : function(img){
		var ajax = new XMLHttpRequest(),
			url = baseurl + '/api/add';
		
		//success listener
		 ajax.onreadystatechange = function() {
	        if (ajax.readyState == 4 && ajax.status == 200) {
	            console.log(ajax.responseText);
	        }
    	}
    	ajax.open("POST", url, true);
    	ajax.setRequestHeader( 'Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    	ajax.send("url=" + img);
	}
}

activate.init();
