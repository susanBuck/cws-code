library(ggplot2)
library(dplyr)
library(scales)

# Import data; treat empty strings as NA
employee_survey <- read.csv('data/employee_survey.csv', na.strings = "")

tidy(employee_survey)
