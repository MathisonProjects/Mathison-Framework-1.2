$( document ).ready(function() {
  console.log("reports.js Ready!");
  
  $.fn.fireAjax = function(type,url,params,action) {

  	$.ajax({
	  type: type,
	  url: url,
	  data: params,
      contentType: "application/json; charset=utf-8",
      dataType: 'json',
	  success: function(data) {
	  	
	  },
	});
  }

  $('#object').change(function() {
  	$this = $(this);
  	$this.fireAjax('POST','/admin/super/objects/'+$this.val()+'/getFieldList', 'showFields');
  });

});