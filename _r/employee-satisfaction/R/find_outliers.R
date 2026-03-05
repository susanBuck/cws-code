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
