<div class="hamburger_wrap">
	<nav class="hamburger hamburger-js">
		<div class="hamburger_wrap">
			<span class="hamburger_line -top"></span>
			<span class="hamburger_line -middle"></span>
			<span class="hamburger_line -bottom"></span>
		</div>
	</nav>
</div>

<script>

	$('.hamburger-js').click(function() {
			$(this).toggleClass('hamburger-js-active');
			$('#gnav').fadeToggle()
	})


</script>
