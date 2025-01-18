# Pokemon TCG Symfony

## Configurando o projeto pela primeira vez antes de rodar

Assumo que o usuário do projeto tenha o Docker instalado localmente no computador.

Para configurar a aplicação pela primeira vez, siga os passos:

1. Acesse a pasta `docker`.
2. Copie o arquivo `.sample.env` para um arquivo chamado `.env` na mesma pasta. *Observação*: o arquivo `.env` não será versionado.
3. Escreva no arquivo `.env` os valores para *GIT_USER* e *GIT_EMAIL*. Eles serão necessários para algumas operações de git de dentro do Docker. Mesmo que a aplicação já tenha todos os arquivos e não se planeje fazer alterações de código, este procedimento é importante, pois a receita de Docker depende dessas variáveis, pelo menos para ser compilada pela primeira vez.

## Rodando a aplicação

Os passos anteriores precisam ser executados apenas uma vez.

Uma vez feita a configuração, basta seguir os seguintes passos, que serão necessários realizar toda vez que se desejar levantar a aplicação:

1. Se certifique de que está dentro da pasta `docker`
2. Roda o comando:
```
docker compose up --build
```
Aguarde um tempo para a compilação do container, da aplicação Symfony e do Node.

## Acessando a aplicação

Depois de rodar o comando `docker compose up --build`, aguardar e perceber que a aplicação já está sendo servida, pode acessá-la normalmente. Se trata de uma aplicação de desenvolvimento levantada e servida na porta 8000, no ip 0.0.0.0. Com isso, é possível acessar no ambiente de host pelo endereço localhost ou 0.0.0.0, na porta 8000:
```
http://localhost:8000
```

## Descrição do que foi feito

Os commits foram criados de forma a facilitar a avaliação e o entendimento da evolução do projeto. Mas segue a minha descrição do que foi feito:

* De modo a facilitar e simplificar o máximo possível o levantamento do ambiente, baseei o desenvolvimento totalmente em uma receita de Docker. As configurações estão todas disponíveis dentro da pasta `docker` da raiz do projeto.

* Depois de seguir os [passos de como se levantar a aplicação pela primeira vez](#Configurando-o-projeto-pela-primeira-vez-antes-de-rodar), basta entrar na pasta do docker e executar o comando típico de docker para levantar o ambiente: `docker compose up --build`. A receita se baseia em uma imagem de PHP 8.4, em que depois de utilizar a imagem, ainda preciso configurar variáveis de ambiente para configurar o git dentro do container (necessário para a instalação da aplicação com o Composer), instalação do próprio composer, instalação da aplicação de linha de comando do Symfony, instalação e ativação do xdebug, que utilizei em alguns momentos durante o desenvolvimento, instalo o Nodejs, para compilar os assets de frontend, incluindo o Bootstrap, Encore e recursos de HMR, instalo o giz e o zip, também necessários para a instalação do projeto, configura o xdebug e por final copio e executo um arquivo shell para fazer alguns passos adicionais, depois da compilação da imagem do Docker e da montagem do volume. Tudo isso pode ser visto no arquivo `Dockerfile`.

* Já o arquivo `startup.sh`, que é executado como último passo da receita de Docker, é responsável por instalar e rodar o servidor de desenvolvimento tanto do Encore (para os assets de frontend), quando o próprio servidor Symfony contendo o desafio pedido. Depois dos servidores estarem sendo servidos, basta acessar a aplicação pelo http://localhost:8000, no computador local.

* A apĺicação Symfony cria uma página com todas as cartas de pokemons disponíveis na api do exercício, sendo que cada carta é o link para acessar outra action da Controller, para ver detalhes individuais da carta do pokemon.

* Como não houve exigência sobre os recursos de frontend para a apresentação do projeto, decidi servir as páginas com Bootstrap compilado localmente, juntamente com o Encore. Apesar de ser um exercício de backend, tentei deixar o projeto suficientemente apresentável, utilizando recursos como listagem e cards do Bootstrap, realizando estilizações com o flexbox e aplicando pseudoclasses para melhorar a experiência do usuário.

* Foi necessário criar apenas uma única controller, contendo a action de redirecionamento para a listagem de pokemons, outra para a listagem de pokemons e outra para acessar os detalhes da carta, buscando pelo id do pokemon.

* Para seguir as boas práticas, mantive as controllers limpas, sempre fazendo injeção de dependência do repositório pelo service container.

* O repositório é o serviço que eu criei que é o responsável por acessar a api e buscar as informações, tanto para a listagem quanto para a carta de pokemon individual. O repositório utiliza o `Guzzle\Client` para fazer a busca dos dados da api e foi necessário também configurá-lo como um serviço, não só para permitir a injeção de dependência como também para se poder mocar o Guzzle nos testes unitários dentro do service container e poder fazer os testes sem precisar acessara a api real.

* Criei um mapper e classes de dados para facilitarem a *tradução* dos dados buscados pela API e os dados necessários a serem utilizados dentro dos templatea de Twig.

* Foram criados testes unitários para testar os endpoints servindo as páginas e testando todos os métodos dos serviços criados.
