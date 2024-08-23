<?php
require 'config.php';
$_SESSION = [];
session_unset();
session_destroy();
echo 
"
<script>
    alert('Successfully Signed Out');
    window.location.href = 'index.php';
</script>
";