require("httr")

OSF_TOKEN <- Sys.getenv("OSF_TOKEN")
DEBUG <- Sys.getenv("DEBUG") == "TRUE"

# Demo request to OSF servers to check authentication
# ⭐ Note use of OSF_TOKEN ⭐
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
  # ⭐ Note use of DEBUG ⭐
  if (DEBUG) {
    print("❌ Invalid access token; failed to auth with OSF servers")
  }
}

# ⭐ Note use of DEBUG ⭐
if (DEBUG) {
  print("✅ Auth test with OSF servers successful")
}
