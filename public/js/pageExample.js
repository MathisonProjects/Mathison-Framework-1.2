$(document).ready(function() {
  console.log("Page Example Ready!");

  $.fn.phpReplace = function(search,replaceWith) {
  	return this.val().split(search).join(replaceWith);
  }

  $('#datatext').on('keyup', function() {
  	$this = $(this);
  	if ($('#tid').val() == '') {
	  	$('.exampleDisplay').html($this.phpReplace('\n','<br />'));
	} else {
		$tid     = $('#tid').val();
		var $content = new Array();
		$content[0] = $this.phpReplace('\n','<br />');
		//var json = $.parseJSON($content);
		$.ajax({
		  type: "POST",
		  url: '/admin/super/template/format/' + $tid,
		  data: '',
	      contentType: "application/json; charset=utf-8",
	      dataType: 'json',
		  success: function(data) {
		  	$('.exampleDisplay').html(data);
		  },
		});
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