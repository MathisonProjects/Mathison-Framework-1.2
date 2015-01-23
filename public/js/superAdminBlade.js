$( document ).ready(function() {
  console.log("superAdminBlade Ready!");
  
  $('.totable').change(function() {
  	$.ajax({
	  type: "POST",
	  url: '/admin/super/getFields/' + $(this).val(),
	  data: '',
      contentType: "application/json; charset=utf-8",
      dataType: 'json',
	  success: function(data) {
	  	$('#tofield').empty();
	  	for (field in data) {
	  		$('#tofield').append($('<option>', { 'value' : data[field].name }).text(data[field].name));
	  	}
	  },
	  
	});
  });

});