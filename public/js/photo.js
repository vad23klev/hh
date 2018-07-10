function outphoto(srcelem,id){
	var files = document.getElementById(srcelem).files[0];
	if (window.File && window.FileReader && window.FileList && window.Blob) {
	// Only process image files.
		  var reader = new FileReader();

		  // Closure to capture the file information.
		  reader.onload = (function(theFile) {
			return function(e) {
				cfile = e.target.result;
				//alert(files.name);
				$('#'+id).html(files.name);
				//alert($('#'+id).html());

			};
		  })(files);

		  // Read in the image file as a data URL.
		  reader.readAsDataURL(files);
	} else {
		$('#'+id).append(files.name);
		//alert('The File APIs are not fully supported in this browser.');
	}
}