setwd("~/Desktop/abc")

list.files("~/Desktop", full.names = TRUE)

dir.create("~/Desktop/abc")

dir.exists("~/Desktop/abc")

x <- 'abc'

foo <- function() {
  print(x)
}
