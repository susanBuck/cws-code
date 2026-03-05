# On import, treat empty strings as NA
employee_survey <- read.csv('data/employee_surveys.csv', na.strings = "")

# Convert categorical variables to Factors:
#  - dept: Departments are categories with no natural order.
#  - salary: Salary levels have a natural order (low < medium < high).
employee_survey$dept <- factor(employee_survey$dept)
employee_survey$salary <- factor(employee_survey$salary, levels=c("low", "medium", "high"), ordered = TRUE)

# This data contains 788 missing rows. 
# There are no other NA values through the rest of the file, 
# so we’ll use na.omit to clean up the missing rows.
employee_survey <- na.omit(employee_survey)

# if needed: install.packages(c("ggplot2", "dplyr", "scales"))
library(ggplot2)
library(dplyr)
library(scales)

salary_counts <- employee_survey %>%
  count(salary) %>%
  arrange(salary) %>%
  mutate(pct = n / sum(n))

p <- ggplot(salary_counts, aes(x = salary, y = n, fill = salary)) +
  geom_col(show.legend = FALSE, width = 0.6) +
  geom_text(aes(label = paste0(n, " (", percent(pct), ")")), vjust = -0.5) +
  scale_y_continuous(expand = expansion(mult = c(0, 0.1))) +
  labs(
    title = "Distribution of Employees by Salary Level",
    x = "Salary level",
    y = "Number of employees"
  ) +
  theme_minimal()

p

