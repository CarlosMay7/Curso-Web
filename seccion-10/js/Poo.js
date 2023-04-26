
//Object Literal
//Forma mas usada aunque no la mas dinamica

const producto = {
    nombre : "Celular",
    precio :500
}

//Object constructor

function Producto2 (/*Parametros*/ nombre, precio){
    this.nombre = nombre;
    this.precio = precio;
}

const producto2 = new Producto2("Monitor", 300);

function formatear (producto){
    return `El producto es ${producto.nombre} con un precio de ${producto.precio}`;
}
//Los prototipos son para que una funcion solo se use en un tipo de objeto

producto2.prototype.formatearProducto = function() {
    return `El producto es ${this.nombre} con un precio de ${this.precio} . Mensaje creado con prototipo`;
}