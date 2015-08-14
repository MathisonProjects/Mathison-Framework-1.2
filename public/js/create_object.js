$( document ).ready(function() {
  console.log("Create Object Ready!");


  $('.addField').click(function(event) {
  	var totalFields = Number($('.totalFields').val()) + 1;

    var $datatypeoptions = '<select name="object[data][{0}]" id="object[data][{0}]" class="form-control">' + 
                      '<option value="varchar">varchar</option>' +
                      '<option value="int">int</option>' +
                      '<option value="blob">blob</option>' +
                      '<option value="datetime">datetime</option>' +
                      '<option value="decimal">decimal</option>';

  	$('.totalFields').val(totalFields);
  	$extraFields = $('.extraFields').html();
  	$('.extraFields').html($extraFields + '<div class="col-md-4"><div class="form-group">' +
			'<label for="object[name]['+totalFields+']">Field '+totalFields+':</label>' +
			'<input type="text" id="object[name]['+totalFields+']" placeholder="Field Name" class="form-control" maxlength="255" name="object[name]['+totalFields+']">' +
			$datatypeoptions.format(totalFields) +
			'<input type="text" id="object[quantity]['+totalFields+']" placeholder="Permitted Characters" class="form-control" maxlength="255" name="object[quantity]['+totalFields+']">' +
		  '<input type="text" id="object[default]['+totalFields+']" placeholder="Default Value" class="form-control" maxlength="255" name="object[default]['+totalFields+']">' +
    '</div></div>');
  });
});