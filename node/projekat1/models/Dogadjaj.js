const Sequelize = require("sequelize");

const sequelize = require("../utils/database");

const Dogadjaj = sequelize.define("dogadjaj", {
  id: {
    type: Sequelize.INTEGER,
    autoIncrement: true,
    allowNull: false,
    primaryKey: true,
  },
  naslov: {
    type: Sequelize.STRING,
    allowNull: false,
  },
  opis: {
    type: Sequelize.STRING,
    allowNull: false,
  },
  slika: {
    type: Sequelize.STRING,
    allowNull: false,
  },
  tekst: {
    type: Sequelize.STRING,
    allowNull: false,
  },
  lokacija: {
    type: Sequelize.STRING,
    allowNull: false,
  },
  vrijeme: {
    type: Sequelize.DATE,
    allowNull: false,
  },
  vrijemeTekst: {
    type: Sequelize.STRING,
    allowNull: false,
  },
});

module.exports = Dogadjaj;
