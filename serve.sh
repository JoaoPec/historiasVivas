#!/bin/bash

# Script para iniciar o servidor Laravel com limites de upload aumentados
# Usa parâmetros -d do PHP para definir os limites sem precisar alterar o php.ini

echo "Iniciando servidor Laravel com limites aumentados..."
echo "upload_max_filesize: 100M"
echo "post_max_size: 100M"
echo ""

php -d upload_max_filesize=100M \
    -d post_max_size=100M \
    -d memory_limit=512M \
    -d max_execution_time=600 \
    -d max_input_time=600 \
    artisan serve

