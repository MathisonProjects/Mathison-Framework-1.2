$( document ).ready(function() {
  console.log("Create Object Ready!");
  
  if (!String.prototype.format) {
    String.prototype.format = function() {
      var args = arguments;
      return this.replace(/{(\d+)}/g, function(match, number) { 
        return typeof args[number] != 'undefined'
          ? args[number]
          : match
        ;
      });
    };
  }

  $('.addField').click(function(event) {
  	var totalFields = Number($('.totalFields').val()) + 1;

    var $datatypeoptions = '<select name="objectItemDataType{0}" id="objectItemDataType{0}" class="form-control">' + 
                      '<option value="varchar">varchar</option>' +
                      '<option value="int">int</option>' +
                      '<option value="blob">blob</option>' +
                      '<option value="datetime">datetime</option>' +
                      '<option value="decimal">decimal</option>';

  	$('.totalFields').val(totalFields);
  	$extraFields = $('.extraFields').html();
  	$('.extraFields').html($extraFields + '<div class="col-md-4"><div class="form-group">' +
			'<label for="objectItem'+totalFields+'">Field '+totalFields+':</label>' +
			'<input type="text" id="objectItemFieldName'+totalFields+'" placeholder="Field Name" class="form-control" maxlength="255" name="objectItemFieldName'+totalFields+'">' +
			$datatypeoptions.format(totalFields) +
			'<input type="text" id="objectItemQuantity'+totalFields+'" placeholder="Permitted Characters" class="form-control" maxlength="255" name="objectItemQuantity'+totalFields+'">' +
		'</div></div>');
  });

});