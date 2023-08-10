const express = require('express');
const bodyParser = require('body-parser');
const mongoose = require('mongoose');
const authController = require('./controllers/authController');
const protectedRoutes = require('./routes/protectedRoutes');

const app = express();
app.use(bodyParser.json());

mongoose.connect('mongodb://localhost/myapp', {
  useNewUrlParser: true,
  useUnifiedTopology: true,
});

app.post('/register', authController.register);
app.post('/login', authController.login);
app.use('/api', protectedRoutes);

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
  console.log(`Server is running on port ${PORT}`);
});
