function popupImages(data, id) {
	$("#popupImg").attr("src", "gallery/" + id + "/" + data);
}

function readURL(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		//$('#modal-loader').show(); // hide loader
		reader.onload = function(e) {
			$('#reViewImg').attr('src', e.target.result);
		}

		reader.readAsDataURL(input.files[0]);
	}
}

$('#frm_images').on("submit", function(e) {
	e.preventDefault(); // form will not submitted
	//$('#modal-loader').show(); // hide loader
	$.ajax({
		url : "ajax_images.php",
		method : "POST",
		data : new FormData(this),
		contentType : false, // The content type used when sending data to
		// the server.
		cache : false, // To unable request pages to be cached
		processData : false, // To send DOMDocument or non processed data
		// file it is set to false
		success : function(data) {
			// $('#message_slideshow').html(''); // blank before load.
			$('#message_images').show(200).delay(6000).hide(200);
			$('#message_images').html(data); // load here
			// $('#modal-loader').hide();// hide loader
		}
	})
});
