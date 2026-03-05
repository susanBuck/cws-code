# Load packages
library(dplyr)
library(ggplot2)

# Source functions
source("R/clean_scores.R")
source("R/fit_score_model.R")
source("R/plot_scores.R")

# Load raw data
scores_raw <- read.csv("data/raw/scores.csv")

# Clean data
scores <- clean_scores(scores_raw)

# Save cleaned data (useful for downstream steps)
write.csv(scores, "data/processed/scores_clean.csv", row.names = FALSE)

# Explore
scores_raw %>%
  summarise(
    n = n(),
    n_missing_final = sum(is.na(final_score)),
    max_final = max(final_score, na.rm = TRUE),
    mean_hours = mean(study_hours),
    mean_final = mean(final_score, na.rm = TRUE)
  ) %>%
  print()

# Look at suspiciously large final scores
scores_raw %>%
  filter(final_score > 100) %>%
  print()

# Model and save summary as a text file
model <- fit_score_model(scores)
sink("outputs/model_summary.txt")
print(summary(model))
sink()

# Plot and save output
p <- plot_scores(scores)
ggsave(
  filename = "outputs/final_score_vs_study_hours.png",
  plot = p,
  width = 8,
  height = 5,
  dpi = 160
)

# Generate report
quarto::quarto_render("reports/report.qmd")

# Done
message("Done. See data/processed/ and outputs/ for results.")
