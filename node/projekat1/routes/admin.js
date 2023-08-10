const { Router } = require("express");
const express = require("express");
const isAuth = require("../middleware/isAuth");
const { check } = require("express-validator/check");

const controller = require("../controllers/admin");

const router = express.Router();

router.get("/login", (req, res) => {
  res.render("login");
});

router.get("/dashboard", isAuth, (req, res) => {
  res.render("dashboard", { edit: false });
});

router.get("/izvodjacUpload", isAuth, (req, res) => {
  res.render("autorUpload", { edit: false });
});
router.get("/dogadjajUpload", isAuth, (req, res) => {
  res.render("dogadjajUpload", { edit: false });
});
router.get("/podkastUpload", isAuth, (req, res) => {
  res.render("podkastUpload", { edit: false });
});

router.get("/izvodjacDash", isAuth, controller.getIzvodjacDash);
router.get("/podkastDash", isAuth, controller.getPodkastDash);
router.get("/dogadjajDash", isAuth, controller.getDogadjajDash);

router.post(
  "/izvodjac",

  [
    check("ime").not().isEmpty(),
    check("zanr").not().isEmpty(),
    check("mjesto").not().isEmpty(),
    check("biografija").not().isEmpty(),
  ],
  isAuth,
  controller.postIzvodjac
);

router.post(
  "/dogadjaj",

  [
    check("naslov").not().isEmpty(),
    check("opis").not().isEmpty(),
    check("tekst").not().isEmpty(),
    check("lokacija").not().isEmpty(),
    check("vrijeme").not().isEmpty(),
    check("vrijemeTekst").not().isEmpty(),
  ],
  isAuth,
  controller.postDogadjaj
);

router.post(
  "/podkest",

  [check("naslov").not().isEmpty(), check("link").not().isEmpty().isURL()],
  isAuth,
  controller.postPodkest
);

router.post("/login", controller.postLogin);

router.post("/dogadjaj-delete/:id", isAuth, controller.deleteDogadjaj);

router.post("/izvodjac-delete/:id", isAuth, controller.deleteIzvodjac);

router.post("/podkast-delete/:id", isAuth, controller.deletePodkest);

router.get("/dogadjaj-update/:id", isAuth, controller.getDogadjajU);

router.get("/izvodjac-update/:id", isAuth, controller.getIzvodjacU);

router.get("/podkast-update/:id", isAuth, controller.getPodkastU);

router.post("/dogadjaj-update/:id", isAuth, controller.putDogadjaj);

router.post("/izvodjac-update/:id", isAuth, controller.putIzvodjac);

router.post("/podkast-update/:id", isAuth, controller.putPodkest);

module.exports = router;
