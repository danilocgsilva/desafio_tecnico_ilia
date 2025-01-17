# Pokemon TCG Front

## Configurando o projeto pela primeira vez antes de rodar

Assumo que o usuário do projeto tenha o Docker instalado localmente no computador.

Para configurar a aplicação pela primeira vez, siga os passos:

1. Acesse a pasta `docker`.
2. Copie o arquivo `.sample.env` para um arquivo chamado `.env` na mesma pasta. *Observação*: o arquivo `.env` não será versionado.
3. Escreva no arquivo `.env` os valores para *GIT_USER* e *GIT_EMAIL*. Eles serão necessários para algumas operações de git de dentro do Docker. Mesmo que a aplicação já tenha todos os arquivos e não se planeje fazer alterações de código, este procedimento é importante, pois a receita de Docker depende dessas variáveis pelo menos para ser compilada pela primeira vez.

## Rodando a aplicação

Os passos anteriores precisam ser executados apenas uma vez.

Uma vez feita a configuração, basta seguir os seguintes passos, que serão necessários relaizar toda vez que se desejar levantar a aplicação:

1. Se certifique de que está dentro da pasta `docker`
2. Roda os seguintes comandos:
```
docker compose up -d --build
```