# Como iniciar o servidor com limites de upload aumentados

## Opção 1: Usar o script serve.sh (RECOMENDADO)

```bash
./serve.sh
```

Este script inicia o servidor com os limites de upload aumentados (100MB) sem precisar alterar o php.ini do sistema.

## Opção 2: Ajustar o php.ini do sistema (permanente)

Execute o script com sudo:

```bash
sudo ./fix-php-limits.sh
```

Depois reinicie o servidor normalmente:

```bash
php artisan serve
```

## Opção 3: Usar diretamente na linha de comando

```bash
php -d upload_max_filesize=100M -d post_max_size=100M artisan serve
```

## Verificar os limites atuais

```bash
php -r "echo 'upload_max_filesize: ' . ini_get('upload_max_filesize') . PHP_EOL; echo 'post_max_size: ' . ini_get('post_max_size') . PHP_EOL;"
```

