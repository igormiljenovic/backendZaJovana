Dokumentacija za MERN Projekat - Backend

Ovaj projekat demonstrira osnovnu strukturu za Node.js backend aplikaciju u MERN (MongoDB, Express.js, React, Node.js) steku. Projekat se fokusira na implementaciju sistema za autentikaciju korisnika pomoću JSON Web Tokens (JWT) i bcrypt za hashiranje lozinki.

Folder Struktura:
- controllers/: Kontroleri za upravljanje funkcionalnostima kao što su registracija i prijava korisnika.
- middlewares/: Middleware funkcije za autentikaciju i autorizaciju ruta.
- models/: Mongoose modeli za definisanje šema baze podataka.
- routes/: Definicije ruta i zaštićenih ruta.
- config/: Konfiguracione opcije, kao što je konekcija ka bazi podataka.
- services/: Poslovna logika koja je odvojena od kontrolera.
- utils/: Korisne funkcije i moduli kao što su obrada grešaka.
- server.js: Glavni ulazni fajl za pokretanje servera.
- .env: Fajl za čuvanje osetljivih podataka kao što su ključevi i konfiguracije.

Instalacija:
1. Instalirati Node.js i npm.
2. Klonirati projekat sa GitHub-a.
3. U terminalu, navigirati do foldera projekta i izvršiti "npm install".
4. Kreirati MongoDB bazu i ažurirati MONGODB_URI u .env fajlu.
5. Pokrenuti server komandom "node server.js".

Funkcionalnosti:
- Registracija korisnika: PUT zahtev na /register ruta sa telom u JSON formatu { "username": "korisnik", "password": "lozinka" }.
- Prijavljivanje korisnika: PUT zahtev na /login ruta sa telom u JSON formatu { "username": "korisnik", "password": "lozinka" }.
- Zaštićena ruta: GET zahtev na /api/protected ruta za pristup zaštićenoj ruti uz autentikaciju.

Za dodatne funkcionalnosti, prilagodite projektu prema vašim zahtevima. Srećno kodiranje!
