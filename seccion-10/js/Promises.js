const usuarioAutenticado = new Promise( (resolve /*Se ejecuta cuando se cumple*/, reject/*Cuando no*/) => {
    const auth = true;

    if(auth) {
        resolve('Usuario Autenticado'); 
    }else {
        reject('No se pudo iniciar sesión');
    }
});

usuarioAutenticado
    .then( resultado => console.log(resultado)) //Cuando se cumple se usa esto para utilizar el valor que devuelve
    .catch( error => console.log(error))
/*Existen 3 valores

Pending: No se ha cumplido ni rechazado
Fullfilled :Completado
Rejected : Rechazado
*/