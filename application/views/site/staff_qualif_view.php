<head>
	<?php foreach($css_files as $file): ?>
			<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
	<?php endforeach; ?>

	<?php foreach($js_files as $file): ?>
			<script src="<?php echo $file; ?>"></script>
	<?php endforeach; ?> 
</head>

  	<div class="container-fluid jumbotron">
  		<h1>Therapist Qualifications</h1>
  			<p id="addMessage"></p>
  			<script> $(document).ready(function() {
					if (window.location.pathname == ("/uh-team-a/index.php/therapist_qualif/staff_qualif/add")) {
						if (!window.location.search) {
							document.getElementById("addMessage").innerHTML = "<pre class='alert alert-warning'>Please ensure the staff member is set up as a therapist before assigning a qualifications.</pre>";
						}
					}
	
				});
			</script>
  		<div class="well">
		<?php echo $output; ?>


	</div>
	</div>
	
