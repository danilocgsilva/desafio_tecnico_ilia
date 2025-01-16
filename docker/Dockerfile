FROM php:8.4.2-bookworm

# Instalação do composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

# Instalação do cli do Symfony para automatizar algumas tarefas do desenvolvimento.
RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

# Comando para "segurar" o docker durante o desenvolvimento.
CMD while : ; do sleep 1000; done
