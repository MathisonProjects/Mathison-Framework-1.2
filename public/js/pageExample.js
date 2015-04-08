$(document).ready(function() {
  console.log("Page Example Ready!");

  $.fn.phpReplace = function(search,replaceWith) {
  	return this.val().split(search).join(replaceWith);
  }

  $('#datatext').on('keyup', function() {
  	$this = $(this);
  	if ($('#tid').val() == '') {
	  	$('.exampleDisplay').html($this.phpReplace('\n','<br />'));
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