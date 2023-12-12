const express = require('express');
const mysql = require('mysql2');
const bodyParser = require('body-parser');
const cors = require('cors');
const bcrypt = require('bcrypt');
const jwt = require('jsonwebtoken');

const app = express();
const secretKey = '12345'; 

const corsOptions = {
  origin: 'http://localhost:4200',
  optionsSuccessStatus: 200,
};

app.use(cors(corsOptions));
app.use(bodyParser.json());

const pool = mysql.createPool({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'tecempleo',
  waitForConnections: true,
  connectionLimit: 10,
  queueLimit: 0,
});

let isAuthenticated = false;

pool.getConnection(async (err, connection) => {
  if (err) {
    console.error('Error al conectar a la base de datos:', err.message);
  } else {
    try {
      console.log('Conexión exitosa a la base de datos');
      connection.release();
    } catch (error) {
      console.error('Error al liberar la conexión:', error.message);
    }
  }
});

const validateRegistrationFields = (req, res, next) => {
  const { Nombre_Reg, Email_reg, Contrasena, Apellido_Reg, Telefono } = req.body;

  if (!Nombre_Reg || !Email_reg || !Contrasena || !Apellido_Reg || !Telefono) {
    return res.status(400).json({ error: 'Todos los campos son requeridos para el registro.' });
  }

  next();
};

app.post('/registro', validateRegistrationFields, async (req, res) => {
  const { Nombre_Reg, Email_reg, Contrasena, Apellido_Reg, Telefono } = req.body;

  try {
    const hashedPassword = await bcrypt.hash(Contrasena, 10);

    pool.query(
      'INSERT INTO registro (Nombre_Reg, Email_reg, Contrasena, Apellido_Reg, Telefono) VALUES (?, ?, ?, ?, ?)',
      [Nombre_Reg, Email_reg, hashedPassword, Apellido_Reg, Telefono],
      (err, results) => {
        if (err) {
          return res.status(500).json({ error: err.message });
        }

        if (results.affectedRows === 1) {
          res.status(201).json({
            message: 'Usuario registrado exitosamente',
            id: results.insertId,
          });
        } else {
          res.status(500).json({ error: 'No se pudo registrar al usuario.' });
        }
      }
    );
  } catch (error) {
    console.error(error);
    res.status(500).json({ error: 'Error al encriptar la contraseña.' });
  }
});

const validateLoginFields = (req, res, next) => {
  const { Email_reg, Contrasena } = req.body;

  if (!Email_reg || !Contrasena) {
    return res
      .status(400)
      .json({ error: 'Correo electrónico y contraseña son requeridos para iniciar sesión.' });
  }

  next();
};

app.post('/login', validateLoginFields, async (req, res) => {
  const { Email_reg, Contrasena } = req.body;

  pool.query('SELECT * FROM registro WHERE Email_reg = ?', [Email_reg], async (err, rows) => {
    if (err) {
      return res.status(500).json({ error: err.message });
    }

    if (rows.length === 0) {
      return res.status(401).json({ error: 'Credenciales incorrectas' });
    }

    const user = rows[0];

    try {
      const isPasswordMatch = await bcrypt.compare(Contrasena, user.Contrasena);

      if (isPasswordMatch) {
        const token = jwt.sign({ userId: user.id, email: user.Email_reg }, secretKey, {
          expiresIn: '1h', 
        });

        isAuthenticated = true;

        res.status(200).json({
          message: 'Inicio de sesión exitoso',
          token: token,
          usuario: {
            id: user.id,
            Nombre_Reg: user.Nombre_Reg,
            Email_reg: user.Email_reg,
            Apellido_Reg: user.Apellido_Reg,
            Telefono: user.Telefono,
          },
        });
      } else {
        res.status(401).json({ error: 'Credenciales incorrectas' });
      }
    } catch (error) {
      console.error(error);
      res.status(500).json({ error: 'Error al verificar la contraseña.' });
    }
  });
});

app.post('/cerrar-sesion', (req, res) => {
  isAuthenticated = false;

  res.status(200).json({ message: 'Sesión cerrada exitosamente' });
});

const port = process.env.PORT || 3000;

app.listen(port, () => {
  console.log(`El servidor está ejecutándose en el puerto ${port}`);
});
