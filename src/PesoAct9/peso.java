package PesoAct9;
import java.util.Scanner;
public class peso {
    public static void main(String[] args) {
        Scanner s = new Scanner(System.in);
        boolean genero;
        int altura;
        int pesoIdeal;

        System.out.println("¿Cual es tu altura en centimetros?");
        altura = s.nextInt();
        System.out.println("¿Eres hombre o mujer?");
        genero = s.hasNext("hombre");
        if(genero){
          pesoIdeal = altura - 110;
          System.out.println("Tu peso ideal seria " + pesoIdeal +"kg.");
        }else {
            pesoIdeal = altura - 120;
            System.out.println("Tu peso ideal seria " + pesoIdeal +"kg.");
        }
    }
}
