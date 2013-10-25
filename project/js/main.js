$(document).ready(function(){

	/*-------------------------------------------------------------------
	 *
	 * MAIN GRID
	 *
	-------------------------------------------------------------------*/
	
	var grid = $('#main-grid'),
		gridItem = $('#main-grid .grid-item');
		
	grid.imagesLoaded(function() {
	
		var handler = null;
		
		limit = 10;
		offset = 10;
		waiting = false;
		
        var options = {
			autoResize: true,
			container: $(this),
			offset: 20,
			itemWidth: 250
        };

		function applyLayout() {
			grid.imagesLoaded(function() {
				if (handler.wookmarkInstance) {
					handler.wookmarkInstance.clear();
				}
				handler = $('#main-grid .grid-item');
				handler.wookmark(options);
			});
		}
		
		function onScroll(event) {
			var winHeight = window.innerHeight ? window.innerHeight : $(window).height();
			var closeToBottom = ($(window).scrollTop() + winHeight > $(document).height());
			if (closeToBottom && !waiting) {
				waiting = true;	
				$.ajax({
					'url': baseurl.url + 'models/get_all.php',
					'type': 'POST',
					'data' : {
						'limit' : limit,
						'offset' : offset
					},
					success: function(data){
						var result = data.replace(/ /g, '');
						if(result && result !== 'false'){
							grid.append(data);
							applyLayout();
							offset += 10;
						}
					}
				});
				setTimeout(function(){
					waiting = false;
				},2000);
			}
		};
		
        $(window).bind('scroll', onScroll);

        handler = $('#main-grid .grid-item');
        handler.wookmark(options);
        
	});
	
	
	
	/*-------------------------------------------------------------------
	 *
	 * MAIN MENU
	 *
	-------------------------------------------------------------------*/
	
	var menu = $('#main-header'),
		menuButton = $('#main-header .main-menu'),
		gridWrapper = $('#main-grid-wrapper');
	
	menuButton.click(function(){
		if(menu.position().left == 0){
			menu.addClass('hide');
			menu.animate({
				left: '-250px'
			}, 500, 'easeInOutExpo');
			menuButton.animate({
				right: '-35px'
			}, 500, 'easeInOutExpo');
			gridWrapper.animate({
				marginLeft: '50px'
			}, 500, 'easeInOutExpo');
			setTimeout(function(){
				grid.trigger('refreshWookmark');
			}, 500);
		} else {
			menu.removeClass('hide');
			menu.animate({
				left: '0'
			}, 500, 'easeInOutExpo');
			menuButton.animate({
				right: '0'
			}, 500, 'easeInOutExpo');
			gridWrapper.animate({
				marginLeft: '300px'
			}, 500, 'easeInOutExpo');
			setTimeout(function(){
				grid.trigger('refreshWookmark');
			}, 500);
		}
		return false;
	});
	
	
	
	/*-------------------------------------------------------------------
	 *
	 * GRID VOTE
	 *
	-------------------------------------------------------------------*/

	$('#main-grid').on('click', '.grid-vote', function(){
		console.log('vote');
		if(!$(this).hasClass('banned')){
			var $this = $(this),
				gridNum = parseInt($this.find('.grid-text').text());
			$this.addClass('clicked');
			$this.find('.grid-vote-load').animate({
				top: '0'
			}, 1200);
			setTimeout(function(){
				$this.removeClass('clicked');
				var id = $this.data('id');
				console.log(id);
				$.ajax({
					'url': baseurl.url + 'models/vote.php',
					'type': 'POST',
					'data' : {
						'id' : id
					},
					success : function(data) {
						console.log(data);
						$this.addClass('banned');
						$this.find('.grid-text').text((gridNum) + 1);
					}
				});
			}, 1500);
		}
		return false;
	});
	
});