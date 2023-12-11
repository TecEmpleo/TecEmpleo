const express = require('express');
const mysql = require('mysql2');
const bodyParser = require('body-parser');
const cors = require('cors');  

const app = express();
app.use(cors());  
app.use(bodyParser.json());


const pool = mysql.createPool({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'tecempleo',
  waitForConnections: true,
  connectionLimit: 10,
  queueLimit: 0
});

const validateFields = (req, res, next) => {
  const { Descripcion, Nombre_Cat } = req.body;

  if (!Descripcion || !Nombre_Cat) {
    return res.status(400).json({ error: 'Se requieren tanto Descripción como Nombre.' });
  }

  next();
};

const errorHandler = (err, req, res, next) => {
  console.error(err.stack);
  res.status(500).json({ error: 'Algo salió mal en el servidor.' });
};

app.post('/categorias', validateFields, (req, res) => {
    const { Descripcion, Nombre_Cat } = req.body;
  
    pool.query("INSERT INTO categoria (Descripcion, Nombre_Cat) VALUES (?, ?)", [Descripcion, Nombre_Cat], (err, results) => {
      if (err) {
        return res.status(500).json({ error: err.message });
      }
  
      if (results.affectedRows === 1) {
        res.status(201).json({
          message: 'Nueva categoría creada',
          id: results.insertId
        });
      } else {
        res.status(500).json({ error: 'No se pudo crear la categoría.' });
      }
    });
  });
  
app.get('/categorias/:id?', (req, res) => {
  const id = req.params.id;

  if (id) {
    pool.query("SELECT * FROM categoria WHERE idCategoria = ?", [id], (err, rows) => {
      if (err) {
        return res.status(500).json({ error: err.message });
      }

      if (rows.length === 0) {
        return res.status(404).json({ error: 'Categoría no encontrada' });
      }

      res.json({
        categoria: rows[0]
      });
    });
  } else {
    pool.query("SELECT * FROM categoria", (err, rows) => {
      if (err) {
        return res.status(500).json({ error: err.message });
      }

      res.json({
        categorias: rows
      });
    });
  }
});

app.put('/categorias/:id', validateFields, (req, res) => {
  const { Descripcion, Nombre_Cat } = req.body;
  const id = req.params.id;

  pool.query("UPDATE categoria SET Descripcion = ?, Nombre_Cat = ? WHERE idCategoria = ?", [Descripcion, Nombre_Cat, id], (err, results) => {
    if (err) {
      return res.status(500).json({ error: err.message });
    }

    res.json({
      message: 'Categoría actualizada',
      changes: results.affectedRows
    });
  });
});

app.delete('/categorias/:id', (req, res) => {
  const id = req.params.id;

  pool.query("DELETE FROM categoria WHERE idCategoria = ?", [id], (err, results) => {
    if (err) {
      return res.status(500).json({ error: err.message });
    }

    res.json({
      message: 'Categoría eliminada',
      changes: results.affectedRows
    });
  });
});

const port = process.env.PORT || 8080;

app.listen(port, () => {
  console.log(`El servidor está ejecutándose en el puerto ${port}`);
});
