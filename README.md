# Blog Application

Bu proje, Laravel kullanılarak oluşturulmuş basit bir blog CRUD (Create, Read, Update, Delete) uygulamasıdır. Uygulama, kullanıcıların kayıt olup giriş yapabileceği, blog gönderileri oluşturabileceği, düzenleyebileceği ve silebileceği işlevleri içerir. Ayrıca, kullanıcılar belirli kategoriler altında blog gönderilerini listeleyebilir ve abonelik işlevi ile yeni gönderiler hakkında bilgilendirilebilirler.

## Gereksinimler

- Docker ve Docker Compose
- Laravel Sail (Laravel için Docker ortamı)

## Kurulum
Projeyi klonlayın:

   git clone https://github.com/GamzeBerberogl/blog-site-laravel/
   cd blog-site-laravel

Docker konteynerlerini başlatmak için Sail'i kullanarak bağımlılıkları yükleyin:
./vendor/bin/sail build
./vendor/bin/sail up -d

Çevre değişkenlerini ayarlayın:
cp .env.example .env

## .env: 
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME="laravelblogtestmail@gmail.com"
MAIL_PASSWORD="dtjksmkvonejhcff"
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=laravelblogtestmail@gmail.com
MAIL_FROM_NAME="${APP_NAME}"


./vendor/bin/sail artisan key:generate

Veritabanını migrate edin ve seed edin:
./vendor/bin/sail artisan migrate --seed


./vendor/bin/sail npm install
./vendor/bin/sail npm run dev

## Kullanım

Tarayıcınızı açarak http://localhost adresine gidin.

Yeni kullanıcılar kaydolabilir ve giriş yapabilir.

Yeni gönderiler oluşturabilir, düzenleyebilir ve silebilirsiniz.

Kategorilere göre gönderileri listeleyebilirsiniz.

Ana sayfada abone olma formunu kullanarak yeni gönderiler hakkında bildirim alabilirsiniz.

## Testler

Projenin düzgün çalıştığını doğrulamak için bazı testler yazılmıştır. Testleri çalıştırmak için aşağıdaki komutları kullanabilirsiniz:

Test ortamını başlatın:
./vendor/bin/sail artisan test


