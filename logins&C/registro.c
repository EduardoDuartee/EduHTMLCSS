#include <stdio.h>
#include <stdbool.h>
#include <stdlib.h>
#include <string.h>
#include <time.h>

char Destino[30];
char horario[30];
char empresa[30];
 
int escolhaDestino;
int escolhaHorario;
int escolhaEmpresa;

float pagamento;



void registro()
{

   printf("================================");
    printf("\nAeroporto De Uma Cidade Qualquer");
    printf("\n================================");

    printf("\nQual e o Seu Destino?");
    printf("\n1 - Bahia");
    printf("\n2 - Minas-Gerais");
    printf("\n3 - Mato-Grosso");
    printf("\n4 - Santa-Catarina");
    printf("\n5 - Acre\nOpcao: ");
    scanf("%d", &escolhaDestino);


    if (escolhaDestino == 1) {
        strcpy(Destino, "Bahia");
    } //bahia
    
    else if (escolhaDestino == 2) {
        strcpy(Destino, "Minas-Gerais");
    }//MinasGerais

    else if (escolhaDestino == 3) {
        strcpy(Destino, "Mato-Grosso");
    }//Matogrosso

    else if (escolhaDestino == 4) {
        strcpy(Destino, "Santa-Catarina");
    } //santaCatarina

    else if (escolhaDestino == 5) {
        strcpy(Destino, "Acre");
    }//Acre

    else {
        printf("\nOpcao Invalida!\n");
        return;
    }


    printf("\n=====================");
    printf("%s", Destino);
    printf("\n=====================");

    printf("\n1 - Cocrodile-Poeta");
    printf("\n2 - Pomba-Noclear");
    scanf("%d", &escolhaEmpresa);

// empresa crocodilo-poeta================================

    if (escolhaEmpresa == 1)
    {
        strcpy(empresa, "Crocodile-Poeta");
        printf("\nVoos Disponiveis:");
        printf("\n1 -  09:00h");
        printf("\n2 - 21:00h");
        scanf("%d", &escolhaHorario);

        if (escolhaHorario == 1)
        {
            strcpy(horario, "09:00");
            printf("valor das Passagem 1200.00");
            pagamento = 1.200;
            
        }

        else if(escolhaHorario == 2)
        {
            strcpy(horario, "21:00");
            printf("valor das Passagem 1350.00");
            pagamento = 1.350;
        }
    }

// empresa Pomba nuclear================================
    else if (escolhaEmpresa ==2)
    {
        strcpy(empresa, "Pomba-Nuclear");

        printf("\nVoos Disponiveis:");
        printf("\n1 -  09:00h");
        printf("\n2 - 21:00h");
        scanf("%d", &escolhaHorario);

        if (escolhaHorario == 1)
        {
            strcpy(horario, "21:00");
            printf("valor das Passagem 1150.00");
            pagamento = 1.350;
            
        }
        else if(escolhaHorario == 2)
        {
            strcpy(horario, "09:00");
            printf("valor das Passagem 1450.00");
            pagamento = 1.350;
        }
    }

   


    
    printf("\n=========================");
    // printf("\nCodigo de Voo: %d", codigoVoo);
    printf("\nDestino: %s", Destino);
    printf("\nEmpresa: %s", empresa);
    printf("\nEmbarque: %sh", horario);
    printf("\nValor: %.3fR$", pagamento);
    printf("\n=========================");

}