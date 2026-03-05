library('dplyr')
library('ggplot2')

# 1. Import data
scores_raw <- read.csv('data/scores.csv')

# 2. Clean data
scores <- scores_raw %>% filter(!is.na(final_score))

# 3. Model
lm <- lm(final_score ~ study_hours, data = scores)

# 4. Plot
p <- ggplot(scores, aes(x = study_hours, y = final_score)) +
  geom_point() +
  geom_smooth(method = "lm", se = FALSE) +
  labs(
    title = "Final Exam Score vs Study Hours",
    x = "Study Hours",
    y = "Final Exam Score"
  )
p
