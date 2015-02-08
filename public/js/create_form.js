$( document ).ready(function() {
  console.log("Create Form Ready!");

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
    $('.totalFields').val(totalFields);
  	
    $extraFields = $('.extraFields').html();
    $fieldLabel = '<div class="col-md-4"><div class="form-group"><label for="formItem'+totalFields+'">Field '+totalFields+':</label>';
    $fieldText = '<input type="text" id="formItemFieldNameDisplay'+totalFields+'" placeholder="Field Name Display" class="form-control" maxlength="255" name="formItemFieldNameDisplay'+totalFields+'">';

    Field Chosen
    $('.extraFields').html($extraFields + $fieldLabel + $fieldText +
      $datatypeoptions.format(totalFields) + '</div></div>');

  });


  $('#baseObject').change(function() {
    $(this).prop('disabled', true);
  });

  $('#baseRelationship').change(function() {
    $(this).prop('disabled', true);
  });


 });