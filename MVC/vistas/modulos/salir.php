<?php
session_destroy();
echo '<script>
		window.location = "index.php?action=index";
	 </script>';
ob_end_flush();
?>
