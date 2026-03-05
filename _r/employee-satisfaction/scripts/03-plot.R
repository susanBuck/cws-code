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


gg_bar <- ggplot(employee_survey, aes(x = salary, fill = salary)) +
  geom_bar(width = 0.6, alpha = 0.9) +
  scale_fill_manual(
    values = c("low" = "green", "medium" = "grey", "high" = "red")
  ) +
  labs(x = "Salary level", y = "Count", title = "Employees by salary level") +
  theme_minimal() +
  theme(panel.grid.major.x = element_blank())

gg_bar
