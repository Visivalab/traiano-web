function logout(){
	$.ajax({
		url: 'calls/session_logout.php',
		success: function(){
			window.location.assign("index.php");
		}
	});
}
function open_menuUser(){
	$('.menu_user_opcions').toggleClass('visible');
}