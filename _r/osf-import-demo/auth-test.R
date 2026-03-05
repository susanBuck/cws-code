# Install and Load Packages
if (!require("pacman")) {
  install.packages("pacman")
  require("pacman")
}
p_load("httr", "jsonlite")

# Get OSF_TOKEN from .Renviron
OSF_TOKEN <- Sys.getenv("OSF_TOKEN")

# Function to test authentication - pings for profile data for token owner
test_auth <- function(token) {
  request <- GET(
    "https://api.osf.io/v2/users/me/",
    add_headers(Authorization = paste("Bearer", token))
  )

  response_text <- content(request, as = "text", encoding = "UTF-8")

  if (
    grepl(
      "User provided an invalid OAuth2 access token",
      response_text,
      fixed = TRUE
    )
  ) {
    return("❌ Invalid OAuth2 access token")
  }

  return("✅ Auth test successful")
}

# Run test
if (Sys.getenv('DEBUG')) {
  print(test_auth(OSF_TOKEN))
}
