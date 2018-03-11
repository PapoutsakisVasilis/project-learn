
<?php include "viewsHelper.php"; ?>
<html>
<head>
<?php viewLib("app",'css'); ?>

</head>

<body>
    <div class="container">
        <h1>Main Index Welcome Page.</h1>
        <div class="row">
            <div class="col-lg-4">

                <?php echo "$base".$go;?>
            </div>
            <div class="col-lg-4">

                <?php  if (sessionFlag('status')){echo "$base".$go.session('status',true);}?>
            </div>

            <div class="col-lg-4">
                <?php echo ("$base".$go);?>
                <form action="/project-learn/public/" method="post">
                    <input type="text" value="hello" name="greets">
                    <button type="submit"> go </button>
                </form>
            </div>
        </div>
    </div>




    <?php viewLib("app",'js'); ?>

</body>
</html>

