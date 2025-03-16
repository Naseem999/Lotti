<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include_once 'partial/head.php';
    ?>
    <title>Lotti-Login</title>

</head>

<body>
    <?php
    include_once 'partial/header.php';
    ?>

    <div class="row" style="margin-top: 5em; margin-bottom:5em;">
        <div class="col m4 l4"></div>
        <div class="col s12 m4 l4 z-depth-3 " style=" border: 1px solid #ee6e73; padding: 30px; border-radius: 10px;">
            <a href="#! " id="logo-container" class="brand-logo "> <img class="responsive-image" src="img/logo2.png" style=" width: 100%; margin-bottom: 20px; height:9vh;  object-fit:contain;  ">
            </a>
            <form action="partial/log.php" method="post">

                <div class="input-field col s12">
                    <i class="material-icons prefix " style="color: #ee6e73">phone_iphone</i>
                    <input placeholder="Phone No..." required name="phone" type="text" class="autocomplete validate">
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix" style="color: #ee6e73">lock</i>
                    <input placeholder="Password" required name="pass" type="Password" class="autocomplete validate">
                </div>

                <div class="input-field col s12">
                    <p style="text-align: center;">
                        <button name="login_submit" class="btn waves-effect waves-light " style="background-color: #ee6e73" type="submit" >login
                            <i class="material-icons right">send</i>
                        </button>
                    </p>
                </div>
            </form>

        </div>
        <div class="col m4 l4"></div>
    </div>
    <?php
    include_once 'partial/footer.php';
    include_once 'partial/scripts.php';
    ?>
</body>

</html>
<script>
    $(document).ready(function() {
        $('input.autocomplete').autocomplete({
            data: {
                "Apple": null,
                "Microsoft": null,
                "Google": 'https://placehold.it/250x250'
            },
        });
    });
</script>