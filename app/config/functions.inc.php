<?php
/**
 * Util class
 *
 * @package tsbc
 * @subpackage tsbc.app.config
 */
class Util
{
/**
 * Redirect browser
 *
 * @param string $url
 * @param int $http_response_code
 * @param bool $exit
 * @return void
 * @access public
 * @static
 */
	function redirect($url, $http_response_code = null, $exit = true)
	{
		//if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
		if (strstr($_SERVER['SERVER_SOFTWARE'], 'Microsoft-IIS'))
		{
			echo '<html><head><title></title><script type="text/javascript">window.location.href="'.$url.'";</script></head><body></body></html>';
		} else {
			$http_response_code = !is_null($http_response_code) && (int) $http_response_code > 0 ? $http_response_code : 303;
			header("Location: $url", true, $http_response_code);
		}
		if ($exit)
		{
	    	exit();
		}
	}
/**
 * Print notice
 *
 * @param string $value
 * @return string
 * @access public
 * @static
 */
	function printNotice($value, $convert = true)
	{
		?>
		<div class="notice-box">
			<div class="notice-top"></div>
			<div class="notice-middle"><span class="notice-info">&nbsp;</span><?php echo $convert ? htmlspecialchars(stripslashes($value)) : stripslashes($value); ?></div>
			<div class="notice-bottom"></div>
		</div>
		<?php
	}

	function getTimezone($offset)
	{
		$db = array(
			'-14400' => 'America/Porto_Acre',
			'-18000' => 'America/Porto_Acre',
			'-7200' => 'America/Goose_Bay',
			'-10800' => 'America/Halifax',
			'14400' => 'Asia/Baghdad',
			'-32400' => 'America/Anchorage',
			'-36000' => 'America/Anchorage',
			'-28800' => 'America/Anchorage',
			'21600' => 'Asia/Aqtobe',
			'18000' => 'Asia/Aqtobe',
			'25200' => 'Asia/Almaty',
			'10800' => 'Asia/Yerevan',
			'43200' => 'Asia/Anadyr',
			'46800' => 'Asia/Anadyr',
			'39600' => 'Asia/Anadyr',
			'0' => 'Atlantic/Azores',
			'-3600' => 'Atlantic/Azores',
			'7200' => 'Europe/London',
			'28800' => 'Asia/Brunei',
			'3600' => 'Europe/London',
			'-39600' => 'America/Adak',
			'32400' => 'Asia/Shanghai',
			'36000' => 'Asia/Choibalsan',
			'-21600' => 'America/Chicago',
			'-25200' => 'Chile/EasterIsland',
			'-43200' => 'Pacific/Kwajalein'
		);
		if (is_null($offset) && strlen($offset) === 0)
		{
			return $db;
		}
		return array_key_exists($offset, $db) ? $db[$offset] : false;		
	}
	
	function readDir(&$data, $dir)
	{
		$stop = array('.', '..', '.buildpath', '.project', '.svn', 'Thumbs.db');
		if ($handle = opendir($dir))
		{
			$sep = $dir{strlen($dir)-1} != '/' ? '/' : NULL;
			while (false !== ($file = readdir($handle)))
			{
				if (in_array($file, $stop)) continue;
				if (!is_dir($dir . $sep . $file))
				{
					$data[] = $dir . $sep . $file;
				} else {
					Util::readDir($data, $dir . $sep . $file);
				}
			}
			closedir($handle);
		}
	}
	
	function createRandomPassword()
	{ 
		$chars = "abcdefghijkmnopqrstuvwxyz023456789"; 
		srand((double)microtime()*1000000); 
		$i = 0; 
		$pass = ''; 
	
		while ($i <= 7) { 
			$num = rand() % 33; 
			$tmp = substr($chars, $num, 1); 
			$pass = $pass . $tmp; 
			$i++; 
		} 
	
		return $pass; 
	}
}
?>