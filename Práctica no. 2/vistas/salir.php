
<?php
session_destroy();

echo '<script>
                            
                                 window.location = "index.php";

                              </script>';
ob_end_flush();
?>
