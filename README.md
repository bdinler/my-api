<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


## Kurulum

Gereklilikler:

[PHP 7.3+](https://www.google.com/search?client=opera&q=php+7+install&sourceid=opera&ie=UTF-8&oe=UTF-8) ve [composer](https://getcomposer.org).

```sh
git clone https://github.com/bdinler/my-api.git
cd my-api
composer install
// .env.example dosyasının adını .env olarak düzenleyiniz
// .env dosyasını veritabanı ayarlarınıza göre değiştiriniz
php artisan key:generate
php artisan migrate --seed
php artisan serve
```


<h3>Mimari Hakkında:</h3>
<hr>
<p><b style="background: #0A7BBB; padding:4px; border-radius: 5px;">Repository - Service</b> klasörleri altında ana Repository ve Service yapıları mevcuttur. Service-Repository ile işlemler gerçekleştirilir. Controller da ise sadece servis ile iletişim söz konusudur.</p>
<p><b style="background: #ef600e; padding:4px; border-radius: 5px;">Trait</b> yapılarında her yerde default kullanılabilecek, tekrarı engelleyen methodlar tanımlanmıştır. Örn: Cache ve error mesajları için tanımlamalar yapılmıştır. 
<a target="_blank" href="https://github.com/bdinler/my-api/blob/main/app/Traits/Responder.php">[bkz]</a></p>
<p><b style="background: #ef600e; padding:4px; border-radius: 5px;">Middleware</b> klasöründe yer alan ApiToken middleware ile OAuth mantığında bir Auth işlemi gerçekleştirilir ve istenilen route yapılarına tanımlanabilir. 
<a target="_blank" href="https://github.com/bdinler/my-api/blob/main/app/Http/Middleware/ApiToken.php">[bkz]</a></p>
<p><b style="background: #EF3B2D; padding:4px; border-radius: 5px;">Requests</b> klasörü altında validation işlemleri için FormRequest yapısı oluşturulmuştur. 
<a target="_blank" href="https://github.com/bdinler/my-api/tree/main/app/Http/Requests">[bkz]</a></p>
<p><b>Seeder</b> yapısı kullanılarak User, Promotion Codes, Wallet datalar oluşturulmuştur. 
<a target="_blank" href="https://github.com/bdinler/my-api/blob/main/database/seeders/DatabaseSeeder.php">[bkz]</a></p>
<p><b>Postman</b> collection eklenmiştir. 
<a target="_blank" href="https://github.com/bdinler/my-api/blob/main/monotech_api.postman_collection.json">[bkz]</a>

