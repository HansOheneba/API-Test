const express = require('express');
const app = require('express')();
const PORT = 8080;

app.use(express.json()); // Middleware to parse JSON request bodies


app.listen(PORT, () => {
    console.log(`Server is running on http://localhost:${PORT}`);
});

app.get('/tshirt', (req, res) => {
    res.status(200).send({
        tshirt: '👕',
        size: 'large'
    })
});

app.post('/tshirt/:id', (req, res) => {

    const { id } = req.params;
    const { logo } = req.body;

    if (!logo){
        res.status(418).send({ message: 'We need a logo!' })
    }

    res.send({
        tshirt: `👕 With your ${logo} and ID of ${id}`,
    });    
});

