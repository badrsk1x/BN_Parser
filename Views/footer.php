<?php
$hash = md5($_SERVER['HTTP_USER_AGENT'] . 'is Javascriptable');

if (!isset($_COOKIE['js']) || $_COOKIE['js'] != $hash):
    ?>
    <script src="../js/main.js"></script>
<?php endif; ?>

</body>
</html>
