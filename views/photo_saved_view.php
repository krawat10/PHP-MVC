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
<table>
    <thead>
    <tr>
        <th>Nazwa</th>
        <th>Autor</th>
        <th>Nazwa Pliku</th>
        <th>Miniatura</th>        
        <th>Operacje</th>
    </tr>
    </thead>    
<!--obrazy-->
    <tbody>    
    <a href="register">Zarejestruj się</a>
    <form method="post" enctype="multipart/form-data">   
       <?php foreach ($_SESSION['select_photos'] as $photo): ?>                
            <tr>
                <td><label><input type="checkbox" name="select_photo[]" value="<?= $photo['_id'] ?>"/> 
                    <a href="view?id=<?= $photo['_id'] ?>"><?= $photo['name'] ?></a>
                </label>
                </td>
                <td><?= $photo['author'] ?> </td>
                <td><?= $photo['filename'] ?> </td>
                <td><a href="images/<?= $photo['filename_mark'] ?>"><img src="images/<?= $photo['filename_thumb'] ?>"></a></td>                
                <td>
                    <a href="edit?id=<?= $photo['_id'] ?>">Edytuj</a> |
                    <a href="delete?id=<?= $photo['_id'] ?>">Usuń</a>
                </td>   
            </tr>                
        <?php endforeach ?>      
    <input type="submit" value="Zapisz"/>
</form>
 <?php foreach (($_SESSION['select_photos']) as $session_photo): ?>     
<tr>
    <?= $session_photo['_id'] ?>
<tr>
            <?php endforeach ?>
    </tbody>    
</table>
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