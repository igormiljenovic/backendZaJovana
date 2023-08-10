const { Router } = require("express");
const express = require("express");

const controller = require("../controllers/controllers");

const router = express.Router();

router.get("/", controller.getIndex);

router.get("/dogadjaji", controller.getDogadjaji);

router.get("/izvodjaci", controller.getIzvodjaci);

router.get("/podkesti", controller.getPodkesti);

router.get("/o_nama", (req, res) => {
  res.render("onama");
});

router.get("/dogadjaji/:id", controller.getDogadjaj);

router.get("/izvodjaci/:id", controller.getIzvodjac);

module.exports = router;
