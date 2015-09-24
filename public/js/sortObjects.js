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

  $.fn.getObjectData = function(type,url) {
    return $.parseJSON($.ajax({
        type: type,
        url: url,
        contentType: "application/json; charset=utf-8",
        dataType: 'json',
        async: false
      }).responseText);
  }

  $.fn.formDataParse = function(data) {
    this.data = data;
    this.addon = [];
    return this;
  }

  $.fn.runComparisons = function(combos, dataList, formData) {
    var finalArray = [];
    var aggregatedArray = [];
    var i = 0;
    var finalArray = [];

    $(combos).each(function(index,obj){
      var form = $().formDataParse(formData);
      $(obj).each(function(index2,obj2){
        var item = 'item' + index2;
        var addon = {item:obj2};
        form.addon.push(addon);
      });
      aggregatedArray.push(form);
    });

    $(aggregatedArray).each(function(index,obj){
      var passData = '';
      $(obj.data).each(function(index2,obj2){
        if (passData != '') {
          passData += '&';
        }
        passData += obj2.name + "=" + obj2.value;
      });
      $(obj.addon).each(function(index2,obj2){
        if (passData != '') {
          passData += '&';
        }
        passData += 'item' + index2 + "=" + obj2.item;
      })

      var splitData = passData.split("&");
      var sendData = {};
      for(var key in splitData) {
          sendData[splitData[key].split("=")[0]] = splitData[key].split("=")[1];
      }

      var valid = $.ajax({
        type: 'POST',
        url: '/admin/super/objects/sorting/test',
        data: JSON.stringify(sendData),
        contentType: "application/json; charset=utf-8",
        dataType: 'json',
        async: false
      }).responseText;
      if (valid == 'true') {
        finalArray.push(obj.addon);
      }
    });
    return finalArray;
  }

  $.fn.sets = function(input, size) {
    var results = [], result, mask, total = Math.pow(2, input.length);
    for(mask = 0; mask < total; mask++){
        result = [];
        i = input.length - 1;
        do{
            if( (mask & (1 << i)) !== 0){
                result.push(input[i]);
            }
        }while(i--);
        if( result.length == size){
            results.push(result);
        }
    }

    return results; 
  }

  $('#object').change(function() {
    $('#fields').empty();
    $('#calculated').empty();
    $this = $(this);
    $this.getFieldList('POST','/admin/super/objects/'+$this.val()+'/getFieldList', '', 'showFields');
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

    var itemData = [];
    $(allData).each(function(index, obj) {
      $this = $(this);
      itemData[itemData.length] = $this.getObjectData('POST','/admin/super/objects/'+allData[index]+'/'+data['oid']+'/getJsonObjectItemData');
    });

    if (allData.length < data['groupsof']) {
      $('.testing_combo').html('<pre>Too few items chosen.</pre>');
    } else {
      $('.testing_combo').html('<center><img src="/images/processing.gif" /></center>');
      var result = $(this).sets(allData,data['groupsof']);
    }
    var validResults = $(this).runComparisons(result,itemData,formdata);
    console.log(validResults);
    $('.testing_combo').html('<pre>Completed Dynamic Sort</pre>');
  });

});