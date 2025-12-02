#!/bin/bash

# Script para ajustar os limites de upload do PHP no sistema
# Execute com: sudo ./fix-php-limits.sh

PHP_INI="/etc/php/php.ini"

if [ ! -f "$PHP_INI" ]; then
    echo "Erro: php.ini não encontrado em $PHP_INI"
    exit 1
fi

echo "Ajustando limites no $PHP_INI..."

# Backup do php.ini original
sudo cp "$PHP_INI" "$PHP_INI.backup.$(date +%Y%m%d_%H%M%S)"

# Ajusta upload_max_filesize
sudo sed -i 's/^upload_max_filesize = .*/upload_max_filesize = 100M/' "$PHP_INI"
sudo sed -i 's/^;upload_max_filesize = .*/upload_max_filesize = 100M/' "$PHP_INI"

# Ajusta post_max_size
sudo sed -i 's/^post_max_size = .*/post_max_size = 100M/' "$PHP_INI"
sudo sed -i 's/^;post_max_size = .*/post_max_size = 100M/' "$PHP_INI"

# Ajusta memory_limit
sudo sed -i 's/^memory_limit = .*/memory_limit = 512M/' "$PHP_INI"
sudo sed -i 's/^;memory_limit = .*/memory_limit = 512M/' "$PHP_INI"

# Se não existir, adiciona no final
if ! grep -q "^upload_max_filesize" "$PHP_INI"; then
    echo "" | sudo tee -a "$PHP_INI"
    echo "upload_max_filesize = 100M" | sudo tee -a "$PHP_INI"
fi

if ! grep -q "^post_max_size" "$PHP_INI"; then
    echo "post_max_size = 100M" | sudo tee -a "$PHP_INI"
fi

echo ""
echo "Limites ajustados com sucesso!"
echo ""
echo "Valores configurados:"
grep -E "^upload_max_filesize|^post_max_size|^memory_limit" "$PHP_INI" | grep -v "^;"
echo ""
echo "IMPORTANTE: Reinicie o servidor PHP (php artisan serve) para aplicar as mudanças!"
echo ""

