# Marketplace  

 Neste repositório está o code challenge: Marketplace em php

 ## Requisitos  necessários 

  É necessário  instalado  os seguintes itens  :

 > PHP 7.4 
 >
 > Composer 
 >
 > Banco de dados PostgreSQL


 ## Como executar o projeto 

  1. Primeiro realize a clonagem para sua máquina do repositório [marketplace](https://github.com/themarcosramos/marketplace) .

  2. Realize  a restauração do  [banco  de dados](https://github.com/themarcosramos/marketplace/blob/main/backup_marketplace.sql). 

  3. Acesse  o seguinte :

   ``` 
     marketplace/source/Boot/Config.php
   ```
    
   e nas linhas informe  alguns dados importantes para execução do  projeto 

 *  10 dentro da  =>  ‘ ’ o nome do seu  banco de dados.

 *  11 dentro da =>  ‘ ’  o nome do usuário do banco de dados .

 *  12 dentro da  => ‘ ’  o nome do a senha do banco de dados .

  4. Após isso se desloque pelo terminal isso na pasta raiz do projeto e execute o seguinte : 


   ``` 
    composer install
   ```

 5. Após isso ainda pasta raiz do projetoe execute o seguinte para incicar o sevidor  do php 

   ``` 
    php -S localhost:8080
   ```
 Depois de seguir o passo a passo é só acessar seu navegador com o [endereço localhost:8080 ](http://localhost:8080/). 

 ------------------------------------------------------------------------------------------------------
  