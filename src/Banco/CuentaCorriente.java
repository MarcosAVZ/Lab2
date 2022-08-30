package Banco;
import java.util.Random;
 class CuentaCorriente {
    Random r = new Random();
    private double saldo;
    private String nombreTitular;
    private long numeroCuenta;
    public CuentaCorriente(String nombreTitular, double saldo){
        this.nombreTitular = nombreTitular;
        this.saldo = saldo;
        this.numeroCuenta = r.nextLong(2000);
    }

    public void setSaldo(double saldo) {
        this.saldo = saldo;
    }
    public double getSaldo() {
        return saldo;
    }
    public String toString(){
        return "\nTirular de la Cuenta: " + nombreTitular + "\nSaldo: " + getSaldo() + "\nNumero de la cuenta: " + numeroCuenta ;
    }
    public void transferencia(CuentaCorriente cuentaCorriente,CuentaCorriente cuentaCorriente2 ){
         cuentaCorriente.setSaldo(cuentaCorriente.getSaldo() - 2500);
         cuentaCorriente2.setSaldo(cuentaCorriente2.getSaldo() + 2500);
    }
}
 class usoCuenta {
     public static void main(String[] args) {
         CuentaCorriente Cliente1 = new CuentaCorriente("Miguel",  12000);
         CuentaCorriente Cliente2 = new CuentaCorriente("Pedro",  0);
         System.out.println(Cliente1.toString());
         System.out.println(Cliente2.toString());
         Cliente1.transferencia(Cliente1,Cliente2);
         System.out.println("--------------------------------------------------------------");
         System.out.println(Cliente1.toString());
         System.out.println(Cliente2.toString());

     }


 }
