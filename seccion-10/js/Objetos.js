//Crear objetos

//Para construir un objeto se necesita el nombre y las variables o propiedades que contiene
const producto = {
    nombreProducto : "Control", //Se usan los : para asignar valores y la , para dividir las propiedades
    precio : 300,
    disponible : true
}

//Se puede usar el .nombrePropiedas para acceder a la propiedad del objeto
console.log (producto.precio);
//O igual con ["nombrePropiedad"]  aunque es mas raro
console.log(producto["precio"]);

//Agregar propiedades
producto.imagen = 'imagen';

//Eliminar propiedades
delete producto.disponible;

//Forma anterior a destructuring
//Los valores de las propiedades de los objetos se pueden asignar a otras fuera de estos

const precioProducto = producto.precio;


//Destructuring
//Se usan las llaves, dentro se colocan los nombres exactos de las propiedades del objeto y se crean variables con los mismos nombres
//Funciona con arreglos
const {precio, disponible} = producto;