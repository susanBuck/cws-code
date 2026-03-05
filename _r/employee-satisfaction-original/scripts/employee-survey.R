employee_survey <- read.csv('data/employee_survey.csv', na.strings = "")

employee_survey$dept <- factor(employee_survey$dept)
employee_survey$salary <- factor(employee_survey$salary, levels = c("low", "medium", "high"), ordered = TRUE)

employee_survey <- na.omit(employee_survey)

library(ggplot2)

gg_bar <- ggplot(employee_survey, aes(x = salary, fill = salary)) +
  geom_bar(width = 0.6, alpha = 0.9) +
  scale_fill_manual(values = c("low" = "green", "medium" = "grey", "high" = "red")) +
  labs(x = "Salary level", y = "Count", title = "Employees by salary level") +
  theme_minimal() +
  theme(panel.grid.major.x = element_blank())

gg_bar
