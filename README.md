# Asia's Art 🎨

## 🏞 Application View

You can see view of the application: [Asia's Art](https://lushprojects.github.io/asia/asia.html)

---

## 📖 About project

* Portfolio application in Symfony allowing to manage the website
* A non-logged-in user can view the paintings and register to use the full features of the site.
* After logging in, the user can reserve the selected image. Only to him will be made available links to acquire the item.
* If a user actually buys an item, the administrator will allow him to add a review about the purchased item.
* Admin can fully operate on categories and items using the convenient admin panel. 

## 🛠 Technologies used in the project
**🍊 Frontend**

- HTML/Twig 🌱

- CSS 🔵

- JS 🟡

**🍑 Backend**

- Symfony 6 (PHP) 🐘

- SQLite 🐬


## ⚙️ Setup

After cloning the repository you need to install composer:

```
composer install
```

## 📙 Database setup

The SQLite database was used for the project.
To build the databasem execute the migrations and load example fixtures, type in your terminal:
```
    bin/console doctrine:database:create
    bin/console doctrine:migrations:migrate
    bin/console doctrine:fixtures:load
```

## 🖥️ Start server

To start your web server type:

```
    symfony serve -d
```

## ⚙️ Configuration on website

After the server has started, you can log in with admin account:
- email: `admin@admin.com` with password `admin`

- or go to `/register` and create user!

❗ **Remember** only admin can use `/admin` page

### ✍️ Author

*Radosław Bujny*
