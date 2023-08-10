const Sequelize = require("sequelize");

const sequelize = require("../utils/database");

const Podkast = sequelize.define("podkast", {
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
  link: {
    type: Sequelize.STRING,
    allowNull: false,
  },
  slika: {
    type: Sequelize.STRING,
    allowNull: false,
  },
});

module.exports = Podkast;
