$( document ).ready(function() {
  console.log("Create Object Ready!");
  


  $('.addField').click(function(event) {
  	var totalFields = Number($('.totalFields').val()) + 1;
  	$('.totalFields').val(totalFields);
  	$extraFields = $('.extraFields').html();
  	$('.extraFields').html($extraFields + '<div class="col-md-4"><div class="form-group">' +
			'<label for="objectItem'+totalFields+'">Field '+totalFields+':</label>' +
			'<input type="text" id="objectItemFieldName'+totalFields+'" placeholder="Field Name" class="form-control" maxlength="255" name="objectItemFieldName'+totalFields+'">' +
			'<input type="text" id="objectItemDataType'+totalFields+'" placeholder="Data Type" class="form-control" maxlength="255" name="objectItemDataType'+totalFields+'">' +
			'<input type="text" id="objectItemQuantity'+totalFields+'" placeholder="Permitted Characters" class="form-control" maxlength="255" name="objectItemQuantity'+totalFields+'">' +
		'</div></div>');
  });

});