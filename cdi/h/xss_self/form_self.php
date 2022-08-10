<html>
    <meta charset='utf-8' />
    <head></head>
    <body>
        <form name="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>" method=post>
            <input type="text" name="name" size=50><br>
            <input name="submit1" type="submit" value="Prueba">
        </form>

        <?php
        //Para ilustrar un ataque XSS, invocar así:
        //http://localhost/form_self.php/%22%3E%3Cscript%3Ealert('xss')%3C/script%3E%3Cfoo%22
        //Explicación muy buena: http://form.guide/php-form/php-form-action-self.html        
        if (isset($_POST['submit1'])) {
            $name = $_POST['name'];
            echo "User Has submitted the form and entered this name : <b> $name </b>";
            echo "<br>You can use the following form again to enter a new name.";
        }
        exit;
        ?>
    </body>
</html>