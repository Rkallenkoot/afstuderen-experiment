function event(thread_id)
   rs = db_query("SELECT * from books where id = 1 limit 1")
   rs1 = db_query("select * from book_translations where book_translations.book_id in (1)")
end
