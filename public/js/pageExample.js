$(document).ready(function() {
  console.log("Page Example Ready!");

  $.fn.phpReplace = function(search,replaceWith) {
  	return this.val().split(search).join(replaceWith);
  }

  $.fn.setContent = function(template) {
  	var sections = $this.val().split('@ENDSECTION');
  	var regExp = /\@SECTION ([^)]+)\@/;
  	$.each(sections, function(key, value){
  		if (value != '') {
        var sectionName = regExp.exec(value)[1];
  			var partOne = '@SECTION '+sectionName+'@';
  			var newValue = value.split(partOne).join('');
        template = template.replace('[CONTENT='+sectionName+']',newValue);
	  	}
  	});
  	
  	return template;
  }

  $('#datatext').on('keyup', function() {
  	$this = $(this);
  	if ($('#tid').val() == '') {
	  	$('.exampleDisplay').html($this.phpReplace('\n','<br />'));
	} else {
		$tid     = $('#tid').val();
		$.ajax({
		  type: "POST",
		  url: '/admin/super/template/format/' + $tid,
		  data: '',
	      contentType: "application/json; charset=utf-8",
	      dataType: 'json',
		  success: function(data) {
		  	var displayData = $this.setContent(data.template);
		  	$('.exampleDisplay').html(displayData);
		  },
		});
	}
  });

  $('#datatextTemplate').on('keyup', function() {
  	$this = $(this);
    $('.exampleDisplay').html($this.phpReplace('\n','<br />'));
  });

  $('#stringurl').on('keyup', function() {
  	$this = $(this);
  	$this.val($this.phpReplace(' ', '_'));
  	$this.focus();
  });
});