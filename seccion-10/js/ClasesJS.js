class Producto{
    constructor(nombre, precio){
        this.nombre = nombre;
        this.precio = precio;
    }

    formatearProducto(){ //Este es como el prototype
        return `El producto es ${this.nombre} con un precio de ${this.precio} . Mensaje creado con prototipo`;
    }
}

const producto = new Producto("Monitor", 300);
const producto2 = new Producto("Celular", 200);


//Herencia

class Libro extends Producto{
    constructor(nombre, precio, isbn){
        super(nombre, precio); //Hereda los parametros que se le pasen a la funcion de la clase padre
        this.isbn = isbn; //En super solo se colocan los que existen en la clase padre y los demas que necesite se colocan
    }

    formatearProducto(){
        return `${super.formatearProducto} y su ISBN es ${this.isbn}` //Se toma el valor de formatearProducto de la clase padre y se le agrega lo demas
    }
}

const libro = new libro("JavaScript", 150, "7948651");

const libroFormateado = libro.formatearProducto();