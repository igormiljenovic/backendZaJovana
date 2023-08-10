const express = require('express');
const router = express.Router();
const authMiddleware = require('../middlewares/authMiddleware');

router.get('/protected', authMiddleware.authenticate, (req, res) => {
  // Access user ID using req.userId
  res.status(200).json({ message: 'Protected route accessed successfully' });
});

module.exports = router;
