const bcrypt = require('bcrypt');
const jwt = require('jsonwebtoken');
const User = require('../models/user');

const SECRET_KEY = process.env.SECRET_KEY;

async function register(username, password) {
  try {
    const hashedPassword = await bcrypt.hash(password, 10);

    const newUser = new User({
      username,
      password: hashedPassword,
    });

    await newUser.save();
    return { message: 'User registered successfully' };
  } catch (error) {
    console.error(error);
    throw new Error('Registration failed');
  }
}

async function login(username, password) {
  try {
    const user = await User.findOne({ username });
    if (!user) {
      throw new Error('Authentication failed');
    }

    const passwordMatch = await bcrypt.compare(password, user.password);
    if (!passwordMatch) {
      throw new Error('Authentication failed');
    }

    const token = jwt.sign({ userId: user._id }, SECRET_KEY, { expiresIn: '1h' });
    return { token };
  } catch (error) {
    console.error(error);
    throw new Error('Login failed');
  }
}

module.exports = { register, login };
