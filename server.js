const express = require('express');
const path = require('node:path');

const app = express();

app.get('/index', async (req, res) => {
    res.sendFile(path.join(__dirname, 'index.html'));
});

app.use('/assets/images', express.static(path.join(__dirname, '/assets/images')));
app.use('/images', express.static(path.join(__dirname, '/images')));
app.use('/design', express.static(path.join(__dirname, '/design')));

const PORT = 3000;
app.listen(PORT, () => {
    console.log(`SERVER Running http://localhost:${PORT}/index`);
});