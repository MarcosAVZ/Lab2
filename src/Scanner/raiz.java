package Scanner;
import java.util.Scanner;

public class raiz {
    public static void main(String[] args) {
        int numero;
        double result;
        Scanner s = new Scanner(System.in);
        System.out.println("Ingrese un numero");
        numero = s.nextInt();
        result = Math.sqrt(numero);
        System.out.println("La raiz de ese numero es: " + result);
    }
}