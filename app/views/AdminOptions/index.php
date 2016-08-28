<?php
/**
 * @package cms
 * @subpackage cms.app.views.AdminOptions
 */
if (isset($tpl['status']))
{
	switch ($tpl['status'])
	{
		case 1:
			Util::printNotice($CMS_LANG['status'][1]);
			break;
		case 2:
			Util::printNotice($CMS_LANG['status'][2]);
			break;
	}
} else {
	if (isset($_GET['err']))
	{
		switch ($_GET['err'])
		{
			case 5:
				Util::printNotice($CMS_LANG['option_err'][5]);
				break;
			case 7:
				Util::printNotice($CMS_LANG['status'][7]);
				break;
		}
	}
	?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminOptions&amp;action=update" method="post" class="cms-form">
		<input type="hidden" name="options_update" value="1" />
		<input type="hidden" name="tab_id" value="<?php echo isset($_GET['tab_id']) && !empty($_GET['tab_id']) ? $_GET['tab_id'] : 'tabs-1'; ?>" />
		<div id="tabs">
			<ul>
				<li><a href="#tabs-1"><?php echo $CMS_LANG['option_general']; ?></a></li>
			</ul>
			<div id="tabs-1">
			<?php
			$tab_id = 1;
			include VIEWS_PATH . 'AdminOptions/elements/tab.php'
			?>
			</div> <!-- tabs- -->
		</div>
	</form>
	<?php
	if (isset($_GET['tab_id']) && !empty($_GET['tab_id']))
	{
		$tab_id = explode("-", $_GET['tab_id']);
		$tab_id = (int) $tab_id[1] - 1;
		//$tab_id = (int) $_GET['tab_id'] - 1;
		$tab_id = $tab_id < 0 ? 0 : $tab_id;
		?>
		<script type="text/javascript">
		(function ($) {
			$(function () {
				$("#tabs").tabs("option", "selected", <?php echo $tab_id; ?>);
			});
		})(jQuery);
		</script>
		<?php
	}
}
?>