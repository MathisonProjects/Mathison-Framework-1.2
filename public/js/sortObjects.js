$( document ).ready(function() {
  console.log("sortObjects.js Ready!");
  $.fn.getFieldList = function(type,url,params,action) {
  	$.ajax({
  	  type: type,
  	  url: url,
  	  data: params,
      contentType: "application/json; charset=utf-8",
      dataType: 'json',
  	  success: function(data) {
  	  	if (action == 'showFields') {
          $.each(data, function(index, element) {
            $('#fields').append('<option value="'+index+'">'+element+'</option>');
            $('#calculated').append('<option value="'+index+'">'+element+'</option>');
          });
        }
  	  },
    });
  }

  $('#object').change(function() {
    $('#fields').empty();
    $('#calculated').empty();
    $this = $(this);
    $this.getFieldList('POST','/admin/super/objects/'+$this.val()+'/getFieldList', '', 'showFields');
  });

});