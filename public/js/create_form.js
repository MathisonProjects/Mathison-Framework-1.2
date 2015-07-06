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

    var newField = $(this).attr('class').split(/\s+/);;
    var name = ' name="customform['+totalFields+'][0]['+newField[4]+']"'
    $addedField = window[newField[4]](totalFields,name);
    

    $extraFields    = $('.extraFields').html();

    $('.extraFields').html($extraFields + '<div class="row col-md-12"><div class= "col-md-4"><div class = "form-group"><label>Field ' + 
                              totalFields + ' ' + newField[4] +':</label>' + $addedField + 
                              '</div></div><div class="col-md-2"><div class = "form-group"><label>Change Order:</label><br />'+
                              '<input type="text" placeholder="Order #" class="form-control" maxlength="2" name="order['+totalFields+']" /></div></div></div>');

  });

 });
  function add_Dropdown(totalFields,name) {
    return '<input type="text" placeholder="Dropdown Name Display" class="form-control" maxlength="255"'+name+' /><input type="text" placeholder="Dropdown,List,Here" class="form-control" name="customform['+totalFields+'][1][data]" />';
  }
  function add_Radiobuttons(totalFields,name) {
    return '<input type="text" placeholder="Radio Buttons Name Display" class="form-control" maxlength="255"'+name+' /><input type="text" placeholder="Radio,List,Here" class="form-control" name="customform['+totalFields+'][1][data]" />';
  }
  function add_Checkboxes(totalFields,name) {
    return '<input type="text" placeholder="Checkbox Name Display" class="form-control" maxlength="255"'+name+' /><input type="text" placeholder="Checkbox,List,Here" class="form-control" name="customform['+totalFields+'][1][data]" />';
  }
  function add_Textbox(totalFields,name) {
    return '<input type="text" placeholder="Field Name Display" class="form-control" maxlength="255"'+name+' />';
  }
  function add_Date(totalFields,name) {
    return '<input type="text" placeholder="Date Name Display" class="form-control" maxlength="255"'+name+' />';
  }
  function add_Time(totalFields,name) {
    return '<input type="text" placeholder="Time Name Display" class="form-control" maxlength="255"'+name+' />';
  }
  function add_Hidden_Field(totalFields,name) {
    return '<input type="text" placeholder="Hidden Field Name" class="form-control" maxlength="255"'+name+' />';
  }
  function add_Button(totalFields,name) {
    return '<input type="text" placeholder="Button Display" class="form-control" maxlength="255"'+name+' />';
  }
  function add_Submit(totalFields,name) {
    return '<input type="text" placeholder="Submit Display" class="form-control" maxlength="255"'+name+' />';
  }
  function add_File(totalFields,name) {
    return '<input type="text" placeholder="File Display" class="form-control" maxlength="255"'+name+' />';
  }
