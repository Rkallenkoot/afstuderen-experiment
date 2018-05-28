function event(thread_id)
  rs = db_query("select * from publishers where id = 1 limit 1")
  rs1 = db_query("select * from books where books.publisher_id in (1)")
end
