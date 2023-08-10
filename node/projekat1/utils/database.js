const Sequelize = require("sequelize");

const sequelize = new Sequelize({dialect: "sqlite", storage: "/root/blaster/blasterSajt/blaster.sqlite"});

module.exports = sequelize;
