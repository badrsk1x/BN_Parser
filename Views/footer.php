<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="../js/check_js.js"></script>
<?php
$hash = md5($_SERVER['HTTP_USER_AGENT'] . 'is Javascriptable');
if (isset($_COOKIE['js']) || $_COOKIE['js'] != $hash):?>
    <script src="../js/main.js"></script>
<?php endif; ?>

</body>
</html>
