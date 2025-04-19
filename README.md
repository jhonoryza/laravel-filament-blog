# Blog 

- CMS Filament 3
- Front Inertia Vue
- Front Livewire 3

## Req

- laravel 11
- php 8.4
- composer 2
- node 20

## Start

```bash
composer install && npm run build
```

## Restore or Backup DB

to restore or backup db you need to set env `AWS` with suffix `_BACKUP` in `.env.example` file.

### Backup DB

```bash
php artisan backup:run --only-db
```

this will backup current `DB_CONNECTION` to backup disk

### Restore DB

```bash
 php artisan backup:restore --disk=backup --backup=latest --connection=restore --reset --no-interaction;
```
you need to set env `DB` with suffix `_RESTORE`, check in `.env.example` file

this will restore from `backup disk` and reset to `DB_HOST_RESTORE`
