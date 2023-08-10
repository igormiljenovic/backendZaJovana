const { validationResult } = require("express-validator/check");

const Autor = require("../models/Autor");
const Podkest = require("../models/Podkast");
const Dogadjaj = require("../models/Dogadjaj");
const { get } = require("../routes/admin");

exports.postLogin = (req, res, next) => {
  console.log(req.body.password);
  if (req.body.password === "13tankanit69badzo19zolja420saraf123jumbas!") {
    req.session.isLoggedIn = true;
    res.redirect("/admin/dashboard");
  } else {
    res.redirect("/admin/login");
  }
};

exports.postIzvodjac = (req, res, next) => {
  const ime = req.body.ime;
  const slika = req.file.path;
  const zanr = req.body.zanr;
  const mjesto = req.body.mjesto;
  const biografija = req.body.biografija;
  const facebook = req.body.facebook;
  const instagram = req.body.instagram;
  const soundcloud = req.body.soundcloud;
  const bandcamp = req.body.bandcamp;
  const youtube = req.body.youtube;

  const error = validationResult(req);
  if (!error.isEmpty()) {
    return res.status(422).render("autorUpload");
  }

  Autor.create({
    ime,
    slika,
    zanr,
    mjesto,
    biografija,
    facebook,
    instagram,
    soundcloud,
    bandcamp,
    youtube,
  })
    .then((result) => {
      res.redirect("/izvodjaci");
    })
    .catch((err) => {
      console.log(err);
    });
};

exports.postDogadjaj = (req, res, next) => {
  const naslov = req.body.naslov;
  const opis = req.body.opis;
  const slika = req.file.path;
  const tekst = req.body.tekst;
  const lokacija = req.body.lokacija;
  const vrijeme = req.body.vrijeme;
  const vrijemeTekst = req.body.vrijemeTekst;

  const error = validationResult(req);
  if (!error.isEmpty()) {
    return res.status(422).render("dogadjajUpload");
  }

  Dogadjaj.create({
    naslov,
    opis,
    slika,
    tekst,
    lokacija,
    vrijeme,
    vrijemeTekst,
  })
    .then((result) => {
      res.redirect("/dogadjaji");
    })
    .catch((err) => {
      console.log(err);
    });
};

exports.postPodkest = (req, res, next) => {
  const link = req.body.link;
  const naslov = req.body.naslov;
  const slika = req.file.path;

  const error = validationResult(req);
  if (!error.isEmpty()) {
    return res.status(422).render("podkastUpload");
  }

  Podkest.create({ link, naslov, slika })
    .then((result) => {
      res.redirect("/podkesti");
    })
    .catch((err) => {
      console.log(err);
    });
};

exports.putIzvodjac = (req, res, next) => {
  const id = req.params.id;
  const ime = req.body.ime;
  //const slika = req.file.path;
  const zanr = req.body.zanr;
  const mjesto = req.body.mjesto;
  const biografija = req.body.biografija;
  const facebook = req.body.facebook;
  const instagram = req.body.instagram;
  const soundcloud = req.body.soundcloud;
  const bandcamp = req.body.bandcamp;
  const youtube = req.body.youtube;

  const error = validationResult(req);
  if (!error.isEmpty()) {
    return res.status(422).render("autorUpload");
  }

  Autor.findByPk(id)
    .then((autor) => {
      autor.ime = ime;
      // autor.slika = slika;
      autor.zanr = zanr;
      autor.mjesto = mjesto;
      autor.biografija = biografija;
      autor.facebook = facebook;
      autor.instagram = instagram;
      autor.soundcloud = soundcloud;
      autor.bandcamp = bandcamp;
      autor.youtube = youtube;
      return autor.save();
    })
    .then((result) => {
      res.redirect("/izvodjaci");
    })
    .catch((err) => {
      console.log(err);
    });
};
exports.putDogadjaj = (req, res, next) => {
  const id = req.params.id;
  const naslov = req.body.naslov;
  const opis = req.body.opis;
  //const slika = req.file.path;
  const tekst = req.body.tekst;
  const lokacija = req.body.lokacija;
  const vrijeme = req.body.vrijeme;
  const vrijemeTekst = req.body.vrijemeTekst;

  const error = validationResult(req);
  if (!error.isEmpty()) {
    return res.status(422).render("dogadjajUpload");
  }

  Dogadjaj.findByPk(id)
    .then((dog) => {
      dog.naslov = naslov;
      dog.opis = opis;
      // dog.slika = slika;
      dog.tekst = tekst;
      dog.lokacija = lokacija;
      dog.vrijeme = vrijeme;
      dog.vrijemeTekst = vrijemeTekst;
      return dog.save();
    })
    .then((result) => {
      res.redirect("/dogadjaji");
    })
    .catch((err) => {
      console.log(err);
    });
};
exports.putPodkest = (req, res, next) => {
  const id = req.params.id;
  const link = req.body.link;
  const naslov = req.body.naslov;
  //const slika = req.file.path;

  const error = validationResult(req);
  if (!error.isEmpty()) {
    return res.status(422).render("podkastUpload");
  }

  Podkest.findByPk(id)
    .then((pod) => {
      pod.link = link;
      pod.naslov = naslov;
      // pod.slika = slika;
      return pod.save();
    })
    .then((result) => {
      res.redirect("/podkesti");
    })
    .catch((err) => {
      console.log(err);
    });
};

