library(targets)

# Declare packages used in the pipeline
tar_option_set(packages = c("dplyr", "ggplot2"))

tar_source()

# List steps of your pipeline
list(
  # Step 1: Register the data file
  tar_target(file, "data/scores.csv", format = "file"),

  # Step 2: Load raw student data
  tar_target(
    scores_raw,
    read.csv(file)
  ),

  # Step 3: Remove students missing final exam scores
  tar_target(
    scores,
    scores_raw %>%
      filter(!is.na(final_score))
  ),

  # Step 4: Fit regression model (predict final exam score from study hours)
  tar_target(
    model,
    lm(final_score ~ study_hours, data = scores)
  ),

  # Step 5: Generate plot
  tar_target(
    plot,
    generate_plot(scores)
  )
)
