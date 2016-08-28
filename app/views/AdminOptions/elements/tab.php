<?php
/**
 * @package cms
 * @subpackage cms.app.views.AdminOptions.elements
 */
if (isset($tpl['arr']))
{
	if (is_array($tpl['arr']))
	{
		$count = count($tpl['arr']);
		if ($count > 0)
		{
			foreach ($tpl['arr'] as $group => $arr)
			{
				if (count($arr) == 0) continue;
				ob_start();
				if (!empty($group))
				{
					?><h3><?php echo $group; ?></h3><?php
				}
				?>
				<table cellpadding="2" cellspacing="1" class="cms-table">
					<thead>
						<tr>
							<th class="sub" style="width: 50%"><?php echo $CMS_LANG['option_description']; ?></th>
							<th class="sub"><?php echo $CMS_LANG['option_value']; ?></th>
						</tr>
					</thead>
					<tbody>
					<?php
					
				$j = 0;
				for ($i = 0; $i < count($arr); $i++)
				{
					if ($arr[$i]['tab_id'] == $tab_id)
					{

						?><tr class="<?php echo ($j % 2 === 0 ? 'odd' : 'even'); ?>"><?php
						
						?>
							<td class="align_top"><?php echo stripslashes($arr[$i]['description']);?></td>
							<td class="align_top">
								<?php
								switch ($arr[$i]['type'])
								{
									case 'string':
										?><input type="text" name="value-<?php echo $arr[$i]['type']; ?>-<?php echo $arr[$i]['key']; ?>" class="text w300" value="<?php echo htmlspecialchars(stripslashes($arr[$i]['value'])); ?>" /><?php
										break;
									case 'text':
										?><textarea name="value-<?php echo $arr[$i]['type']; ?>-<?php echo $arr[$i]['key']; ?>" class="textarea w400 h320"><?php echo htmlspecialchars(stripslashes($arr[$i]['value'])); ?></textarea><?php
										break;
									case 'int':
										?><input type="text" name="value-<?php echo $arr[$i]['type']; ?>-<?php echo $arr[$i]['key']; ?>" class="text w50 align_right digits" value="<?php echo htmlspecialchars(stripslashes($arr[$i]['value'])); ?>" />
										<?php
										break;
									case 'float':
										?><input type="text" name="value-<?php echo $arr[$i]['type']; ?>-<?php echo $arr[$i]['key']; ?>" class="text w50 align_right number" value="<?php echo htmlspecialchars(stripslashes($arr[$i]['value'])); ?>" /><?php
										break;
									case 'enum':
										?><select name="value-<?php echo $arr[$i]['type']; ?>-<?php echo $arr[$i]['key']; ?>" class="select">
										<?php
										$default = explode("::", $arr[$i]['value']);
										$enum = explode("|", $default[0]);
										
										$enumLabels = array();
										if (!empty($arr[$i]['label']) && strpos($arr[$i]['label'], "|") !== false)
										{
											$enumLabels = explode("|", $arr[$i]['label']);
										}
										
										foreach ($enum as $k => $el)
										{
											if ($default[1] == $el)
											{
												?><option value="<?php echo $default[0].'::'.$el; ?>" selected="selected"><?php echo array_key_exists($k, $enumLabels) ? stripslashes($enumLabels[$k]) : stripslashes($el); ?></option><?php
											} else {
												?><option value="<?php echo $default[0].'::'.$el; ?>"><?php echo array_key_exists($k, $enumLabels) ? stripslashes($enumLabels[$k]) : stripslashes($el); ?></option><?php
											}
										}
										?>
										</select>
										<?php
										break;
									case 'color':
										?>
										<div id="value-<?php echo $arr[$i]['type']; ?>-<?php echo $arr[$i]['key']; ?>" class="colorSelector"><div style="background-color: #<?php echo htmlspecialchars(stripslashes($arr[$i]['value'])); ?>"></div></div>
										<input type="hidden" name="value-<?php echo $arr[$i]['type']; ?>-<?php echo $arr[$i]['key']; ?>" value="<?php echo htmlspecialchars(stripslashes($arr[$i]['value'])); ?>" class="hex" />
										<?php
										break;
								}
								?>
							</td>
						</tr>
						<?php
						$j++;
					}
				}
				?>
					</tbody>
				</table>
				<?php
				if ($j > 0)
				{
					ob_end_flush();
				} else {
					ob_end_clean();
				}
			}
			?>
			<p>&nbsp;</p>
			<p><input type="submit" value="" class="button button_save" /></p>
			<?php
		}
	}
}
?>