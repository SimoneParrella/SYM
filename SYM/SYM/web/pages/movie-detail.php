<!DOCTYPE html>
<html>
<head>
    
    <!-- titolo del sito web  -->
    <title>Pagina dei Film</title>
    <!-- link all'icona di fontawesome -->
    <script src="https://kit.fontawesome.com/8f0cceb3c2.js" crossorigin="anonymous"></script>    
    <!-- link al file css di stile -->
    <link rel="stylesheet" href="/styles/moviePage.css">
    <!-- link a JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <?php include "web/fragment/user-data.php"; ?>
</head>
<body>
    <!-- pulsante di ritorno alla pagina principale -->
    <a href="/"> <button id="return-to-home"><i class="fas fa-chevron-left"></i></button></a>
    <!-- div principale -->
    <div id="main">
        <!-- il film viene visualizzato qui -->
        <div id="movie-display">
            <div class="each-movie-page"></div>
        </div>
    </div>
    <!-- il file javascript della pagina dei film è collegato qui -->
    <script type="text/javascript" src="/script/moviePage.js"></script>
</body>
</html>