exports.deleteIzvodjac = (req, res, next) => {
  const id = req.params.id;
  Autor.findByPk(id)
    .then((data) => {
      return data.destroy();
    })
    .then((result) => {
      res.redirect("/admin/izvodjacDash");
    })
    .catch((err) => {
      console.log(err);
    });
};
exports.deleteDogadjaj = (req, res, next) => {
  const id = req.params.id;
  Dogadjaj.findByPk(id)
    .then((data) => {
      return data.destroy();
    })
    .then((result) => {
      res.redirect("/admin/dogadjajDash");
    })
    .catch((err) => {
      console.log(err);
    });
};
exports.deletePodkest = (req, res, next) => {
  const id = req.params.id;
  Podkest.findByPk(id)
    .then((data) => {
      return data.destroy();
    })
    .then((result) => {
      res.redirect("/admin/podkastDash");
    })
    .catch((err) => {
      console.log(err);
    });
};

exports.getIzvodjacDash = (req, res, next) => {
  Autor.findAll()
    .then((izvodjaci) => {
      res.render("autorDash", {
        data: izvodjaci,
        naslov: "izvodjaci",
      });
    })
    .catch((err) => {
      console.log(err);
    });
};

exports.getDogadjajDash = (req, res, next) => {
  Dogadjaj.findAll()
    .then((dog) => {
      res.render("dogadjajDash", {
        data: dog,
        naslov: "dogadjaji",
      });
    })
    .catch((err) => {
      console.log(err);
    });
};
exports.getPodkastDash = (req, res, next) => {
  Podkest.findAll()
    .then((podkesti) => {
      res.render("podkastDash", {
        data: podkesti,
        naslov: "Podkesti",
      });
    })
    .catch((err) => {
      console.log(err);
    });
};

exports.getDogadjajU = (req, res, next) => {
  const dogId = req.params.id;
  Dogadjaj.findByPk(dogId)
    .then((dogadjaj) => {
      res.render("dogadjajUpload", {
        data: dogadjaj,
        naslov: "Dogadjaji",
        edit: true,
      });
    })
    .catch((err) => {
      console.log(err);
    });
};

exports.getIzvodjacU = (req, res, next) => {
  const izvId = req.params.id;
  Autor.findByPk(izvId)
    .then((izvodjac) => {
      res.render("autorUpload", {
        data: izvodjac,
        naslov: "Izvodjac",
        edit: true,
      });
    })
    .catch((err) => {
      console.log(err);
    });
};

exports.getPodkastU = (req, res, next) => {
  const izvId = req.params.id;
  Podkest.findByPk(izvId)
    .then((podkast) => {
      res.render("podkastUpload", {
        data: podkast,
        naslov: "Podkast",
        edit: true,
      });
    })
    .catch((err) => {
      console.log(err);
    });
};
