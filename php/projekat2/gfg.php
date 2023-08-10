<?php

// Get the user id
$Polisa = $_REQUEST['Polisa'];

// Database connection
$con = mysqli_connect("localhost", "root", "", "auris");
if (($Polisa > 100000 && $Polisa < 1000000) || ($Polisa > 10000000 && $Polisa < 1000000000000)) {
if ($Polisa !== "") {

	// Get corresponding first name and
	// last name for that user id
	$query = mysqli_query($con, "SELECT Klijent, JMBG, Izdavanje, Dnevnik, Opstina, VrstaMV, ZamjenskaPolisa, ZastupnikSifra, Auris, Alfa
		, GratisRegistracija, GratisPopust, PonistenaPolisa, FakturisanaPremija, PremijaAO, ProvizijaAO, Komentar, PovratPoPremiji, PovratDatum FROM aobaza WHERE Polisa='$Polisa'");

	$row = mysqli_fetch_array($query);

	// Get the first name
	$Klijent = $row["Klijent"];
	$JMBG = $row["JMBG"];
	$Izdavanje = $row["Izdavanje"];
	$Dnevnik = $row["Dnevnik"];
	$Opstina = $row["Opstina"];
	$VrstaMV = $row["VrstaMV"];
	$ZamjenskaPolisa = $row["ZamjenskaPolisa"];
	$ZastupnikSifra = $row["ZastupnikSifra"];
	$FakturisanaPremija = $row["FakturisanaPremija"];
	$PovratAO = $row["PovratPoPremiji"];
	$PovratDatum = $row["PovratDatum"];

	$query1 = mysqli_query($con, "SELECT ZastupnikNaziv FROM tblzastupnici WHERE ZastupnikSifra='$ZastupnikSifra' AND Aktivan='Aktivan'");

	$row1 = mysqli_fetch_array($query1);

	$ZastupnikNaziv = $row1["ZastupnikNaziv"];

	if ($row["Auris"] !== "1"){$Auris = false;} elseif ($row["Auris"] == "1"){$Auris = true;}
	if ($row["Alfa"] !== "1"){$Alfa = false;} elseif ($row["Alfa"] == "1"){$Alfa = true;}
	if ($row["GratisRegistracija"] !== "1"){$GratisRegistracija = false;} elseif ($row["GratisRegistracija"] == "1"){$GratisRegistracija = true;}
	if ($row["GratisPopust"] !== "1"){$GratisPopust = false;} elseif ($row["GratisPopust"] == "1"){$GratisPopust = true;}
	if ($row["PonistenaPolisa"] !== "1"){$PonistenaPolisa = false;} elseif ($row["PonistenaPolisa"] == "1"){$PonistenaPolisa = true;}
	$Komentar = $row["Komentar"];
	$PremijaAO = $row["PremijaAO"];
	if (empty($PremijaAO)  || $PremijaAO == 0) {
	$ProvizijaAO = 0;
	$ProvizijaAOPr = 0;
	}else {
	$ProvizijaAO = $row["ProvizijaAO"];
	$ProvizijaAOPr1 = $ProvizijaAO / $PremijaAO * 100;
    $ProvizijaAOPr = round($ProvizijaAOPr1, 2);
	}

$checkAN = mysqli_query($con, "SELECT id FROM dopunskaan WHERE Polisa = '$Polisa'");
$num_resultsAN = $checkAN->num_rows;
if($num_resultsAN == 0) {
	$PremijaAN = NULL;
	$ProvizijaAN = NULL;
	$ProvizijaANPr = NULL;
	$PovratAN = NULL;
} else {
	$query = mysqli_query($con, "SELECT PremijaAN, ProvizijaAN, PovratAN FROM dopunskaan WHERE Polisa='$Polisa'");

	$row = mysqli_fetch_array($query);
	$PovratAN = $row["PovratAN"];
	$PremijaAN = $row["PremijaAN"];
	if (empty($PremijaAN) || $PremijaAN == 0) {
		$ProvizijaAN = 0;
		$ProvizijaANPr = 0;
	}else {
		$ProvizijaAN = $row["ProvizijaAN"];
		$ProvizijaANPr1 = $ProvizijaAN / $PremijaAN * 100;
        $ProvizijaANPr = round($ProvizijaANPr1, 2);
	}
}
$checkAK = mysqli_query($con, "SELECT id FROM dopunskaak WHERE Polisa = '$Polisa'");
$num_resultsAK = $checkAK->num_rows;
if($num_resultsAK == 0) {
	$PremijaAK = NULL;
	$ProvizijaAK = NULL;
	$ProvizijaAKPr = NULL;
	$PovratAK = NULL;
} else {
	$query = mysqli_query($con, "SELECT PremijaAK, ProvizijaAK, PovratAK FROM dopunskaak WHERE Polisa='$Polisa'");

	$row = mysqli_fetch_array($query);
	$PovratAK = $row["PovratAK"];
	$PremijaAK = $row["PremijaAK"];
	if (empty($PremijaAK) || $PremijaAK == 0) {
		$ProvizijaAK = 0;
		$ProvizijaAKPr = 0;
	}else {
		$ProvizijaAK = $row["ProvizijaAK"];
		$ProvizijaAKPr1 = $ProvizijaAK / $PremijaAK * 100;
        $ProvizijaAKPr = round($ProvizijaAKPr1, 2);
	}
}
$checkLS = mysqli_query($con, "SELECT id FROM dopunskals WHERE Polisa = '$Polisa'");
$num_resultsLS = $checkLS->num_rows;
if($num_resultsLS == 0) {
	$PremijaLS = NULL;
	$ProvizijaLS = NULL;
	$ProvizijaLSPr = NULL;
	$PovratLS = NULL;
} else {
	$query = mysqli_query($con, "SELECT PremijaLS, ProvizijaLS, PovratLS FROM dopunskals WHERE Polisa='$Polisa'");

	$row = mysqli_fetch_array($query);
	$PremijaLS = $row["PremijaLS"];
	$PovratLS = $row["PovratLS"];
	if (empty($PremijaLS) || $PremijaLS == 0) {
		$ProvizijaLS = 0;
		$ProvizijaLSPr = 0;
	}else {
		$ProvizijaLS = $row["ProvizijaLS"];
		$ProvizijaLSPr1 = $ProvizijaLS / $PremijaLS * 100;
        $ProvizijaLSPr = round($ProvizijaLSPr1, 2);
	}
}
$checkZB2 = mysqli_query($con, "SELECT id FROM dopunskazb WHERE Polisa = '$Polisa'");
$num_resultsZB2 = $checkZB2->num_rows;
if($num_resultsZB2 == 0) {
	$PremijaZB2 = NULL;
	$ProvizijaZB2 = NULL;
	$ProvizijaZB2Pr = NULL;
	$PovratZB2 = NULL;
} else {
	$query = mysqli_query($con, "SELECT PremijaZB2, ProvizijaZB2, PovratZB2 FROM dopunskazb WHERE Polisa='$Polisa'");

	$row = mysqli_fetch_array($query);
	$PremijaZB2 = $row["PremijaZB2"];
	$PovratZB2 = $row["PovratZB2"];
	if (empty($PremijaZB2) || $PremijaZB2 == 0) {
		$ProvizijaZB2 = 0;
		$ProvizijaZB2Pr = 0;
	}else {
		$ProvizijaZB2 = $row["ProvizijaZB2"];
		$ProvizijaZB2Pr1 = $ProvizijaZB2 / $PremijaZB2 * 100;
        $ProvizijaZB2Pr = round($ProvizijaZB2Pr1, 2);
	}
}

$checkPJUP = mysqli_query($con, "SELECT id FROM dopunskapjup WHERE Polisa = '$Polisa'");
$num_resultsPJUP = $checkPJUP->num_rows;
if($num_resultsPJUP == 0) {
	$PremijaPJUP = NULL;
	$ProvizijaPJUP = NULL;
	$ProvizijaPJUPPr = NULL;
	$PovratPJUP = NULL;
} else {
	$query = mysqli_query($con, "SELECT PremijaPJUP, ProvizijaPJUP, PovratPJUP FROM dopunskapjup WHERE Polisa='$Polisa'");

	$row = mysqli_fetch_array($query);
	$PremijaPJUP = $row["PremijaPJUP"];
	$PovratPJUP = $row["PovratPJUP"];
	if (empty($PremijaPJUP) || $PremijaPJUP == 0) {
		$ProvizijaPJUP = 0;
		$ProvizijaPJUPPr = 0;
	}else {
		$ProvizijaPJUP = $row["ProvizijaPJUP"];
		$ProvizijaPJUPPr1 = $ProvizijaPJUP / $PremijaPJUP * 100;
        $ProvizijaPJUPPr = round($ProvizijaPJUPPr1, 2);
	}
}

	$PovratPoPremijiAO = (float)$PovratAO + (float)$PovratAK + (float)$PovratAN + (float)$PovratLS + (float)$PovratZB2;
	$UkPremija = ($PremijaAO + $PremijaAK + $PremijaAN + $PremijaLS + $PremijaZB2 + $PremijaPJUP + $PovratPoPremijiAO);
	$UkProvizija = ($ProvizijaAO + $ProvizijaAK + $ProvizijaAN + $ProvizijaLS + $ProvizijaZB2 + $ProvizijaPJUP);
	$UkProvizijaPr1 = $UkProvizija / $UkPremija * 100;
    $UkProvizijaPr = round($UkProvizijaPr1, 2);

	$result = array("$Klijent","$JMBG","$Izdavanje","$Dnevnik","$Opstina","$VrstaMV","$ZamjenskaPolisa","$ZastupnikSifra","$Auris","$Alfa","$GratisRegistracija","$GratisPopust","$PonistenaPolisa",
	"$PremijaAO","$ProvizijaAO","","$ProvizijaAOPr","$PremijaAK","$ProvizijaAK","$ProvizijaAKPr","$PremijaAN","$ProvizijaAN","$ProvizijaANPr","$PremijaLS","$ProvizijaLS","$ProvizijaLSPr",
	"$PremijaZB2","$ProvizijaZB2","$ProvizijaZB2Pr","$UkPremija","$UkProvizija","$UkProvizijaPr", "$ZastupnikNaziv", "", "", "", "$Komentar", "", "", "$FakturisanaPremija", "$PovratAO", "$PovratAK", "$PovratAN", "$PovratLS", "$PovratZB2", "$PovratPJUP", "$PremijaPJUP", "$ProvizijaPJUP", "$ProvizijaPJUPPr", "$PovratPoPremijiAO", "$PovratDatum");
}
}
if ($Polisa < 10000000 && $Polisa > 8500000) {
if ($Polisa !== "") {

	// Get corresponding first name and
	// last name for that user id
	$query = mysqli_query($con, "SELECT Klijent, JMBG, Izdavanje, Dnevnik, Opstina, VrstaMV, ZamjenskaPolisa, ZastupnikSifra, Auris, Alfa
		, GratisRegistracija, GratisPopust, PonistenaPolisa, FakturisanaPremija, PremijaZB, ProvizijaZB, Komentar, PovratDatum, PovratPoPremiji FROM zbbaza WHERE Polisa='$Polisa'");

	$row = mysqli_fetch_array($query);

	// Get the first name
	$Klijent = $row["Klijent"];
	$JMBG = $row["JMBG"];
	$Izdavanje = $row["Izdavanje"];
	$Dnevnik = $row["Dnevnik"];
	$Opstina = $row["Opstina"];
	$VrstaMV = $row["VrstaMV"];
	$ZamjenskaPolisa = $row["ZamjenskaPolisa"];
	$ZastupnikSifra = $row["ZastupnikSifra"];
	$FakturisanaPremija = $row["FakturisanaPremija"];
	$PovratPoPremiji = $row["PovratPoPremiji"];
	$PovratDatum = $row["PovratDatum"];

	$query1 = mysqli_query($con, "SELECT ZastupnikNaziv FROM tblzastupnici WHERE ZastupnikSifra='$ZastupnikSifra' AND Aktivan='Aktivan'");

	$row1 = mysqli_fetch_array($query1);

	$ZastupnikNaziv = $row1["ZastupnikNaziv"];

	if ($row["Auris"] !== "1"){$Auris = false;} elseif ($row["Auris"] == "1"){$Auris = true;}
	if ($row["Alfa"] !== "1"){$Alfa = false;} elseif ($row["Alfa"] == "1"){$Alfa = true;}
	if ($row["GratisRegistracija"] !== "1"){$GratisRegistracija = false;} elseif ($row["GratisRegistracija"] == "1"){$GratisRegistracija = true;}
	if ($row["GratisPopust"] !== "1"){$GratisPopust = false;} elseif ($row["GratisPopust"] == "1"){$GratisPopust = true;}
	if ($row["PonistenaPolisa"] !== "1"){$PonistenaPolisa = false;} elseif ($row["PonistenaPolisa"] == "1"){$PonistenaPolisa = true;}
	$Komentar = $row["Komentar"];
	$PremijaZB = $row["PremijaZB"];
	if (empty($PremijaZB) || $PremijaZB == 0) {
		$ProvizijaZB = 0;
		$ProvizijaZBPr = 0;
	}else {
		$ProvizijaZB = $row["ProvizijaZB"];
		$ProvizijaZBPr1 = $ProvizijaZB / $PremijaZB * 100;
        $ProvizijaZBPr = round($ProvizijaZBPr1, 2);
	}

	$result = array("$Klijent","$JMBG","$Izdavanje","$Dnevnik","$Opstina","$VrstaMV","$ZamjenskaPolisa","$ZastupnikSifra","$Auris","$Alfa","$GratisRegistracija","$GratisPopust","$PonistenaPolisa"
	,"","","","","","","","","","","","","","","","","","","", "$ZastupnikNaziv","$PremijaZB","$ProvizijaZB","$ProvizijaZBPr","$Komentar", "$PovratPoPremiji", "$PovratDatum","$FakturisanaPremija", "", "", "");
}
}
if ($Polisa < 100000) {
if ($Polisa !== "") {

	// Get corresponding first name and
	// last name for that user id
	$query = mysqli_query($con, "SELECT Klijent, JMBG, Izdavanje, Dnevnik, Opstina, VrstaMV, ZamjenskaPolisa, ZastupnikSifra, Auris, Alfa
		, GratisRegistracija, GratisPopust, PonistenaPolisa, FakturisanaPremija, PremijaGR, ProvizijaGR, Komentar, PovratDatum, PovratPoPremiji FROM grbaza WHERE Polisa='$Polisa'");

	$row = mysqli_fetch_array($query);

	// Get the first name
	$Klijent = $row["Klijent"];
	$JMBG = $row["JMBG"];
	$Izdavanje = $row["Izdavanje"];
	$Dnevnik = $row["Dnevnik"];
	$Opstina = $row["Opstina"];
	$VrstaMV = $row["VrstaMV"];
	$ZamjenskaPolisa = $row["ZamjenskaPolisa"];
	$ZastupnikSifra = $row["ZastupnikSifra"];
	$FakturisanaPremija = $row["FakturisanaPremija"];
	$PovratPoPremiji = $row["PovratPoPremiji"];
	$PovratDatum = $row["PovratDatum"];

	$query1 = mysqli_query($con, "SELECT ZastupnikNaziv FROM tblzastupnici WHERE ZastupnikSifra='$ZastupnikSifra' AND Aktivan='Aktivan'");

	$row1 = mysqli_fetch_array($query1);

	$ZastupnikNaziv = $row1["ZastupnikNaziv"];

	if ($row["Auris"] !== "1"){$Auris = false;} elseif ($row["Auris"] == "1"){$Auris = true;}
	if ($row["Alfa"] !== "1"){$Alfa = false;} elseif ($row["Alfa"] == "1"){$Alfa = true;}
	if ($row["GratisRegistracija"] !== "1"){$GratisRegistracija = false;} elseif ($row["GratisRegistracija"] == "1"){$GratisRegistracija = true;}
	if ($row["GratisPopust"] !== "1"){$GratisPopust = false;} elseif ($row["GratisPopust"] == "1"){$GratisPopust = true;}
	if ($row["PonistenaPolisa"] !== "1"){$PonistenaPolisa = false;} elseif ($row["PonistenaPolisa"] == "1"){$PonistenaPolisa = true;}
	$Komentar = $row["Komentar"];
	$PremijaGR = $row["PremijaGR"];
	if (empty($PremijaGR) || $PremijaGR == 0) {
		$ProvizijaGR = 0;
		$ProvizijaGRPr = 0;
	}else {
		$ProvizijaGR = $row["ProvizijaGR"];
		$ProvizijaGRPr1 = $ProvizijaGR / $PremijaGR * 100;
        $ProvizijaGRPr = round($ProvizijaGRPr1, 2);
	}

	$result = array("$Klijent","$JMBG","$Izdavanje","$Dnevnik","$Opstina","$VrstaMV","$ZamjenskaPolisa","$ZastupnikSifra","$Auris","$Alfa","$GratisRegistracija","$GratisPopust","$PonistenaPolisa"
	,"","","","","","","","","","","","","","","","","","","", "$ZastupnikNaziv", "$PremijaGR", "$ProvizijaGR", "$ProvizijaGRPr","$Komentar", "$PovratPoPremiji", "$PovratDatum","$FakturisanaPremija", "", "", "");
}
}
if ($Polisa < 2000000 && $Polisa > 1000000) {
if ($Polisa !== "") {

	// Get corresponding first name and
	// last name for that user id
	$query = mysqli_query($con, "SELECT Klijent, JMBG, Izdavanje, Dnevnik, Opstina, VrstaMV, ZamjenskaPolisa, ZastupnikSifra, Auris, Alfa
		, GratisRegistracija, GratisPopust, PonistenaPolisa, FakturisanaPremija, PremijaNZ, ProvizijaNZ, Komentar, PovratDatum, PovratPoPremiji FROM nzbaza WHERE Polisa='$Polisa'");

	$row = mysqli_fetch_array($query);

	// Get the first name
	$Klijent = $row["Klijent"];
	$JMBG = $row["JMBG"];
	$Izdavanje = $row["Izdavanje"];
	$Dnevnik = $row["Dnevnik"];
	$Opstina = $row["Opstina"];
	$VrstaMV = $row["VrstaMV"];
	$ZamjenskaPolisa = $row["ZamjenskaPolisa"];
	$ZastupnikSifra = $row["ZastupnikSifra"];
	$FakturisanaPremija = $row["FakturisanaPremija"];
	$PovratPoPremiji = $row["PovratPoPremiji"];
	$PovratDatum = $row["PovratDatum"];

	$query1 = mysqli_query($con, "SELECT ZastupnikNaziv FROM tblzastupnici WHERE ZastupnikSifra='$ZastupnikSifra' AND Aktivan='Aktivan'");

	$row1 = mysqli_fetch_array($query1);

	$ZastupnikNaziv = $row1["ZastupnikNaziv"];

	if ($row["Auris"] !== "1"){$Auris = false;} elseif ($row["Auris"] == "1"){$Auris = true;}
	if ($row["Alfa"] !== "1"){$Alfa = false;} elseif ($row["Alfa"] == "1"){$Alfa = true;}
	if ($row["GratisRegistracija"] !== "1"){$GratisRegistracija = false;} elseif ($row["GratisRegistracija"] == "1"){$GratisRegistracija = true;}
	if ($row["GratisPopust"] !== "1"){$GratisPopust = false;} elseif ($row["GratisPopust"] == "1"){$GratisPopust = true;}
	if ($row["PonistenaPolisa"] !== "1"){$PonistenaPolisa = false;} elseif ($row["PonistenaPolisa"] == "1"){$PonistenaPolisa = true;}
	$Komentar = $row["Komentar"];
	$PremijaNZ = $row["PremijaNZ"];
	if (empty($PremijaNZ) || $PremijaNZ == 0) {
		$ProvizijaNZ = 0;
		$ProvizijaNZPr = 0;
	}else {
		$ProvizijaNZ = $row["ProvizijaNZ"];
		$ProvizijaNZPr1 = $ProvizijaNZ / $PremijaNZ * 100;
        $ProvizijaNZPr = round($ProvizijaNZPr1, 2);
	}

	$result = array("$Klijent","$JMBG","$Izdavanje","$Dnevnik","$Opstina","$VrstaMV","$ZamjenskaPolisa","$ZastupnikSifra","$Auris","$Alfa","$GratisRegistracija","$GratisPopust","$PonistenaPolisa"
	,"","","","","","","","","","","","","","","","","","","", "$ZastupnikNaziv", "$PremijaNZ", "$ProvizijaNZ", "$ProvizijaNZPr","$Komentar", "$PovratPoPremiji", "$PovratDatum","$FakturisanaPremija", "", "", "");
}
}
if ($Polisa < 3000000 && $Polisa > 2000000) {
if ($Polisa !== "") {

	// Get corresponding first name and
	// last name for that user id
	$query = mysqli_query($con, "SELECT Klijent, JMBG, Izdavanje, Dnevnik, Opstina, VrstaMV, ZamjenskaPolisa, ZastupnikSifra, Auris, Alfa
		, GratisRegistracija, GratisPopust, PonistenaPolisa, FakturisanaPremija, PremijaZD, ProvizijaZD, Komentar, PovratDatum, PovratPoPremiji FROM zdbaza WHERE Polisa='$Polisa'");

	$row = mysqli_fetch_array($query);

	// Get the first name
	$Klijent = $row["Klijent"];
	$JMBG = $row["JMBG"];
	$Izdavanje = $row["Izdavanje"];
	$Dnevnik = $row["Dnevnik"];
	$Opstina = $row["Opstina"];
	$VrstaMV = $row["VrstaMV"];
	$FakturisanaPremija = $row["FakturisanaPremija"];
	$ZamjenskaPolisa = $row["ZamjenskaPolisa"];
	$ZastupnikSifra = $row["ZastupnikSifra"];
	$PovratPoPremiji = $row["PovratPoPremiji"];
	$PovratDatum = $row["PovratDatum"];

	$query1 = mysqli_query($con, "SELECT ZastupnikNaziv FROM tblzastupnici WHERE ZastupnikSifra='$ZastupnikSifra' AND Aktivan='Aktivan'");

	$row1 = mysqli_fetch_array($query1);

	$ZastupnikNaziv = $row1["ZastupnikNaziv"];

	if ($row["Auris"] !== "1"){$Auris = false;} elseif ($row["Auris"] == "1"){$Auris = true;}
	if ($row["Alfa"] !== "1"){$Alfa = false;} elseif ($row["Alfa"] == "1"){$Alfa = true;}
	if ($row["GratisRegistracija"] !== "1"){$GratisRegistracija = false;} elseif ($row["GratisRegistracija"] == "1"){$GratisRegistracija = true;}
	if ($row["GratisPopust"] !== "1"){$GratisPopust = false;} elseif ($row["GratisPopust"] == "1"){$GratisPopust = true;}
	if ($row["PonistenaPolisa"] !== "1"){$PonistenaPolisa = false;} elseif ($row["PonistenaPolisa"] == "1"){$PonistenaPolisa = true;}
	$Komentar = $row["Komentar"];
	$PremijaZD = $row["PremijaZD"];
	if (empty($PremijaZD) || $PremijaZD == 0) {
		$ProvizijaZD = 0;
		$ProvizijaZDPr = 0;
	}else {
		$ProvizijaZD = $row["ProvizijaZD"];
		$ProvizijaZDPr1 = $ProvizijaZD / $PremijaZD * 100;
        $ProvizijaZDPr = round($ProvizijaZDPr1, 2);
	}

	$result = array("$Klijent","$JMBG","$Izdavanje","$Dnevnik","$Opstina","$VrstaMV","$ZamjenskaPolisa","$ZastupnikSifra","$Auris","$Alfa","$GratisRegistracija","$GratisPopust","$PonistenaPolisa"
	,"","","","","","","","","","","","","","","","","","","","$ZastupnikNaziv", "$PremijaZD", "$ProvizijaZD", "$ProvizijaZDPr","$Komentar", "$PovratPoPremiji", "$PovratDatum","$FakturisanaPremija", "", "", "");
}
}
if ($Polisa < 4000000 && $Polisa > 3000000) {
if ($Polisa !== "") {

	// Get corresponding first name and
	// last name for that user id
	$query = mysqli_query($con, "SELECT Klijent, JMBG, Izdavanje, Dnevnik, Opstina, VrstaMV, ZamjenskaPolisa, ZastupnikSifra, Auris, Alfa,
		GratisRegistracija, GratisPopust, PonistenaPolisa, FakturisanaPremija, PremijaKASKO, ProvizijaKASKO, Komentar, PovratDatum, PovratPoPremiji FROM kaskobaza WHERE Polisa='$Polisa'");

	$row = mysqli_fetch_array($query);

	// Get the first name
	$Klijent = $row["Klijent"];
	$JMBG = $row["JMBG"];
	$Izdavanje = $row["Izdavanje"];
	$Dnevnik = $row["Dnevnik"];
	$Opstina = $row["Opstina"];
	$VrstaMV = $row["VrstaMV"];
	$FakturisanaPremija = $row["FakturisanaPremija"];
	$ZamjenskaPolisa = $row["ZamjenskaPolisa"];
	$ZastupnikSifra = $row["ZastupnikSifra"];
	$PovratPoPremiji = $row["PovratPoPremiji"];
	$PovratDatum = $row["PovratDatum"];

	$query1 = mysqli_query($con, "SELECT ZastupnikNaziv FROM tblzastupnici WHERE ZastupnikSifra='$ZastupnikSifra' AND Aktivan='Aktivan'");

	$row1 = mysqli_fetch_array($query1);

	$ZastupnikNaziv = $row1["ZastupnikNaziv"];

	if ($row["Auris"] !== "1"){$Auris = false;} elseif ($row["Auris"] == "1"){$Auris = true;}
	if ($row["Alfa"] !== "1"){$Alfa = false;} elseif ($row["Alfa"] == "1"){$Alfa = true;}
	if ($row["GratisRegistracija"] !== "1"){$GratisRegistracija = false;} elseif ($row["GratisRegistracija"] == "1"){$GratisRegistracija = true;}
	if ($row["GratisPopust"] !== "1"){$GratisPopust = false;} elseif ($row["GratisPopust"] == "1"){$GratisPopust = true;}
	if ($row["PonistenaPolisa"] !== "1"){$PonistenaPolisa = false;} elseif ($row["PonistenaPolisa"] == "1"){$PonistenaPolisa = true;}
	$Komentar = $row["Komentar"];
	$PremijaKASKO = $row["PremijaKASKO"];
	if (empty($PremijaKASKO) || $PremijaKASKO == 0) {
		$ProvizijaKASKO = 0;
		$ProvizijaKASKOPr = 0;
	}else {
		$ProvizijaKASKO = $row["ProvizijaKASKO"];
		$ProvizijaKASKOPr1 = $ProvizijaKASKO / $PremijaKASKO * 100;
        $ProvizijaKASKOPr = round($ProvizijaKASKOPr1, 2);
	}

	$result = array("$Klijent","$JMBG","$Izdavanje","$Dnevnik","$Opstina","$VrstaMV","$ZamjenskaPolisa","$ZastupnikSifra","$Auris","$Alfa","$GratisRegistracija","$GratisPopust","$PonistenaPolisa"
	,"","","","","","","","","","","","","","","","","","","","$ZastupnikNaziv", "$PremijaKASKO", "$ProvizijaKASKO", "$ProvizijaKASKOPr","$Komentar", "$PovratPoPremiji", "$PovratDatum","$FakturisanaPremija", "", "", "");
}
}
if ($Polisa < 8500000 && $Polisa > 4000000) {
if ($Polisa !== "") {

	// Get corresponding first name and
	// last name for that user id
	$query = mysqli_query($con, "SELECT Klijent, JMBG, Izdavanje, Dnevnik, Opstina, VrstaMV, ZamjenskaPolisa, ZastupnikSifra, Auris, Alfa
		, GratisRegistracija, GratisPopust, PonistenaPolisa, FakturisanaPremija, PremijaIM, ProvizijaIM, Komentar, PovratDatum, PovratPoPremiji FROM imbaza WHERE Polisa='$Polisa'");

	$row = mysqli_fetch_array($query);

	// Get the first name
	$Klijent = $row["Klijent"];
	$FakturisanaPremija = $row["FakturisanaPremija"];
	$JMBG = $row["JMBG"];
	$Izdavanje = $row["Izdavanje"];
	$Dnevnik = $row["Dnevnik"];
	$Opstina = $row["Opstina"];
	$VrstaMV = $row["VrstaMV"];
	$ZamjenskaPolisa = $row["ZamjenskaPolisa"];
	$ZastupnikSifra = $row["ZastupnikSifra"];
	$PovratPoPremiji = $row["PovratPoPremiji"];
	$PovratDatum = $row["PovratDatum"];

	$query1 = mysqli_query($con, "SELECT ZastupnikNaziv FROM tblzastupnici WHERE ZastupnikSifra='$ZastupnikSifra' AND Aktivan='Aktivan'");

	$row1 = mysqli_fetch_array($query1);

	$ZastupnikNaziv = $row1["ZastupnikNaziv"];

	if ($row["Auris"] !== "1"){$Auris = false;} elseif ($row["Auris"] == "1"){$Auris = true;}
	if ($row["Alfa"] !== "1"){$Alfa = false;} elseif ($row["Alfa"] == "1"){$Alfa = true;}
	if ($row["GratisRegistracija"] !== "1"){$GratisRegistracija = false;} elseif ($row["GratisRegistracija"] == "1"){$GratisRegistracija = true;}
	if ($row["GratisPopust"] !== "1"){$GratisPopust = false;} elseif ($row["GratisPopust"] == "1"){$GratisPopust = true;}
	if ($row["PonistenaPolisa"] !== "1"){$PonistenaPolisa = false;} elseif ($row["PonistenaPolisa"] == "1"){$PonistenaPolisa = true;}
	$Komentar = $row["Komentar"];
	$PremijaIM= $row["PremijaIM"];
	if (empty($PremijaIM) || $PremijaIM == 0) {
		$ProvizijaIM = 0;
		$ProvizijaIMPr = 0;
	}else {
		$ProvizijaIM = $row["ProvizijaIM"];
		$ProvizijaIMPr1 = $ProvizijaIM / $PremijaIM * 100;
        $ProvizijaIMPr = round($ProvizijaIMPr1, 2);
	}

	$result = array("$Klijent","$JMBG","$Izdavanje","$Dnevnik","$Opstina","$VrstaMV","$ZamjenskaPolisa","$ZastupnikSifra","$Auris","$Alfa","$GratisRegistracija","$GratisPopust","$PonistenaPolisa"
	,"","","","","","","","","","","","","","","","","","","","$ZastupnikNaziv", "$PremijaIM", "$ProvizijaIM", "$ProvizijaIMPr","$Komentar", "$PovratPoPremiji", "$PovratDatum","$FakturisanaPremija", "", "", "");
}
}
// Send in JSON encoded form
$myJSON = json_encode($result);
echo $myJSON;
?>