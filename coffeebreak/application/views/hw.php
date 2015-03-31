<html>
    <body>
        <h1>hello</h1>
        <?php 
        if (isset($title)) {
            echo $title;
        } else{
            echo "default";
        }
        ?>
    </body>
</html>