package POO;

import org.jetbrains.annotations.NotNull;

public class Banco { public static void main(String[] args) {
    Cliente recurrentes[] = {
            new Cliente("manuel", 44719292,123, 12234),
            new Cliente("migue", 44282939, 125,12334),
    };
    Cliente a1 = new Cliente("migue", 44282939, 125,12334);


    for (Cliente cliente:recurrentes){
        System.out.println(cliente.toString()); }


}
} class Cliente{
    private String nombre;
    private int dNI;
    private int cuenta;
    private double saldo;

    public Cliente(String nombre, int dNI, int cuenta, double saldo){
        this.cuenta = cuenta;
        this.dNI = dNI;
        this.nombre= nombre;
        this.saldo = saldo;
    }

    public double getSaldo() {
        return saldo;
    }

    public void setSaldo(double saldo) {
        this.saldo = saldo;
    }

    public String toString() {
        return "Cliente{" +
                "Nombre='" + nombre + '\'' +
                ", D.N.I=" + dNI +
                ", Cuenta=" + cuenta +
                ", Saldo=" + saldo +
                '}';
    }
}

class  Caja {


    public void depositar(Cliente recurrentes, double monto) {
        recurrentes.setSaldo(recurrentes.getSaldo() + monto);
        System.out.println("Saldo actual: " + recurrentes.getSaldo());
    }

    public void retirar(Cliente recurrentes, double monto) {
        recurrentes.setSaldo(recurrentes.getSaldo() - monto);
        System.out.println("Saldo actual: " + recurrentes.getSaldo());
    }

}