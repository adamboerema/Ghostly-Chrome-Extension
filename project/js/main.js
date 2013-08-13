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
			var closeToBottom = ($(window).scrollTop() + winHeight > $(document).height() - 100);
			if (closeToBottom) {
				var items = $('#main-grid .grid-item'),
					firstTen = items.slice(0, 10);
				grid.append(firstTen.clone());
				applyLayout();
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
		menuButton = $('#main-header .main-menu');
	
	menuButton.click(function(){
		if(menu.position().left == 0){
			menu.addClass('hide');
			menu.animate({
				left: '-250px'
			}, 500, 'easeInOutExpo');
			menuButton.animate({
				right: '-35px'
			}, 500, 'easeInOutExpo');
			grid.animate({
				marginLeft: '70px'
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
			grid.animate({
				marginLeft: '320px'
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
	
	var gridVote = $('#main-grid .grid-vote');
	
	gridVote.on('click', function(){
		$(this).addClass('clicked');
		$(this).find('.grid-vote-load').animate({
			top: '0'
		}, 1200);
		setTimeout(function(){
			$(this).removeClass('clicked');
			$(this).addClass('banned');
		}, 5000);
		return false;
	});
	
});