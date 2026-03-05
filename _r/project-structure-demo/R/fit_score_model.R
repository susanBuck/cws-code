fit_score_model <- function(df) {
  # Predict final exam score from study hours
  lm(final_score ~ study_hours, data = df)
}
