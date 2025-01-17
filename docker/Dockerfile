FROM php:8.4.2-bookworm

ARG GIT_USER
ARG GIT_EMAIL

# Instalação do composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

# Instalação do cli do Symfony para automatizar algumas tarefas do desenvolvimento.
RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

# Instalação do node, já que quero compilar o frontend com o Encore.
RUN curl -sL https://deb.nodesource.com/setup_20.x | bash - 
RUN apt-get install -y nodejs

# Instalação de utilitários que serão utilizados dentro do container
RUN apt-get install vim git -y

# Configuração local do git, necessário para a instalação do Symfony e
#   para operaçẽos com git de dentro do container
RUN git config --global user.email $GIT_EMAIL
RUN git config --global user.name $GIT_USER
RUN git config --global --add safe.directory /app

# Comando para "segurar" o docker durante o desenvolvimento.
CMD while : ; do sleep 1000; done
