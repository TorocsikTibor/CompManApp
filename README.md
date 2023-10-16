Telepítés:
1. Applikáció beszerzése Github-ról.
2. 'composer install' parancs végrehajtása a parancssor-ban.
3. env fájl létrehozása a 'coy .env.example .env' paranccsal.
4. "app key" generálása 'php artisan key:generate' paranccsal.
5. Fejlesztői környezet indítása például Laragon vagy XAMPP.
6. MySQL adatbázis neve 'compmanapp'.
7. 'php artisan migrate:fresh --seed' parancs futtatása a parancssorban.
8. 'npm run dev' futtatása parancssorban.

   Használat:
  Bejelentkezés / Regisztráció / Kijelentkezés
	-Előre feltöltött felhasználók:
		Admin:
					email: admin@test.com
					jelszó: 123
		User:
					email: user@test.com
					jelszó: 123

   Csak az admin tud létrehozni új versenyeket, köröket és versenyzőket. Teszt futtatásához "php artisan test" parancsot kell futtatni.

   
