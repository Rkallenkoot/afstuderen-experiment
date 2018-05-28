function event(thread_id)
  rs = db_query("select * from categories where id = 21 limit 1")
  rs1 = db_query("select books.*, book_category.category_id as pivot_category_id, book_category.book_id as pivot_book_id from books inner join book_category on books.id = book_category.book_id where book_category.category_id in (21)")
end
