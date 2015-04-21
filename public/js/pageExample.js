$(document).ready(function() {
  console.log("Page Example Ready!");

  $.fn.phpReplace = function(search,replaceWith) {
  	return this.val().split(search).join(replaceWith);
  }

  $.fn.setContent = function(template,$pageData) {
  	var sections = $pageData.split('\n@ENDSECTION');
  	var regExp = /\SECTION ([^)]+)\@/;
  	$.each(sections, function(key, value){
  		if (value != '') {
        value = value.substring(value.indexOf("@") + 1);
        var sectionName = regExp.exec(value)[1];
  			var partOne = 'SECTION '+sectionName+'@\n';
  			var newValue = value.split(partOne).join('');
        template = template.replace('[CONTENT='+sectionName+']',newValue);
	  	}
  	});
  	
  	return template;
  }

  $.fn.setForm = function() {
    var sections = this.val().split('@API ');
    var webContent = this.val();
    
    $.each(sections, function(key, value){
      var newValue = value.split('@')[0];
      if (!isNaN(newValue)) {
        var newData = '';
        $.ajax({
          type: "POST",
          async: false,
          url: '/admin/super/forms/format/' + newValue,
          data: '',
            contentType: "application/json; charset=utf-8",
            dataType: 'json',
          complete: function(data) {
            newData = data.responseText;
          },
        });
        webContent = webContent.split('@API '+newValue+'@').join(newData);
      }
    });
    return webContent;
  }

  $('#datatext').on('keyup', function() {
  	$this = $(this);
    var $pageData = $this.setForm();
  	if ($('#tid').val() == '' || $('#template').length > 0) {
	  	$('.exampleDisplay').html($pageData);
	} else {
		$tid     = $('#tid').val();
		$.ajax({
		  type: "POST",
		  url: '/admin/super/template/format/' + $tid,
		  data: '',
	      contentType: "application/json; charset=utf-8",
	      dataType: 'json',
		  success: function(data) {
		  	var displayData = $this.setContent(data.template,$pageData);
		  	$('.exampleDisplay').html(displayData);
		  },
		});
	}
  });

  $('#stringurl').on('keyup', function() {
  	$this = $(this);
  	$this.val($this.phpReplace(' ', '_'));
  	$this.focus();
  });
});