package Variables;
import java.util.Scanner;
public class variable {
    public static void main(String[] args) {
        String nombre;
        int edad;
        double salario;
        boolean carnet;
        Scanner s = new Scanner(System.in);
        System.out.println("Coloca tu nombre");
        nombre = s.next();
        System.out.println("Coloca tu edad");
        edad = s.nextInt();
        System.out.println("Tu salario deseado");
        salario = s.nextDouble();
        System.out.println("¿Posees un carnet?");
        carnet = s.hasNext("si");
        System.out.println("-------------------------------------------------------");
        System.out.println("Tu nombre es " + nombre);
        System.out.println("Tu salario deseado es " + salario);
        System.out.println("Tu edad es " + edad);
        if(carnet == true){
            System.out.println("Si posees carnet");
        }else {
            System.out.println("No posees carnet");
        }
        System.out.println("---------------------------------------------------------");
    }
}
