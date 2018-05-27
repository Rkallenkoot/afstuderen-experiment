select * from `publishers` where `id` = 1 limit 1;
select * from `books` where `books`.`publisher_id` in (1);
