generate_plot <- function(scores) {
  ggplot(scores, aes(x = study_hours, y = final_score)) +
    geom_point() +
    geom_smooth(method = "lm", se = FALSE) +
    labs(
      title = "Final Exam Score vs Study Hours",
      x = "Study Hours",
      y = "Final Exam Score"
    )
}
