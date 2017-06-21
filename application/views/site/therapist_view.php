<head>
	<?php foreach($css_files as $file): ?>
			<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
	<?php endforeach; ?>

	<?php foreach($js_files as $file): ?>
			<script src="<?php echo $file; ?>"></script>
	<?php endforeach; ?> 
</head>

  	<div class="container-fluid jumbotron">
  	<h1>Therapist</h1>
  		<div class="well">
  		
		<?php echo $output; ?>
		</div>
	</div>
