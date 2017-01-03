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
            <h1>Kontakt</h1>
            <h2>Masz pytanie?</h2>
            <button onclick="temp()">Do schowka</button> 
            <form method="post" action="mailto:krawat10@gmail.com">
                <fieldset id="formula">
                    <legend>Formularz kontaktowy</legend>
                     
                    <label class="block">Imie: <input type="text" name="name" id="name" size="30" maxlength="100" title="Twoje imie" /></label><br />  <br />
                    <label class="block">Nazwisko: <input type="text" name="surname" id="surname" size="30" maxlength="100" title="Twoje nazwisko"/></label><br /><br />
                    <label class="block" >Twój email: <input type="email" name="email" id="email" size="30" maxlength="100" title="Pamiętaj aby dobrze wprowadzić email"/></label><br /><br />
                    
                        <p>Jak ci się podoba strona?</p> <br />
                        <label><input type="radio" name="points" value="4"/>Bardzo dobrze</label><br />
                        <label><input type="radio" name="points" value="3"/>Dobrze</label><br />
                        <label><input type="radio" name="points" value="2"/>Średnio</label><br />
                        <label><input type="radio" name="points" value="1"/>Słabo</label><br />
                    <br /><br />
                    
                        <p>Jakiego masz simsona?</p> <br />
                        <label><input type="checkbox" name="simson" value="S50"/>S50</label><br />
                        <label><input type="checkbox" name="simson" value="S51"/>S51</label><br />
                        <label><input type="checkbox" name="simson" value="S53"/>S53</label><br />
                        <label><input type="checkbox" name="simson" value="SR"/>SR</label><br />
                        <label><input type="checkbox" name="simson" value="Other"/>Inny</label><br />
                        <label><input type="checkbox" name="simson" value="None"/>Nie mam</label><br />
                    <br /><br />
                    <label class="block">Twoje pytanie: <br /><textarea rows="4" cols="40" id="question" title="Pytaj o wszystko :)"></textarea></label><br />
                    <input type="submit" value="Wyślij" />
                    <input type="reset" value="Wyczyść">
                     
                </fieldset>
            </form>
            <h2>Dane Kontaktowe</h2>
            <p><a href="mailto:krawat10@gmail.com">krawat10@gmail.com</a></p>
            <a>Mateusz Krawczyk</a>
        </div>
        <div id="footer"><p>Strona stworzona na potrzeby przedmiotu "Wytwarzanie aplikacji internetowych" oraz "Hiperteks i hipermedia". Mateusz Krawczyk</p><p>Wybierz kolor tła:</p>
<button onclick="setBackground('white')">Biały</button>
<button onclick="setBackground('gray')">Szary</button></div>
    </div>
</body>
</html>
