$( document ).ready(function() {
  console.log("sortObjects.js Ready!");
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
            $('#calculated').append('<option value="'+index+'">'+element+'</option>');
          });
        }
  	  },
    });
  }

  $.fn.getCombinations = function(list) {
    // Empty list has one permutation
    if (list.length == 0)
      return [[]];
      
      
    var result = [];
    
    for (var i=0; i<list.length; i++)
    {
      // Clone list (kind of)
      var copy = Object.create(list);

      // Cut one element from list
      var head = copy.splice(i, 1);
      
      // Permute rest of list
      var rest = $(this).getCombinations(copy);
      
      // Add head to each permutation of rest of list
      for (var j=0; j<rest.length; j++)
      {
        var next = head.concat(rest[j]);
        result.push(next);
      }
    }
    
    return result;
  }

  $('#object').change(function() {
    $('#fields').empty();
    $('#calculated').empty();
    $this = $(this);
    $this.fireAjax('POST','/admin/super/objects/'+$this.val()+'/getFieldList', '', 'showFields');
  });

  $('.dynamic_sort').click(function() {
    var formdata = $(".form_sortable").serializeArray();
    var data = {};
    var allData = [];
    $(formdata).each(function(index, obj){
        data[obj.name] = obj.value;
        if (obj.name.indexOf('value') > -1) {
          allData[allData.length] = obj.value;
        }
    });

    if (allData.length < data['groupsof']) {
      $('.testing_combo').html('<pre>Too few items chosen.</pre>');
    } else {
      $('.testing_combo').html('<pre>Processing...</pre>');
      var result = $(this).getCombinations(allData);
    }
    console.log(result);
    // console.log(data);
  });

});