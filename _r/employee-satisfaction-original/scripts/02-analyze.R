library(tidyverse)
library(skimr)
library(corrplot)

employee_survey %>% select(-Emp.ID) %>% skim()

employee_survey %>%
  ggplot(aes(x = salary)) +
  geom_bar(fill = "skyblue") +
  labs(
    title = "Distribution of Employees by Salary Levels",
    x = "Salary Level",
    y = "Count"
  ) +
  theme_minimal() +
  theme(axis.text.x = element_text(angle = 45, hjust = 1))


employee_survey %>% 
  ggplot(aes(x= satisfaction_level)) +
  geom_histogram(fill = "turquoise") +
  labs(
    title = "Distribution of Satisfaction Level",
    x = "satisfaction_level",
    y = "Count"
  ) +
  theme_minimal()

employee_survey %>%
  select(where(~ is.numeric(.x) && n_distinct(.x) > 2), -Emp.ID) %>%
  pivot_longer(cols = everything(),
               names_to = "Variable",
               values_to = "Value") %>%
  ggplot(aes(x = Variable, y = Value)) +
  geom_boxplot(fill = "lightblue") +
  facet_wrap( ~ Variable, scales = "free") + 
  labs(title = "Box Plots of Numeric Variables") +
  theme_minimal()



# Function to identify outliers
find_outliers <- function(column) {
  # Finds the first (Q1) and third (Q3) quartiles of the column
  Q1 <- quantile(column, 0.25, na.rm = TRUE)
  Q3 <- quantile(column, 0.75, na.rm = TRUE)
  
  # The IQR (Interquartile Range) is the middle 50% of the data
  IQR_value <- Q3 - Q1 
  
  # Any value below the lower bound or above the upper bound is considered an outlier
  lower_bound <- Q1 - 1.5 * IQR_value
  upper_bound <- Q3 + 1.5 * IQR_value
  
  # Filters the column and returns just the values that are outliers
  return(column[column < lower_bound | column > upper_bound])
}

# Count outliers per numeric variable
outlier_counts <- employee_survey %>%
  select(where(~ is.numeric(.x) && n_distinct(.x) > 2), -Emp.ID) %>%
  map(find_outliers) %>%
  map_int(length) %>%
  enframe(name = "variable", value = "num_outliers")

print(outlier_counts)
 
# Get outlier values for time_spend_company
outliers <- employee_survey %>%
  pull(time_spend_company) %>%
  find_outliers()

# Create copy of data frame with time_spend_company outliers removed
employee_survey_without_outliers <- employee_survey %>%
  filter(!time_spend_company %in% outliers)




# Perason’s Correlation Matrix
# Compute the Pearson correlation between numeric variables (excluding Emp.ID)
# Then visualize the upper triangle of the correlation matrix with a heatmap via corrplot()
employee_survey %>%
  select(where(~ is.numeric(.) && n_distinct(.) > 2), -Emp.ID) %>%
  cor(use = "complete.obs") %>%
  corrplot(
    method = "circle",
    type = "upper",
    addCoef.col = "black",  # numeric correlation labels
    number.cex = 0.7,       # size of correlation numbers
    tl.cex = 0.8,           # axis label size
    tl.col = "black",       # axis label color
    cl.cex = 0.8            # color legend (gradient bar) label size
  )


