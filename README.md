


					# Projekt z Baz Danych
					Temat Projektu: Klub Piłkarski
Grupa: 14B
Wykonali:
Michał Młodawski
Piotr Piasecki
Emil Nowak
Konrad Nowakowski

Opis Projektu:
Projekt zbudowany dla tematu Klub Piłkarski. W projekcie jest 10 tabel, 6 widoków, 3 wyzwalacze, 3 kursory.
1. Widok to tabela utworzona za pośrednictwem normalnego zapytania.Z widoku korzystamy jak ze zwykłej tabeli,
więc można wykonywać dowolne kwerendy.Widoki nie mają fizycznej reprezentacji do czasu aż nie zostanie utworzony
ich indeks.

Widoki w projekcie:
-DlugoscUmowyPilkarza - wyświetla długość umowy piłkarzy
-HarmonogramPilkarzy - wyświetla plan zajęć dla piłkarzy
-UbezpieczeniePilkarzy - wyświetla informacje na temat ubezpieczenia piłkarzy
-SedziowieMecze - wyswietla informacje na temat sędziów oraz informacje na temat meczu w kórym sędziowali
-SponsorKontrakrtyPilkarzy - wyświetla informacje na temat kontraktów piłkarskich
-DlugoscUmowyPracownika - wyśweitla długość umowy pracowników

2. Kursory to bufor do którego zapisywane są wiersze z wynikami pozyskane z tabel dla stworzonych zapytań.Umożliwa 
przejrzenie wiersz po wierszu działania instrukcji SELECT i wykonanie operacji.

Kursory w projekcie:
-k_sedzia2-kursor oparty na procedurze ktora służy do dodawania piłkarzy
-k_sedzia- kursor opart na funkcji wyswietlajacy sedziego
-kursor_1 -kursor oparty na procedurze która sumuje ubezpieczenia

3. Wyzwalacze są procedurami uruchamiane gdy zaistnieje jakieś zdarzenie. Zdarzenia mogą modyfikować tabele w bazie dancyh.
Zazwyczaj wyzwalacze są stosowane aby sprawdzać poprawność wprowadzonych danych.

Wyzwalacze w projekcie:
-opieka_pilkarz - wyzwalacz dodający dla każdego piłkarza podstawowe ubezpieczenie zdrowotne od klubu
-umowa_pilkarz - wyzwalacz dodający umowę dla nowo dodanych piłkarzy
-umowa_pracownik - wyzwalacz dodający umowę dla nowo dodanych pracowników

4. Klient posiada podstawowe możliwości takie jak tworzenie table, wyświetlanie tabel, tworzenie sekwencji, funckji, procedur,
wykonywanie dowolnego kodu sql i wyświetlanie widoków. Został napisany w PHP z dodatkiem OCI, AngularJS, JQuery oraz w HTML
