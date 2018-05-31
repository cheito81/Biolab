library(RMySQL)

openDB <- function (user, password, dbname, host)
{
  mydb <- dbConnect(MySQL(), 
                   user=user, password=password, 
                   dbname=dbname, host=host)
  
  return (mydb)
}

execSQLQuery <-function (mydb, query)
{
  rs <- dbSendQuery(mydb, query)
  
  data <- fetch(rs, n=-1)  
  
  return (data)
}
