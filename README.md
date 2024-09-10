php version - 8.1.29
laravel version - 10.48.20

copy .env.example, change database name, run docker-compose up -d

for fake data use 
php artisan tinker
Seller::factory()->count(n)->hasAttached(Product::factory->count(m))->create()
n,m - numbers of created rows
