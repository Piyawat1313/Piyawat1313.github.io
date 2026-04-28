const express = require('express');
const cors = require('cors');
const path = require('node:path');

const app = express();

app.use(cors());

app.get('/index', async (req, res) => {
    res.sendFile(path.join(__dirname, 'index.html'));
});

app.use('/images', express.static(path.join(__dirname, 'images')));


app.use('/design', express.static(path.join(__dirname, 'design')));

const PORT = 3000;
app.listen(PORT, () => {
    console.log(`SERVER Running on http://localhost:${PORT}/index`);
});