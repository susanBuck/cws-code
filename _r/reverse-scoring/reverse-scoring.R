library(dplyr)

survey_data <- tibble(
  id = 1:10,
  stress_1 = c(2, 4, 3, 5, 1, 2, 4, 3, 5, 1),
  stress_2 = c(3, 3, 2, 4, 5, 1, 2, 4, 3, 2),
  stress_3 = c(5, 1, 4, 2, 3, 5, 1, 4, 2, 3) # reverse-worded item
)

# Function for reverse scoring
reverse_score_items <- function(
  data,
  columns_to_reverse,
  scale_min,
  scale_max
) {
  reverse_score <- function(values) {
    (scale_min + scale_max) - values
  }

  data %>%
    mutate(
      across(
        all_of(columns_to_reverse),
        reverse_score
      )
    )
}


survey_data_reverse_scored <- reverse_score_items(
  survey_data,
  c('stress_3'),
  1,
  5
)
