library(codepsych)
library(tidyverse)

results <- filter(select(stroop, condition, reaction_time), reaction_time < 500)

results <- stroop |>
    select(condition, reaction_time) |>
    filter(reaction_time < 500)

results <- stroop |>
    lm(reaction_time ~ condition, data = _)
