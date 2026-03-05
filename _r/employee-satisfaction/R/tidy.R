# Convert categorical variables to Factors:
#  - dept: Departments are categories with no natural order.
#  - salary: Salary levels have a natural order (low < medium < high).
employee_survey$dept <- factor(employee_survey$dept)
employee_survey$salary <- factor(
  employee_survey$salary,
  levels = c("low", "medium", "high"),
  ordered = TRUE
)

# This data contains 788 missing rows.
# There are no other NA values through the rest of the file,
# so we’ll use na.omit to clean up the missing rows.
employee_survey <- na.omit(employee_survey)
