# Dinner Hall

Bu proje bir yemek salonu'nun turnikileri'nin kontrolü amacıyla geliştirilmiştir.

Aşağıdaki adımları takip ederek projeyi başlatabilirsiniz.

## Başlangıç

### Önkoşullar

- [Composer](https://getcomposer.org) yüklü olmalıdır.
- [Docker](https://www.docker.com/) yüklü olmalıdır.

### Kurulum

1. Projeyi klonlayın:

   ```sh
   git clone https://github.com/FurkanKuyular/dinner-hall.git
2. Composer ile gerekli bağımlılıkları yükleyin:
    ```sh
   composer install
3. env-example dosyasını .env olarak kopyalayabilirsiniz.
    ```sh 
   cp .env-example .env
4. Laravel Sail ile docker konteynerlerini başlatın:
    ```sh
   ./vendor/bin/sail up
5. Migrationları çalıştırın:
    ```sh
   ./vendor/bin/sail artisan migrate

### Testler
1. Eğer test sınıflarını çalıştırmak istiyorsanız, aşağıdaki komutu kullanabilirsiniz:
    ```sh
   ./vendor/bin/sail artisan test --testsuite=Feature --stop-on-failure
   
### Postman Collection
Proje için case içerisinde sunulan Postman Collection dosyasını kullanarak API'yi test etmek için aşağıdaki adımları izleyin:

1. `sail up` komutu çalıştırıldıktan sonra, proje belirtilen bir port üzerinde çalışmaya başlayacaktır. `Default:8009`
2. Collection içinde bulunan gates endpoint'ini kullanarak, 127.0.0.1:{PORT}/gates adresine istek yapın.

Bu adımları takip ederek projeyi başarıyla çalıştırabilir ve test edebilirsiniz.


