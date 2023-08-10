const Sequelize = require("sequelize");

const sequelize = require("../utils/database");

const Autor = sequelize.define("autor", {
  id: {
    type: Sequelize.INTEGER,
    autoIncrement: true,
    allowNull: false,
    primaryKey: true,
  },
  ime: {
    type: Sequelize.STRING,
    allowNull: false,
  },
  slika: {
    type: Sequelize.STRING,
    allowNull: false,
  },
  zanr: {
    type: Sequelize.STRING,
    allowNull: false,
  },
  mjesto: {
    type: Sequelize.STRING,
    allowNull: false,
  },
  biografija: {
    type: Sequelize.STRING,
    allowNull: false,
  },
  facebook: {
    type: Sequelize.STRING,
  },
  instagram: {
    type: Sequelize.STRING,
  },
  soundcloud: {
    type: Sequelize.STRING,
  },
  bandcamp: {
    type: Sequelize.STRING,
  },
  youtube: {
    type: Sequelize.STRING,
  },
});

module.exports = Autor;
