<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="/bower_components/jquery.countdown/dist/jquery.countdown.js"></script>

	<script type="text/javascript">
  	$('[data-countdown]').each(function() {
  var $this = $(this), finalDate = $(this).data('countdown');
  $this.countdown(finalDate, function(event) {
    $this.html(event.strftime('%D %H:%M:%S'));
  });
});
	</script>