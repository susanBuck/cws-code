clean_scores <- function(df) {
  # Remove rows with missing final scores
  df <- df[!is.na(df$final_score), ]

  # Remove obvious outliers (e.g., an accidental 999)
  df <- df[df$final_score <= 100, ]

  # Ensure types are as expected
  df$student_id <- as.character(df$student_id)
  df$section <- as.factor(df$section)

  df
}
