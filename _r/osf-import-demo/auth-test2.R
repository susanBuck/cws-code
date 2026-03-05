require("httr")

# Get OSF_TOKEN from .Renviron
OSF_TOKEN <- Sys.getenv("OSF_TOKEN")

# Demo request to OSF servers to check authentication - note use of OSF_TOKEN
request <- GET(
  "https://api.osf.io/v2/users/me/",
  add_headers(Authorization = paste("Bearer", OSF_TOKEN))
)

response_text <- content(request, as = "text", encoding = "UTF-8")

if (
  grepl(
    "User provided an invalid OAuth2 access token",
    response_text
  )
) {
  print("❌ Invalid access token; failed to auth with OSF servers")
}

if (Sys.getenv('DEBUG')) {
  print("✅ Auth test with OSF servers successful")
}
