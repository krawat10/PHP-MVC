<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8" />
    <title>Simson Informacje</title>
    <script src="static/js/jquery-1.11.3.js"></script>
    <script src="static/js/main.js"></script>
    <script src="static/js/jquery-ui.min.js"></script>
    <link href="static/css/jquery-ui.min.css" rel="stylesheet" />
    <link href="static/css/style.css" type="text/css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div id="page">
        <div id="header">
            <svg id="SVG" width="100" height="100">
                <circle cx="50" cy="50" r="40" stroke="black" stroke-width="4" fill="gray" />
                <text fill="black" font-size="30" font-family="Verdana" x="25" y="60">IFA</text>
            </svg>
            <h2>Simson S51, S53, SR, Schwalbe</h2>
        </div>
        <div id="nav">
            <ul id="menu">
                <li><a href="/">Strona główna</a></li>
                <li>                    
                    <a href="history">Historia simsonów</a>                        
                </li>
                <li>
                    <a href="contact">Kontakt</a>
                </li>
                <li>
                    <a href="quiz">Quiz</a>
                </li>
                <li>
                    <a href="photos">Galeria zdjęć</a>
                </li>
            </ul>

        </div>

        <div id="content">
            <h1>Witaj na stronie o simsonach</h1>
            <p>

                Simson – były niemiecki producent motocykli i motorowerów.
                Działalność firmy rozpoczęli bracia Simson w roku 1856 od produkcji broni. Dziś z ich nazwiskiem głównie są kojarzone motorowery, które zyskały dużą popularność w Niemczech wschodnich (DDR), Polsce oraz innych krajach sąsiednich, zwłaszcza w krajach bloku wschodniego. Najbardziej popularnymi w Polsce są modele Simson S51 oraz skuter Simson SR50.
            </p>
            <img src="Simson-S51-green.jpg" alt="Zdjćcie simsona" class="picture" />
        </div>
        <div id="footer">
            <p>Strona stworzona na potrzeby przedmiotu "Wytwarzanie aplikacji internetowych" oraz "Hiperteks i hipermedia". Mateusz Krawczyk</p>
            <p>Wybierz kolor tła:</p>
            <button onclick="setBackground('white')">Biały</button>
            <button onclick="setBackground('gray')">Szary</button>
        </div>

    </div>
</body>
</html>