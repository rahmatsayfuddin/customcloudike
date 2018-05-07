

</div>
<!-- END PAGE CONTAINER -->
<!-- START SCRIPTS -->
<!-- START TEMPLATE -->
<script type="text/javascript" src="<?php echo base_url()?>/asset/js/settings.js"></script>

<script type="text/javascript" src="<?php echo base_url()?>/asset/js/plugins.js"></script>        
<script type="text/javascript" src="<?php echo base_url()?>/asset/js/actions.js"></script>
<!-- END TEMPLATE -->
<!-- END SCRIPTS -->  

<script type="text/javascript">

// image gallery
// init the state from the input
$(".image-checkbox").each(function () {
	if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
		$(this).addClass('image-checkbox-checked');
	}
	else {
		$(this).removeClass('image-checkbox-checked');
	}
});

// sync the state to the input
$(".image-checkbox").on("click", function (e) {
	$(this).toggleClass('image-checkbox-checked');
	var $checkbox = $(this).find('input[type="checkbox"]');
	$checkbox.prop("checked",!$checkbox.prop("checked"))

	e.preventDefault();
});

</script>

</body>
</html>