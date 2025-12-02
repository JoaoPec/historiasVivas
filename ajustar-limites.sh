#!/bin/bash

echo "Ajustando limites no /etc/php/php.ini..."
echo ""

# Faz backup
sudo cp /etc/php/php.ini /etc/php/php.ini.backup.$(date +%Y%m%d_%H%M%S)

# Ajusta upload_max_filesize
sudo sed -i 's/^upload_max_filesize = .*/upload_max_filesize = 100M/' /etc/php/php.ini
sudo sed -i 's/^;upload_max_filesize = .*/upload_max_filesize = 100M/' /etc/php/php.ini

# Ajusta post_max_size  
sudo sed -i 's/^post_max_size = .*/post_max_size = 100M/' /etc/php/php.ini
sudo sed -i 's/^;post_max_size = .*/post_max_size = 100M/' /etc/php/php.ini

echo "Limites ajustados! Valores configurados:"
grep -E "^upload_max_filesize|^post_max_size" /etc/php/php.ini | grep -v "^;"
echo ""
echo "✅ PRONTO! Agora reinicie o servidor (pare e inicie novamente o ./serve.sh ou php artisan serve)"

