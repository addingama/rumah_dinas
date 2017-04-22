## Penyewaan Rumah Dinas

Aplikasi penyewaan rumah dinas dengan fitur-fitur sebagai berikut:

- Terintegrasi
- Report generated
- Easy to use


## Requirements

Untuk melakukan instalasi, pastikan software-software tersebut telah terinstall:

- PHP >= 5.6.4
- OpenSSL PHP Extension
- PDO PHP Extension
- MBString PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- MySQL
- Composer

Untuk melakukan pemeriksaan extension, buka terminal / command prompt dan ketik `php -m`


## Instalasi

- Clone repository atau download source code
- Jalankan perintah `composer install` untuk mengunduh dependensi library
- Buat database dengan nama `rumah_dinas`, nama database dapat disesuaikan
- Copy file `.env-example` menjadi `.env`
- Update data terkait database yang ingin digunakan
- Jalankan perintah `php artisan key:generate`
- Jalankan perintah `php artisan migrate`, ini untuk membuat tabel yang dibutuhkan
- Jalankan perintah `php artisan db:seed`, ini untuk mengisi tabel dengan default data


## Akses

Untuk mengakses web yang telah dibuat, dapat menggunakan Virtual host yang pointing ke folder public,
 atau menggunakan command `php artisan serve` dan membuka browser dengan url `localhost:8000`. 
 
 Pastikan anda mengeksekusi commands tersebut melalui terminal dan sedang berada pada root directory project.
