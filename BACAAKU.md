#### **English version:** [HERE](https://github.com/bimaalbertus/libravel-2/blob/school/README.md)

📚 Dokumentasi Libravel 📚
==========================

🧐 Apa itu Libravel?
--------------------

Libravel adalah aplikasi manajemen perpustakaan berbasis Laravel yang dirancang untuk mempermudah pengelolaan buku, pengguna, dan pengunduhan. Dengan Libravel, Anda dapat mengelola perpustakaan Anda secara efisien, menggunakan berbagai fitur bawaan untuk membuat proses ini berjalan lancar. 🚀

Aplikasi ini dilengkapi dengan antarmuka yang ramah pengguna dan serangkaian alat untuk mempercepat pengelolaan data perpustakaan, mulai dari katalog buku baru hingga memantau status pengunduhan. Libravel sangat cocok untuk perpustakaan kecil hingga menengah yang membutuhkan sistem berbasis web yang mudah digunakan untuk mengelola operasional mereka.

🔧 Kompatibilitas Server
------------------------

Libravel dapat dipasang di berbagai lingkungan server. Berikut adalah beberapa opsi server yang kompatibel:

*   🖥️ **Laragon:** Platform pengembangan lokal yang sangat disarankan untuk pengaturan cepat dan pengembangan yang mudah.
*   🐑 **Herd:** Alternatif ringan dan cepat untuk pengembangan lokal, sempurna untuk proyek kecil hingga menengah.
*   🌐 **Nginx:** Ideal untuk produksi dan pengembangan berskala besar dengan optimasi tinggi.
*   🔒 **Apache:** Server web yang banyak digunakan untuk lingkungan produksi, stabil, dan mudah dikonfigurasi.

**Catatan:** Pilih server yang paling sesuai dengan kebutuhan pengembangan atau produksi Anda. 🛠️

💻 Menyiapkan Libravel dengan Laragon
-------------------------------------

### 1\. 🧑‍💻 Clone Repository

Mulailah dengan meng-clone repository ke mesin lokal Anda. Jalankan perintah berikut di terminal Anda:

    git clone -b school https://github.com/bimaalbertus/libravel-2/

atau

    git clone -b school git@github.com:bimaalbertus/libravel-2.git

### 2\. 🔧 Setup dengan Laragon

Laragon sangat disarankan untuk pengembangan lokal karena kemudahan penggunaannya. Ikuti langkah-langkah berikut untuk menyiapkan proyek:

