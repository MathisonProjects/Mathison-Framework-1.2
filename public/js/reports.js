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
  	  	if (action == 'showFields') {
          $.each(data, function(index, element) {
            $('#fields').append('<option value="'+index+'">'+element+'</option>');
            $('#filterArea').html($('#filterArea').html() + '<div class="form-group"><label for="filter['+index+']">' + element + '</label><br /><div class="checkbox"><label><input type="checkbox" name="filter['+index+'][filtered]"> Filter</label></div><select class="form-control" name="filter['+index+'][operator]"><option></option><option value="like">Contains</option><option value="=">Equals</option><option value="!=">Does Not Equal</option><option value=">">Greater Than</option><option value="<">Less Than</option><option value=">=">Greater Than or Equal To</option><option value="<=">Less Than or Equal To</option></select><input type="text" class="form-control" name="filter['+index+'][comparison]" /></div>');
            $('#totalsArea').html($('#totalsArea').html() + '<div class="form-group"><label for="totals['+index+']">' + element + '</label><br /><div class="checkbox"><label><input type="checkbox" name="totals['+index+'][compute]"> Compute</label></div><select class="form-control" name="totals['+index+'][operation]"><option></option><option value="sum">Sum</option><option value="average">Average</option></select></div>');
          });
        }
  	  },
    });
  }

  $('#object').change(function() {
    $('#fields').empty();
    $('#filterArea').html('');
    $('#totalsArea').html('');
  	$this = $(this);
  	$this.fireAjax('POST','/admin/super/objects/'+$this.val()+'/getFieldList', '', 'showFields');
  });

});
