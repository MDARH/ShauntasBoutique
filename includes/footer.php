</div>
	<footer class="text-center" id="footer">
		<div class="">
			&copy; Copyright 2013-2015 Shaunta's Boutique
		</div>
		<div class="">
			<a href="admin/index.php">Administration</a>
		</div>
	</footer>

	<script type="text/javascript">
		jQuery(window).scroll(function(){
			var vscroll = jQuery(this).scrollTop();
	jQuery('#logotext').css({
				"transform" : "translate(0px, "+vscroll/2+"px)"
			})

			var vscroll = jQuery(this).scrollTop();
	jQuery('#back-flower').css({
				"transform" : "translate("+vscroll/5+"px, -"+vscroll/12+"px)"
			})

			var vscroll = jQuery(this).scrollTop();
jQuery('#for-flower').css({
				"transform" : "translate(0px, -"+vscroll/2+"px)"
			})
		});

		function detailsmodal(id) {
			var data = {"id" : id};
			jQuery.ajax({
				url : '/shauntas_boutique/includes/detailsmodal.php',
				method : "post",
				data : data,
				success : function (data) {
					jQuery('body').append(data);
					jQuery('#details-modal').modal('toggle');
				},
				error : function(){
					alert("Something went wrong!");
				}
			});

		}
	</script>
</body>
</html>
