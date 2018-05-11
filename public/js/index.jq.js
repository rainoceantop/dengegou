$(function(){
	$('#contact-us-button').click(function(){
		let $target = $(this.hash)
		$target = $target.length && $target || $('[name=' + this.hash.slice(1) + ']')  
		let targetOffset = $target.offset().top
		$('html,body').animate({    
			scrollTop: targetOffset    
		},    
		500)
		return false
	})
})