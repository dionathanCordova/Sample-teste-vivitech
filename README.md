# Sample-teste-vivitech



<br>

<H1>Uma aplicação teste. </H1>

<p>Para iniciar a aplicação seguir os passos abaixo:</o>
<p>1 - Clonar este repositório</o>
<p>2 - Após clonar, no terminal acesse o diretorio "sample_teste" que esta dentro do arquivo clonado</o>
<p>3 - Apos isso, deve-se configurar a conexão ao banco de dados como o nome de administrador e senha no arquivo ".env" que está no diretório raiz do projeto</o>
<p>4 - Na linha 27: alterar as configurações de acesso ao DB, conforme sua maquina está configurada "DATABASE_URL=mysql://username:password@127.0.0.1:3306/nomeDoBanco"</o>
<p>5 - Execute o comando "composer install", com este comando todas as dependências necessáras são instaladas.</p>
<p>6 - Ative seu servidor de banco de dados local ex: "XAMP / WAMP"</p>
<p>7 - Execute o comando "php bin/console doctrine:database:create", isso fará que o banco de dados seja criado na sua maquina</p>
<p>8 - Execute o comando "php bin/console doctrine:migrations:migrate", isso fará que a classe do ENTITY seja executada, então são criadas as tabelas</p>
<p>9 - A seguinte mensagem será apresentada no terminal "WARNING! You are about to execute a database migration that could result in schema changes and data loss. Are you sure you wish to continue? (y/n)", apenas digite "y" e depois a tecla "ENTER"</p>
<p>10 - Execute o comando "php -S localhost:8080 -t public", este comando executará o servidor interno do php</p>
<p>11 - Acesse no navegor o endereço http://localhost:8080/</p>


<p>Obrigado pela oportunidade de participar deste Teste. </p>