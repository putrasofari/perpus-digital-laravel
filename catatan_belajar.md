### Function controller
$category->load('books') => mengambil semua data buku dalam kategori (bisa membuat $category->books->count())
$category->loadCount('books') => mengambil totoal data buku dalam kategori (laravel otomatis buat $category->books_count)

Jika hanya ingin membaca data relasi → gunakan load() atau with().
Jika ingin melakukan filter, sorting, atau pagination pada relasi → gunakan relationship() (dengan tanda kurung), misalnya books().