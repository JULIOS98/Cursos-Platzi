//Funciones declarativas

function miFuncion1()
{
    return 3;
}

//miFuncion();


let res;

//Funciones Expresivas o anonimas
let miFuncion = function(a,b){

    //return a + b;
   
    res = a + b;

    console.log(res);
}
    

miFuncion(5,5);

function saludarEstudiante(estudiante)
{
    console.log(`Hola: ${estudiante} ` );
}


saludarEstudiante('Julio');


//Funcion con palabra reservada return 
function sumar(a,b)
{
    let resultado = a + b;
    return resultado;
}

sumar(1,2);

//
let persona = {

    nombre: "Julio",
    edad: 22,
}

function presentarPersona(args)
{
    return `Hola me llamo ${args.nombre} y tengo ${args.edad}`;
}

presentarPersona(persona);


//Funcion dentro de otra funcion 

function a(x)
{
    function b(y)
    {
        return x + y;
    }

    return b;
}