<?php
/**
 * @package tsbc
 * @subpackage tsbc.app.views.Layouts
 */
?>
<!doctype html>
<html>
	<head>
		<title>Install</title>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<?php
		foreach ($controller->css as $css)
		{
			//Remove the default CSS
			// echo '<link type="text/css" rel="stylesheet" href="'.$css['path'].$css['file'].'" />';
		}
		
		foreach ($controller->js as $js)
		{
			echo '<script type="text/javascript" src="'.$js['path'].$js['file'].'"></script>';
		}
		echo bootstrap_css();
		?>
	</head>
	<body>
		<header class="navbar navbar-default navbar-static-top">
			<div class="container">
				<div class="navbar-header">
					<div class="navbar-brand">Player Manager</div>
				</div>
			</div>
		</header>
		
		<div id="container_cms" class="container">

			<div id="main">
				<div class="row clearfix">
					<div class="col-sm-6 col-sm-offset-3">
						<?php require $content_tpl; ?>
					</div> <!-- /col -->
				</div> <!-- /row -->
			</div> <!-- /main -->
				
		</div> <!-- container_cms -->
	</body>
</html>