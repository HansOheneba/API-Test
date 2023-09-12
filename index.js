const app = require('express')();
const PORT = 8080;

app.listen(
    PORT,
    () => console.log(`It is alive on http://localhost:${PORT}`)
)