1.  📥 **Unduh dan Install Laragon:** Kunjungi [laragon.org](https://laragon.org/) dan unduh installer untuk sistem operasi Anda.
2.  📂 **Pindahkan Folder Proyek:** Setelah meng-clone repository, pindahkan folder proyek ke dalam direktori `www` di instalasi Laragon Anda.
3.  🚀 **Instal Dependensi:** Buka terminal Laragon, navigasikan ke direktori proyek, dan jalankan `composer install` untuk menginstal semua dependensi PHP yang diperlukan.
4.  ⚙️ **Instal Libravel:** Jalankan perintah `php artisan libravel:install` untuk mengonfigurasi aplikasi.
5.  🌍 **Setel URL Aplikasi:** Perbarui nilai `APP_URL` dalam file `.env` untuk mencocokkan pengaturan Laragon Anda (misalnya, `http://libravel.test`).
6.  🗃️ **Jalankan Migrasi dan Seeder:** Jalankan `php artisan migrate` (atau `php artisan migrate:fresh`) diikuti dengan `php artisan db:seed` untuk menyiapkan database dan menambahkan data awal.
7.  ⚡ **Kompilasi Aset:** Untuk membangun aset, jalankan `npm run build`. Untuk pengembangan, gunakan `npm run dev` untuk memantau perubahan secara langsung.

### ⚠️ Memperbaiki Error Upload File

Jika Anda menemui error "Trying to access array offset on null" saat mengunggah file, ini sering disebabkan oleh konfigurasi `upload_tmp_dir` yang salah dalam file `php.ini` Anda.

Ikuti langkah-langkah berikut untuk memperbaikinya:

#### 🖥️ Untuk Laragon:

1.  🔍 **Buka File php.ini:** Cari file `php.ini` yang digunakan oleh Laragon. Anda dapat menemukannya dengan menjalankan `php --ini` di terminal Laragon.
2.  🔑 **Edit Konfigurasi:** Cari baris `;upload_tmp_dir =`, hapus tanda titik koma `;`, dan tentukan direktori sementara yang valid (misalnya `upload_tmp_dir = "C:\laragon\tmp"`).
3.  🔄 **Restart Laragon:** Setelah menyimpan perubahan, restart semua layanan Laragon untuk menerapkan konfigurasi baru.

Dengan konfigurasi yang benar, masalah tersebut seharusnya teratasi. 🎉

🐑 Menyiapkan Libravel dengan Herd
----------------------------------

### 1\. 🧑‍💻 Clone Repository

Gunakan perintah berikut untuk meng-clone repository:

    git clone -b school https://github.com/bimaalbertus/libravel-2/

atau

    git clone -b school git@github.com:bimaalbertus/libravel-2.git

### 2\. 🔧 Setup dengan Herd

Herd adalah alternatif cepat dan ringan untuk pengembangan lokal. Ikuti langkah-langkah berikut untuk menyiapkan proyek:

1.  📥 **Unduh dan Install Herd:** Kunjungi [herd.laravel.com](https://herd.laravel.com/) untuk mengunduh dan mengikuti petunjuk instalasi Herd.
2.  📂 **Pindahkan Folder Proyek:** Pindahkan folder proyek yang sudah di-clone ke dalam direktori yang ditentukan oleh Herd (biasanya di `~/Herd`).
3.  🚀 **Instal Dependensi:** Buka terminal, navigasikan ke direktori proyek, dan jalankan `composer install` untuk menginstal dependensi yang dibutuhkan.
4.  ⚙️ **Instal Libravel:** Jalankan perintah `php artisan libravel:install` untuk mengonfigurasi aplikasi. Herd akan secara otomatis mendeteksi proyek dan membuat virtual host untuknya.
5.  🌍 **Setel URL Aplikasi:** Pastikan nilai `APP_URL` dalam file `.env` sesuai dengan domain yang dikonfigurasi oleh Herd (misalnya, `http://libravel.test`).
6.  🗃️ **Jalankan Migrasi dan Seeder:** Jalankan `php artisan migrate` diikuti dengan `php artisan db:seed` untuk menyiapkan database dan menambahkan data awal.
7.  ⚡ **Kompilasi Aset:** Untuk mengompilasi aset, jalankan `npm run build`, atau gunakan `npm run dev` untuk pengembangan langsung.

### ⚠️ Memperbaiki Error Upload File

Jika Anda menemui masalah serupa dengan Herd, ikuti langkah-langkah berikut untuk memperbaikinya:

#### 🐑 Untuk Herd:

1.  🔍 **Buka File php.ini:** Cari file `php.ini` yang digunakan oleh Herd. Biasanya, terletak di `C:\Users\\.config\herd\bin\php\php.ini`.
2.  🔑 **Edit Konfigurasi:** Hapus tanda titik koma `;` dari baris `upload_tmp_dir` dan tentukan direktori sementara yang valid (misalnya `upload_tmp_dir = "C:\Users\\AppData\Local\Temp"`).
3.  🔄 **Restart Herd:** Setelah melakukan perubahan, restart Herd untuk menerapkan konfigurasi yang baru.

🎉 Selamat, Anda Siap Menggunakan Libravel!
-------------------------------------------

Dengan mengikuti langkah-langkah di atas, Anda harus dapat memulai pengembangan dengan Libravel. Kami harap dokumentasi ini membantu mempercepat proses pengembangan Anda. Jika Anda memiliki pertanyaan lebih lanjut, jangan ragu untuk menghubungi kami! 🚀
