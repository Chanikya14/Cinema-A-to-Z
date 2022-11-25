import mysql.connector
import csv
#establishing the connection
conn = mysql.connector.connect(
   user='root', password='12345678', host='localhost', database='login_sample_db'
)

#Creating a cursor object using the cursor() method
cursor = conn.cursor()

#Dropping EMPLOYEE table if already exists.
cursor.execute("DROP TABLE IF EXISTS reviews")

#Creating table as per requirement
sql ='''CREATE TABLE reviews(
   Name TEXT,
   IMDB TEXT,
   Metacritic TEXT,
   Rotten TEXT,
   Duration TEXT,
   Cast TEXT,
   Similar TEXT,
   Reviews TEXT,
   Plot TEXT,
   Genre TEXT,
   Year TEXT,
   Language TEXT,
   IMAGE TEXT,
   Type TEXT
)'''
cursor.execute(sql)
file = open('reviews.csv')
csv_data = csv.reader(file)
count=1
for row in csv_data:
   if(count==1):
      count=count+1
   else:
      cursor.execute('INSERT INTO reviews(Name,IMDB,Metacritic,Rotten,Duration,Cast,Similar,Reviews,Plot,Genre,Year,Language,IMAGE,Type)' 'VALUES(%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)', row)
      count=count+1
#Closing the connection
cursor.execute("DROP TABLE IF EXISTS users")
sql='''CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;'''
cursor.execute(sql)
sql='''ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `username` (`username`),
  ADD KEY `date` (`date`);'''
cursor.execute(sql)
sql='''ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;'''
cursor.execute(sql)
cursor.execute("DROP TABLE IF EXISTS liked")
sql='''CREATE TABLE liked(
   username TEXT,
   movie TEXT
   )'''
cursor.execute(sql)
cursor.execute("DROP TABLE IF EXISTS watched")
sql='''CREATE TABLE watched(
   username TEXT,
   movie TEXT
   )'''
cursor.execute(sql)
cursor.execute("DROP TABLE IF EXISTS watchlist")
sql='''CREATE TABLE watchlist(
   username TEXT,
   movie TEXT
   )'''
cursor.execute(sql)
conn.commit()
conn.close() 