### Load Eager & Filter function
$category->load('books') => mengambil semua data buku dalam kategori (bisa membuat $category->books->count())
$category->loadCount('books') => mengambil totoal data buku dalam kategori (laravel otomatis buat $category->books_count)

Jika hanya ingin membaca data relasi → gunakan load() atau with().
Jika ingin melakukan filter, sorting, atau pagination pada relasi → gunakan relationship() (dengan tanda kurung), misalnya books().

### Function Filter Searching
Contoh:
$query = Book::with('category')->where('stok', '>', 0);                 <- Karena di awal udah ada "where()" atau ada filter lain
                                                                                        Maka |
       if ($request->filled('search')) {                                                     v
           $query->where(function ($q) use ($request) {                 <- WAJIB PAKAI function / Grouping
               $q->where('judul', 'like', "%{$request->search}%")
                   ->orWhere('penulis', 'like', "%{$request->search}%")
                   ->orWhere('penerbit', 'like', "%{$request->search}%");
           });
       }
       if ($request->filled('category')) {                              <- INI CONTOH FILTER LAIN
            $query->where('category_id', $request->category);
        }

### PUT / PATCH
Sama-sama untuk update data namun:
PUT = mengubah suatu data secara keseluruhan (contoh: mengubah nama, no.telp, alamat, dll)
PATCH = mengubah satu data / data tunggal saja (contoh: saat klik suatu tombol maka hanya update status yang awalnya false jadi true)

### Function exists()
digunakan hanya untuk menentukan kondisi true / false. Function exists() mengeluarkan nilai boolean (true / false)

### Notifications (iluminate/support/facades)
Notification::send() -> mengirim notif utk lebih dari 1 user
notify() -> mengirim notif hanya utk 1 user