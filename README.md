#### **Versi Indonesia:** [DISINI](https://github.com/libravelabs/libravel/blob/main/BACAAKU.md)

# 📚 Libravel Documentation 📚

## 🧐 What is Libravel?

Libravel is a Laravel-based library management application designed to simplify the management of books, users, and downloading. With Libravel, you can efficiently manage your library, using a range of built-in features to make the process seamless. 🚀

This application comes with a user-friendly interface and a set of tools to speed up library data management, from cataloging new books to monitoring download statuses. Libravel is ideal for small to medium-sized libraries that require an easy-to-use web-based system for managing their operations.

## 🔧 Server Compatibility

Libravel can be deployed on various server environments. Here are some compatible server options:

-   🖥️ **Laragon:** A local development platform that is highly recommended for quick setup and easy development.
-   🐑 **Herd:** A lightweight and fast alternative for local development, perfect for small to medium-sized projects.
-   🌐 **Nginx:** Ideal for large-scale production and development with high optimization.
-   🔒 **Apache:** A widely used web server for production environments, stable and easy to configure.

**Note:** Choose the server that best fits your development or production needs. 🛠️

## 💻 Setting Up Libravel with Laragon

### 1\. 🧑‍💻 Clone the Repository

Start by cloning the repository to your local machine. Run the following command in your terminal:

    git clone https://github.com/libravelabs/libravel.git

or

    git clone git@github.com:libravelabs/libravel.git

### 2\. 🔧 Setup with Laragon

Laragon is highly recommended for local development due to its ease of use. Follow these steps to set up the project:

1.  📥 **Download and Install Laragon:** Visit [laragon.org](https://laragon.org/) and download the installer for your operating system.
2.  📂 **Move the Project Folder:** After cloning the repository, move the project folder into the `www` directory of your Laragon installation.
3.  🚀 **Install Dependencies:** Open the Laragon terminal, navigate to your project directory, and run `composer install` to install all necessary PHP dependencies.
4.  ⚙️ **Install Libravel:** Run the command `php artisan libravel:install` to configure the application.
5.  🌍 **Set the Application URL:** Update the `APP_URL` value in your `.env` file to match your Laragon setup (e.g., `http://libravel.test`).
6.  🗃️ **Run Migrations and Seeder:** Run `php artisan migrate` (or `php artisan migrate:fresh`) followed by `php artisan db:seed` to set up the database and seed initial data.
7.  ⚡ **Compile Assets:** To build the assets, run `npm run build`. For development, use `npm run dev` to watch for changes live.

### ⚠️ Fixing File Upload Error

If you encounter the "Trying to access array offset on null" error while uploading files, this is often due to an incorrect `upload_tmp_dir` configuration in your `php.ini` file.

Follow these steps to fix it:

#### 🖥️ For Laragon:

1.  🔍 **Open the php.ini File:** Find the `php.ini` file used by Laragon. You can locate it by running `php --ini` in the Laragon terminal.
2.  🔑 **Edit Configuration:** Search for the line `;upload_tmp_dir =`, remove the semicolon `;`, and specify a valid temporary directory (e.g., `upload_tmp_dir = "C:\laragon\tmp"`).
3.  🔄 **Restart Laragon:** After saving the changes, restart all Laragon services to apply the new configuration.

With the correct configuration, the issue should be resolved. 🎉

## 🐑 Setting Up Libravel with Herd

### 1\. 🧑‍💻 Clone the Repository

Use the following command to clone the repository:

    git clone https://github.com/libravelabs/libravel.git

or

    git clone git@github.com:libravelabs/libravel.git

### 2\. 🔧 Setup with Herd

Herd is a fast and lightweight alternative for local development. Follow these steps to set up the project:

1.  📥 **Download and Install Herd:** Visit [herd.laravel.com](https://herd.laravel.com/) to download and follow the installation instructions for Herd.
2.  📂 **Move the Project Folder:** Move the cloned project folder into the directory specified by Herd (usually in `~/Herd`).
3.  🚀 **Install Dependencies:** Open the terminal, navigate to the project directory, and run `composer install` to install the required dependencies.
4.  ⚙️ **Install Libravel:** Run the command `php artisan libravel:install` to configure the application. Herd will automatically detect the project and create a virtual host for it.
5.  🌍 **Set the Application URL:** Ensure the `APP_URL` value in your `.env` file matches the domain configured by Herd (e.g., `http://libravel.test`).
6.  🗃️ **Run Migrations and Seeder:** Run `php artisan migrate` followed by `php artisan db:seed` to set up the database and seed the initial data.
7.  ⚡ **Compile Assets:** To compile the assets, run `npm run build`, or use `npm run dev` for live development.

### ⚠️ Fixing File Upload Error

If you encounter a similar issue with Herd, follow these steps to resolve it:

#### 🐑 For Herd:

1.  🔍 **Open the php.ini File:** Find the `php.ini` file used by Herd. Typically, it is located at `C:\Users\\.config\herd\bin\php\php.ini`.
2.  🔑 **Edit Configuration:** Remove the semicolon `;` from the `upload_tmp_dir` line and specify a valid temporary directory (e.g., `upload_tmp_dir = "C:\Users\\AppData\Local\Temp"`).
3.  🔄 **Restart Herd:** After making changes, restart Herd to apply the updated configuration.

## 🎉 Congratulations, You’re Ready to Use Libravel!

By following the steps above, you should be able to start developing with Libravel. We hope this documentation helps speed up your development process. If you have further questions, feel free to reach out! 🚀
