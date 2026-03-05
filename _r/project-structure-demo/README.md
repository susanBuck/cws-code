# R Workflow Best Practices Demo Project

This is a small example project that follows a simple, consistent structure:

```
project/
  data/
    raw/
    processed/
  R/
  scripts/
  outputs/
```

## What's included

- **data/raw/scores.csv**: example student dataset (study hours + final exam score)
- **R/**: reusable functions (cleaning, modeling, plotting)
- **scripts/**: runnable scripts that orchestrate the workflow
- **outputs/**: where generated files (plots, model summaries) go

## Run it

From the project root:

```r
source("scripts/02_explore_data.R") # exploratory data analysis
source("scripts/01_run_analysis.R") # full workflow
```

After running, check:

- `data/processed/scores_clean.csv`
- `outputs/model_summary.txt`
- `outputs/final_score_vs_study_hours.png`
