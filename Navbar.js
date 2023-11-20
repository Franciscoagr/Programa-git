// Navbar.js
import React from 'react';

const Navbar = () => {
  return (
    <nav>
      <ul>
        <li><a href="/">Inicio</a></li>
        <li><a href="/nuevaguia">Nueva Guía</a></li>
        <li><a href="/editarguia">Editar Guía</a></li>
        <li><a href="/buscarguia">Buscar Guía</a></li>
      </ul>
    </nav>
  );
};

export default Navbar;
