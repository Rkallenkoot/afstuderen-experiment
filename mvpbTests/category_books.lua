function event(thread_id)
  rs = db_query("select * from categories where id = 21 limit 1")
  rs1 = db_query("select * from category_translations where category_translations.category_id in (21)")
  rs2 = db_query("select books.*, book_category.category_id as pivot_category_id, book_category.book_id as pivot_book_id from books inner join book_category on books.id = book_category.book_id where book_category.category_id in (21)")
  rs3 = db_query("select * from book_translations where book_translations.book_id in (9,734,881,1370,1389,1396,1436,1754,2078,2082,2427,2525,2564,2662,2963,2999,3190,3194,3348,3469,3663,3690,4228,4295,4473,5072,5107,5551,5598,5694,6112,6139,6521,6637,6988,7344,7586,7653,8282,8289,8341,8515,8527,8562,8861,8902,8910,9364,9385,9673,9798,10084,10216,10467,10522,11038,11093,11237,11461,11592,11713,11801,11926,11975,12126,12713,13075,13223,13760,13841,13897,13991,14262,14310,14311,14848,15023,15101,15230,15281,15424,15670,15975,16058,16218,16225,16268,16293,16745,17078,17169,17471,17669,17730,17810,18115,19054,19445,19496,19519,20027,20359,20534,20850,21099,21682,22094,22772,22972,23108,23176,23258,23347,23499,23863,23987,24155,24499,25307,26129,26254,26403,26915,27253,27415,27983,28497,28511,28752,28903,28918,29000,29303,29319,29426,29720,29779,30150,30497,30607,30702,31074,31356,31564,31700,31976,32504,32791,33355,33830,34022,34578,34748,34944,34965,35591,35606,35664,35688,35690,35977,36263,36333,36534,36630,36691,36730,36981,37025,37230,37324,37484,37547,38026,38113,38257,38351,38401,38440,39021,39028,39257,39304,39350,39351,39388,39567,39601,39672,39873,40000)")
end
