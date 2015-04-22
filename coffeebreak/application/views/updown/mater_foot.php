<script src="/static/dist/js/vendor/jquery.min.js"></script>
<script src="/static/dist/js/materialize.min.js"></script>
<script src="/static/dist/js/sweet-alert.min.js"></script>
<?php 
if (isset($jsArray)) {
    foreach ($jsArray as $key => $value) {
        echo '<script src="'.$value.'"></script>'; 
    }
}
 ?>
</body>
</html>