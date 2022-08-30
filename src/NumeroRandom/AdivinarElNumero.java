package NumeroRandom;
import java.util.Scanner;
import java.util.Random;

public class AdivinarElNumero {
    public static void main(String[] args) {
        Scanner s = new Scanner(System.in);
        Random r = new Random();
        int nRandom = r.nextInt(100);
        int contador = 1;
        int nUsuario;
        System.out.println("Ingrese un numero: ");
        nUsuario = s.nextInt();
        while (nRandom != nUsuario){
            if(nRandom < nUsuario){
                System.out.println("Ese no era el numero, el numero que colocaste es mayor.");
            }else{
                System.out.println("Ese no era el numero, el numero que colocaste es menor.");
            }
            System.out.println("");
            System.out.println("Intenta otra vez: ");
            nUsuario = s.nextInt();
            contador = contador + 1;
        }
        System.out.println("¡¡HACERTASTE!! El numero era " + nUsuario + ", hiciste " + contador + " intentos.");
    }
}
