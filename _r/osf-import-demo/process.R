# Install and Load Packages
if (!require("pacman")) {
  install.packages("pacman")
  require("pacman")
}
p_load("readr", "dplyr", "purrr", "tibble")

# Directory containing the CSV files
dir_path <- "osf_downloads"

# Get full paths to all CSV files
files <- list.files(dir_path, pattern = "\\.csv$", full.names = TRUE)

# Example getting a single file
data1 = read.csv(files[1])

# Read and combine into one tibble
combined_data <- files %>%
  set_names(basename(.)) %>% # use filename as name
  map_dfr(
    ~ read_csv(.x),
    .id = "source_file" # new column with file name
  )

combined_data
