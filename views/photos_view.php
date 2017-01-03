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
    
    <form method="post" enctype="multipart/form-data">
    <?php if ($photos->count()): ?>
        <?php foreach ($photos as $photo): ?>      
        <?php if(!isset($_SESSION['select_photos']) || !in_array($photo, $_SESSION['select_photos'])) { ?>       
            <tr>
                <td><input type="checkbox" name="select_photo[]" value="<?= $photo['_id'] ?>"/> 
                    <?= $photo['name'] ?>
                </td>
                <td><?= $photo['author'] ?> </td>
                <td><?= $photo['filename'] ?> </td>
                <td><a href="images/<?= $photo['filename_mark'] ?>"><img src="images/<?= $photo['filename_thumb'] ?>"></a></td>                
                <td>
                    <a href="edit?id=<?= $photo['_id'] ?>">Edytuj</a> |
                    <a href="delete?id=<?= $photo['_id'] ?>">Usuń</a>
                </td>
            </tr>   
        <?php } ?>     
        <?php endforeach ?>
    <?php else: ?>
        <tr>
            <td colspan="3">Brak produktów</td>
        </tr>
    <?php endif ?>    
    <?php if (isset($_SESSION['select_photos'])): ?>
        <?php foreach ($_SESSION['select_photos'] as $photo): ?>                
            <tr>
                <td><label><input type="checkbox" name="select_photo[]" value="<?= $photo['_id'] ?>" checked="checked"/> 
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
        <?php endif ?>
    <input type="submit" value="Zapisz"/>
</form>
    </tbody>    
    <tfoot>
    <tr>
        <td colspan="3">Łącznie: <?= $photos->count() ?></td>
        <td>
            <a href="edit">nowy produkt</a>
        </td>
        <td>
            <a href="photo_saved">Zapamiętane zdjęcia</a>
        </td>
    </tr>
    </tfoot>
</table>

<table>
<!--sessja-->
<?php if(!isset($_SESSION['user_id'])):?>
<a href="login">Zaloguj się</a> <br/    >
<a href="register">Zarejestruj się</a>
<?php else: ?>
<a>Zalogowany</a><br/    >
<a href="logout">Wyloguj się</a>
<?php endif ?>
<!--użytkownicy-->
    <tbody>
    
    <?php if (isset($_SESSION['select_photos'])): ?>
       
            <td colspan="3"><?= $_SESSION['user_id'] ?></td>
            <?php foreach (($_SESSION['select_photos']) as $session_photo): ?>     
<tr>
    <?= $session_photo['_id'] ?>
<tr>
            <?php endforeach ?>
        
        
    <?php else: ?>
        <tr>
            <td colspan="3">Brak SESJA</td>
        </tr>
    <?php endif ?>
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