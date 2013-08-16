/**
 * Placemark script is used to detect images on a page and create
 * the interface for the 
 * 
 * @author Adam Boerema
 * @author Rob Dozier
 * 
 */
baseurl = 'http://ec2-184-72-189-254.compute-1.amazonaws.com';

var pageload = {
	interval : null,
	
	condemn : function(object){
		var urls = [];
		for(var key in object){
			var obj = object[key];
			for (var url in obj){
				urls.push(obj[url]);
			}
		}
		var images = document.images;
		pageload.interval = setInterval(function(){
			for(i=0; i < images.length; i++){
				if(urls.indexOf(images[i].src) >= 0 && 
				   !images[i].classList.contains('condemned') &&
				   location.href !== baseurl){
						images[i].classList.add('condemned');
						images[i].src = baseurl + '/nic_cage.jpg';
						images[i].style.maxHeight = '250px';
				}	
			}
		}, 500);
	},
	
	imageList : function(){
		var ajax = new XMLHttpRequest(),
			url = baseurl + '/api/getcondemned';
		
		//success listener
		 ajax.onreadystatechange = function() {
	        if (ajax.readyState == 4 && ajax.status == 200) {
	            var response = JSON.parse(ajax.responseText);
	          	pageload.condemn(response);
	        }
    	}
    	ajax.open("POST", url, true);
    	ajax.setRequestHeader( 'Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    	ajax.send(null);
	}
}


window.load = pageload.imageList();


