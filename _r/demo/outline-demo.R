# Load Packages ----------------------------------------------------------------
library(tidyverse)
library(lubridate)


# Import -----------------------------------------------------------------------

## Raw data import ----
df_raw <- read.csv("data/raw/datafile.csv", stringsAsFactors = FALSE)

## Parse participant ID ----
# Extract participant number, fix formatting, remove prefixes, etc.
df_raw$participant_id <- gsub("ID_", "", df_raw$participant)


# Tidy -------------------------------------------------------------------------

## Clean column names ----
# Standardize naming (e.g., snake_case)
df <- janitor::clean_names(df_raw)

## Convert character columns to factors ----
# Example: convert specific columns
df$condition <- factor(df$condition)
df$group <- factor(df$group)

## Handle missing values ----
# Drop NA rows or impute as needed
df <- tidyr::drop_na(df)

## Create derived variables ----
# Example: compute accuracy or reaction time differences
df <- df %>% mutate(rt_log = log(rt))


# Analyze ----------------------------------------------------------------------

## Summary statistics ----
mean_rt <- mean(df$rt, na.rm = TRUE)
table(df$condition)

## Inferential tests ----
t_test_result <- t.test(rt ~ condition, data = df)

## Model fitting ----
model <- lm(rt ~ condition + age, data = df)
summary(model)


# Visualize --------------------------------------------------------------------

## Reaction time plot ----
ggplot(df, aes(condition, rt)) +
    geom_boxplot() +
    labs(title = "Reaction Time by Condition")

## Accuracy plot ----
ggplot(df, aes(condition, accuracy)) +
    geom_bar(stat = "summary", fun = "mean")


# Export -----------------------------------------------------------------------

## Save cleaned dataset ----
write.csv(df, "data/clean/datafile_clean.csv", row.names = FALSE)

## Save figures ----
ggsave("figures/rt_plot.png")
