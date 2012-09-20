<?php require_once __DIR__ . '/scripts/db.php' ?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <script src="js/vendor/modernizr-2.6.1.min.js"></script>
</head>
<body>
<!--[if lt IE 7]>
<p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
<![endif]-->

<div id="body">
    <header>1234 Reviews online</header>
    <nav id="mainmenu">
        <ul>
            <li>News</li>
            <li>Reviews</li>
            <li>About</li>
        </ul>
        <div id="throbber" style="display:none"></div>
    </nav>
    <div id="main" class="clearfix">
        <div id="container" class="clearfix">
            <div>
                Anzeige:
                <a href="#" id="mode-thumbs">Thumbnails</a>
                <a href="#" id="mode-names">Namen</a>
                <a href="#" id="mode-list">Liste</a>
                <form>
                    Filter:
                    <input type="text" id="filter-name">
                    <select id="filter-genre">
                        <option value="-1">---</option>
                        <?php
                        $genres = get_genres();
                        foreach($genres as $g) {
                            printf('<option value="%d">%s</option>', $g['idGenre'], $g['strGenre']);
                        }
                        ?>

                    </select>
                    <select id="filter-country">
                        <option value="-1">---</option>
                        <?php
                        $countries = get_countries();
                        foreach($countries as $c) {
                            printf('<option value="%d">%s</option>', $c['name'], $c['name']);
                        }
                        ?>

                    </select>
                </form>
            </div>
            <div id="content">Hallo Welt</div>
        </div>
        <!--<nav id="sidebar">
            <ul>
                <li><a href="#" id="all">all</a></li>
                <li>Category 1</li>
                <li>Category 2</li>
                <li>Category 3</li>
                <li>Category 4</li>
                <li>Category 5</li>
            </ul>
        </nav>-->
    </div>
    <footer class="clearfix"></footer>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.8.1.min.js"><\/script>')</script>
<script src="js/plugins.js"></script>
<script src="js/main.js"></script>

<script>
    m = new mof.Movies();
    lastval = '';
    function onModeClick(ev) {
        m.setRenderMode(ev.data.mode);
    }
    function onNameFilter(ev) {
        var val = $('#filter-name').val();
        if(val.length>2 && val!=lastval) {
            lastval = val;
            m.setNameFilter(val);
        }
    }

    function onGenreFilter(ev) {
        var val = $('#filter-genre').val();
        m.setFilter('genre', val);
    }
    $('a#mode-thumbs').on('click', {mode:'thumbs'}, onModeClick);
    $('a#mode-names').on('click', {mode:'names'}, onModeClick);
    $('a#mode-list').on('click', {mode:'list'}, onModeClick);

    $('#filter-name').on('keyup', onNameFilter);
    $('#filter-genre').on('change', onGenreFilter);

    m.queryMovies();
</script>

<!-- Google Analytics: change UA-XXXXX-X to be your site's ID.
<script>
    var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
        g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
        s.parentNode.insertBefore(g,s)}(document,'script'));
</script>-->
</body>
</html>
