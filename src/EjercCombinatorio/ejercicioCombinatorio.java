package EjercCombinatorio;

public class ejercicioCombinatorio {
    public static void main(String[] args) {
        float num6 = 6;
        float num5 = 5;
        float num2 = 2;
        float num3 = 3;
        float num7 = 7;
        float num30 = 30;
        float num1 = 1;
        float res1 = num6 / num5;
        
        float res2 = num2 / num3;

        float res3 = num7 / num2;

        float res4 = num2 / num30;

        float res5 = res2 * res3;

        float res6 = res1 - res5 + res4;

        float res7 = num1 / num3;

        float res8 = res7 / num5;

        float res9 = res6 / res8;

                System.out.println(res9);
    }
}
