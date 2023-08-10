const path = require("path");

const { Op } = require("sequelize");
const Autor = require("../models/Autor");
const Podkest = require("../models/Podkast");
const Dogadjaj = require("../models/Dogadjaj");

exports.getIndex = (req, res, next) => {
  const trenutniDatum = new Date();
  Dogadjaj.findAll({
    where: { vrijeme: { [Op.gte]: trenutniDatum } },
    order: [["vrijeme", "ASC"]],
    limit: 2,
  })
    .then((dogadjaji) => {
      res.render("index", {
        data: dogadjaji,
        naslov: "BLASTER",
        path: "/",
      });
    })
    .catch((err) => {
      console.log(err);
    });
};

exports.getIzvodjaci = (req, res, next) => {
  Autor.findAll()
    .then((izvodjaci) => {
      res.render("izvodjaci", {
        data: izvodjaci,
        naslov: "izvodjaci",
        path: "/izvodjaci",
      });
    })
    .catch((err) => {
      console.log(err);
    });
};

exports.getDogadjaji = (req, res, next) => {
  const trenutniDatum = new Date();
  Dogadjaj.findAll()
    .then((result) => {
      let buduci = [];
      let prosli = [];
      for (let d of result) {
        const datum = new Date(d.vrijeme);
        if (datum >= trenutniDatum) {
          buduci.push(d);
        } else {
          prosli.push(d);
        }
      }
      return [buduci, prosli];
    })
    .then((niz) => {
      res.render("dogadjaji", {
        buduciDogadjaji: niz[0],
        prosliDogadjaji: niz[1],
        naslov: "Dogadjaji",
        path: "/dogadjaji",
      });
    })
    .catch((err) => {
      console.log(err);
    });
};

exports.getPodkesti = (req, res, next) => {
  Podkest.findAll()
    .then((podkesti) => {
      res.render("podkesti", {
        data: podkesti,
        naslov: "Podkesti",
        path: "/podkesti",
      });
    })
    .catch((err) => {
      console.log(err);
    });
};

exports.getDogadjaj = (req, res, next) => {
  const dogId = req.params.id;
  Dogadjaj.findByPk(dogId)
    .then((dogadjaj) => {
      res.render("stranicaZaDogadjaje", {
        data: dogadjaj,
        naslov: "Dogadjaji",
        path: "/dogadjaji:id",
      });
    })
    .catch((err) => {
      console.log(err);
    });
};

exports.getIzvodjac = (req, res, next) => {
  const izvId = req.params.id;
  Autor.findByPk(izvId)
    .then((izvodjac) => {
      res.render("stranicaZaIzvodjace", {
        data: izvodjac,
        naslov: "Izvodjac",
        path: "/izvodjac:id",
      });
    })
    .catch((err) => {
      console.log(err);
    });
};
