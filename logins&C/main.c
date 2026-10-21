#include <stdio.h>
#include <stdbool.h>
#include <stdlib.h>
#include "registro.c"
#include "aeroporto.c"
 int escolhaMenu;
void main ()
{
    printf("================================");
    printf("\nAeroporto De Uma Cidade Qualquer");
    printf("\n================================");

    printf("\n1 - Administração");
    printf("\n2 - Registro");
    printf("\n0 - Encerrar Sistema");
    scanf("%d", &escolhaMenu);

    switch (escolhaMenu)
    {
        case 1:
            aeroporto();
        break;

        case 2:
            registro();
        break;
    
        case 0:
            printf("================================");
            printf("\n      Sistema encerrado         ");
            printf("\n================================");
        break;
    default:
        break;
    }
}