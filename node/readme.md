# Projekat1

Ovaj projekat je obuhvatao razvoj web stranice za događaje s naglaskom na DJ izvođače i taj muzički žanr, na projektu nisam radio sam jer je frontend radio moj drugar čija je i ideja za stranicu. Korištenje Node.js imalo je nekoliko prednosti u ovom kontekstu.

Node.js je omogućio brzu izgradnju web stranice koristeći isti jezik za frontend i backend. Ovo je ubrzalo razvoj, olakšavajući timsko saradnju i smanjujući vrijeme prebacivanja između jezika i okruženja.

Node.js omogućio je efikasno upravljanje višestrukim zahtjevima istovremeno, čineći stranicu skalabilnom za potencijalno veliki broj korisnika. To je bilo posebno korisno za praćenje događaja i izvođača u realnom vremenu. Ovo je omogućilo praćenje izvođača i događaja uživo, dodajući interaktivnost na stranicu.

Iako je odabir Node.js bio dobra odluka za ovaj sajt, smatram da smo imali sreće jer nas projekat nije odveo u vode, gdje bi se mogli susresti sa manjkom dokumentacije za određene probleme, kao što mi se desilo u par projekata koji baš zbog toga nisu zaživili, jednostavno bi u tom slučaju bolja opcija bilo koristiti Javu ili Ruby.

Uz sve ove faktore, odabir Node.js za ovaj projekat je bio razuman zbog potreba za brzom izgradnjom, skalabilnošću i realno-vremenskom komunikacijom.

# Projekat2

Ovaj projekat demonstrira osnovnu strukturu za Node.js backend aplikaciju u MERN steku. Projekat se fokusira na implementaciju sistema za autentikaciju korisnika pomoću JWT i bcrypt za hashiranje lozinki. Ovaj projekat sam koristio kao root projekat za započinjanje većih projekata koji koriste slično implementaciju JWT i bcrypt za korisnički panel.

Unutar programa su implementirani ključne komponente kako bi se omogućila uspješna prijava i registracija korisnika. Kontroleri su izdvojeni kao posebna particija koja upravlja ovim funkcionalnostima. Pored toga, postoje i funkcije smještene u direktorijumu "middlewares/". Ove funkcije omogućavaju autentikaciju i autorizaciju prilikom rukovanja zahtjevima koji stižu ka aplikaciji. Autentikacija potvrđuje identitet korisnika, dok autorizacija definiše dozvoljene akcije za svaki korisnički profil. Ova funkcionalnost omogućava zaštitu podataka i osigurava da samo ovlašćeni korisnici mogu pristupiti određenim resursima.

Što se tiče funkcionalnosti, projekat podržava registraciju korisnika preko PUT zahtjeva na /register ruti uz JSON telo { "username": "korisnik", "password": "lozinka" }. Prijavljivanje korisnika ostvaruje se PUT zahtjevom na /login ruti s istoformatnim JSON format. Pristup zaštićenoj ruti uz autentikaciju omogućen je putem GET zahtjeva na /api/protected ruti.

Za zaključak, struktura ovog projekta poboljšava čitljivost, održavanje i skalabilnost, čineći razvoj i upravljanje aplikacijom efikasnim i pouzdanim.
