<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Forum o psach</title>
	<link rel="stylesheet" href="styl4.css" />
</head>
<body>
	<div id="baner">
		<h1>Forum wielbicieli psów</h1>
	</div>
	<div id="lewy">
		<img src="obraz.jpg" alt="foksterier" />
	</div>
	<div id="prawy1">
		<h2>Zapisz się</h2>
		<form action="logowanie.php" method="post">
			<label>
				login:
				<input type="text" name="login" /><br/>
			</label>
			<label>
				hasło:
				<input type="password" name="haslo" /><br/>
			</label>
			<label>
				powtórz hasło:
				<input type="password" name="powhaslo" /><br/>
			</label>
			<button>Zapisz</button>
		</form>
        <?php
        // polaczenie z baza danych
        $con = mysqli_connect('localhost', 'root', '', 'psy');

        // instrukcja warunkowa sprawdzajaca czy metoda wywolania to POST
        // isset sprawdzajacy czy klucze odpowiadajace polom z formularza znajdują sie w tablicy
        // && and, || or, == sprawdza równość co do wartości, != sprawdza czy zmienne są różne, === sprawdza czy sa identyczne

        if(isset($_POST['login']) && isset($_POST['haslo']) && isset($_POST['powhaslo'])){

            // mysqli_real_escape_string dodane w celu zabezpieczenia przed atakim na strone

            // przypisanie do odpowiednich zmiennych wczesniej sprawdzanych przez wysylke formularza do zmiennej post
            // wartosci trafiaja do zmiennej post, wykorzysujac nazwe przypisana w formularzu name
            $login = mysqli_real_escape_string($con, $_POST['login']);
			$haslo = mysqli_real_escape_string($con, $_POST['haslo']);
			$powhaslo = mysqli_real_escape_string($con, $_POST['powhaslo']);

			$blad = FALSE;

			// powyzej zostaje zdefiniowana zmienna $blad
			// Zrobione jest to w celu późniejszego podjęcia decyzji czy skrypt może iść dalej, czy ma wyświetlić błąd. 
			// W chwili obecnej mówi ona nam tylko tyle, że ma wartość fałsz, w kontekście możemy się jednak domyślić że znaczy to tyle, co przyjęcie założenia
			// o nie istnieniu loginu w bazie w tym momencie

            // warunkiem sprawdzamy czy pola nie sa puste 

            if($login == '' || $haslo = '' || $powhaslo == '') {
                // jezeli pole jest puste wypisuje komunikat:
                echo "<p> wypełnij wszystkie pola!</p> ";
				$blad = TRUE;

            }

            $sql = "SELECT login  FROM uzytkownicy;"; //polecenie wybierajace wszystkich uzytkownikow
            $res = mysqli_query($con, $sql); //wykonuje zapytyanie sql i zwraca jego wynik korzystajac z polaczenia z baza
            
            // za pomoca petli while i mysqli_fetch_row, pobieramy do zmiennej tab kolejne wiersze z wynikami dopoki nie dostaniemyw wartosci false

            while($tab = mysqli_fetch_row($res)){

				// sprawdza czy tab jest rowny wartosci z formularza
				if ($login === $tab[0]) {
					echo "<p>login wystepuje w bazie danych, kontor nie zostalo dodane</p>"
					$blad = TRUE;
					break; //przerywamy działanie pobieranie kolejnych wierszy ponieważ nie potrzeba dalej


				}
            }
			if($blad == FALSE) {
				$sha = sha1($haslo) //haszujemy haslo
				$sql - "INSERT INTO uzytkownicy VALUES (null, '$login', '$sha');"; //kwerenda dodajaca
				mysqli_query($con, $sql); //wykonujemy powyzsza kwerende korzystajac z polaczenia z baza

				echo "<p> Konto zostało dodane </p>";
        }
        ?>
	</div>
	<div id="prawy2">
		<h2>Zapraszamy wszystkich</h2>
		<ol>
			<li>właścicieli psów</li>
			<li>weterynarzy</li>
			<li>tych, co chcą kupić psa</li>
			<li>tych, co lubią psy</li>
		</ol>
		<a href="regulamin.html">Przeczytaj regulamin forum</a>
	</div>
	<div id="stopka">
		Stronę wykonała: Ala Kokoszka
	</div>
</body>
</html>