plot_scores <- function(df) {
  ggplot2::ggplot(df, ggplot2::aes(x = study_hours, y = final_score)) +
    ggplot2::geom_point(alpha = 0.8) +
    ggplot2::geom_smooth(method = "lm", se = FALSE) +
    ggplot2::labs(
      title = "Final Exam Score vs Study Hours",
      x = "Study Hours",
      y = "Final Exam Score"
    ) +
    ggplot2::theme_minimal()
}
