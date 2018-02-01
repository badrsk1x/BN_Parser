<?php

require_once 'config.php';

include 'Views/header.php';

if(isset($_POST['submit'])):
    include 'form_search.php';
    include 'result.php';
else:
    include 'form_search.php';
endif;

include 'Views/footer.php';





