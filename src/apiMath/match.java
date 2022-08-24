package apiMath;

public class match {
    public static void main(String[] args) {
       //------------Funciones trigonométricas habituales----------------------------------------
       Double sin = Math.sin(2);  //retorna el seno
       System.out.println(sin);
       Double cos =  Math.cos(2); //retorna el coseno
       System.out.println(cos);
       Double tan =  Math.tan(2); //retorna la tangente
        System.out.println(tan);
        Double atan = Math.atan(2); //retorna el arcotangente
        System.out.println(atan);
        Double atan2 = Math.atan2(1, 2); //retorna la arcotangente del cociente de los argumentos.
        System.out.println(atan2);
        //---------------------------------------------------------------------------------------
        //-----------------La función exponencial y su inversa-----------------------------------
        Double exp = Math.exp(2);
        System.out.println(exp);
        Double log = Math.log(2); //devuelve la base neutral de un número
        System.out.println(log);
        //---------------------------------------------------------------------------------------
        //--------------------------Las dos constantes PI y e------------------------------------
        Double pi = Math.PI; //Retorna el valor de pi
        System.out.println(pi);
        Double e = Math.E; //Retorna la base de los logaritmos naturales
        System.out.println(e);
    }
}
