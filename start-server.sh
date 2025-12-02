#!/bin/bash

# Script para iniciar o servidor Laravel com limites de upload aumentados
# Este script tenta usar um php.ini customizado ou ajustar os limites

echo "Iniciando servidor Laravel com limites de upload aumentados..."

# Tenta encontrar o php.ini do sistema
PHP_INI=$(php --ini | grep "Loaded Configuration File" | awk '{print $4}')

if [ -z "$PHP_INI" ]; then
    PHP_INI=$(php -i | grep "Loaded Configuration File" | awk '{print $4}')
fi

if [ -n "$PHP_INI" ] && [ -f "$PHP_INI" ]; then
    echo "PHP.ini encontrado: $PHP_INI"
    echo "Por favor, ajuste manualmente:"
    echo "  upload_max_filesize = 100M"
    echo "  post_max_size = 100M"
    echo ""
    echo "Ou execute como root:"
    echo "  sudo sed -i 's/upload_max_filesize = .*/upload_max_filesize = 100M/' $PHP_INI"
    echo "  sudo sed -i 's/post_max_size = .*/post_max_size = 100M/' $PHP_INI"
    echo ""
fi

# Tenta usar php.ini local se existir
if [ -f "php.ini" ]; then
    echo "Usando php.ini local do projeto..."
    php -c php.ini artisan serve
else
    echo "Iniciando servidor (ajuste o php.ini do sistema se os limites ainda estiverem baixos)..."
    php artisan serve
fi

