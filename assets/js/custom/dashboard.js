$(document).ready(function () {
	const baseurl = $('.baseurl').data('baseurl');
	$('#send_notif').change(function () {
		const data = (this.checked == 1 ? 1 : 0);
		$.ajax({
			url: baseurl + "dashboard/post_notif",
			type: "POST",
			data: {status:data} ,
			success: function (response) {
				console.log(response);
			}
		});
	});
});