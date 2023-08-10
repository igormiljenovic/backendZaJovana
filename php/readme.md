# Uvod

U svom putu programiranja, prvi ozbiljniji koraci su me odveli u svijet PHP-a. Iako sam tada programirao na način koji bi se možda mogao opisati kao "laički", ova iskustva su predstavljala temelj za moje daljnje napredovanje. Rad na projektima unutar Aure Osiguranja bio je ključan. Sigurnosni razlozi su me natjerali da veći dio koda izbrišem, budući da su isti koncepti mogli biti primjenjeni i kod drugih osiguravajućih društava. Ovdje ću se usredotočiti na backend razvoj uz upotrebu MySQL baze podataka. Oba projekta su bila bazinarana na internim sistemima za osiguravajuće kuću.

# Projekat 1

Projekat 1 je bio usmjeren prema stvaranju male aplikacije koja omogućava zastupnicima, spoljnim saradnicima, da unose provizije na svoje polise. Nakon unosa, finansijski tim je donosio odluke o odobravanju ili odbijanju tih provizija. Iako detalji ovog dijela koda nisu dostupni zbog osjetljivih informacija, ostavljeno je zadržano implementiranje dodavanja i brisanja zastupnika, kao i upravljanje ulogama. Kroz ovaj projekat, koristio sam PDO za interakciju s bazom podataka.

# Projekat 2

Drugi projekat je bio usmjeren na finansijski tim i njihovu potpunu kontrolu nad sistemom polisa. Ovaj sustav je omogućavao pregled polisa, unos stanja i avansa, upravljanje troškovima, te uvoz polisa iz drugih programa putem CSV datoteka, prebacivanje podataka između zastupnika, implementacije sistema popusta, kontrola plana premije. Iako je veći dio koda iz sigurnosnih razloga uklonjen, ovaj projekat je predstavljao izazov u organizaciji složenih skupova podataka i navigaciji kroz specifičnosti branše osiguravajućih kuća.

# Zaključak

Rad na ovim projektima mi je omugućio da naučim važne stvari pri izradi web aplikacija. Generalno kod kao kod nije pretjerano zahtjevan za pisanje, veći problem je bio organizacija čitavih setova podataka i snalaženje u nepoznatom terenu osiguravajućih kuća, takođe ogroman izazov je bio brzina obrade podatak zbog ogromnih querija i podataka koji idu sa 10-20 kolona i milionskim brojem redova. Program je u osnovi analitički, ali ima krucijalnu važnost u radu njihove firme, ukoliko budeš želio mogu preko share-a ekrana ili bilo kojim drugim putem pokazati čitav program i dodatno objasniti kompleksnost samog programa.
