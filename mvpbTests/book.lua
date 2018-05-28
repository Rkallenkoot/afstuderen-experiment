function event(thread_id)
   rs = db_query("SELECT * from books limit 15 offset 0")
   rs1 = db_query("select * from book_translations where book_translations.book_id in (1,2,3,4,5,6,7,8,9,10,11,12,13,14,15)")
end
