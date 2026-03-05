# Install and Load Packages
if (!require("pacman")) {
  install.packages("pacman")
  require("pacman")
}
p_load("httr", "jsonlite", "fs")


OSF_TOKEN <- Sys.getenv("OSF_TOKEN")


# Each OSF project and component has a unique 5-character node ID.
# To find it, open your OSF project component in a browser:
# Example URL: https://osf.io/qkthv/overview
# The part after "osf.io/" (here, "qkthv") is the node ID
# Copy and paste that string below.
NODE <- "qkthv"

# Fetch file listing
BASE <- paste0("https://api.osf.io/v2/nodes/", NODE, "/files/osfstorage/")
res <- GET(BASE, add_headers(Authorization = paste("Bearer", OSF_TOKEN)))
stop_for_status(res)
page <- fromJSON(content(res, as = "text", encoding = "UTF-8"), flatten = TRUE)

## Follow pagination if present
all <- list(page)
while (
  !is.null(all[[length(all)]]$links$`next`) &&
    nzchar(all[[length(all)]]$links$`next`)
) {
  nxt <- all[[length(all)]]$links$`next`
  res <- GET(nxt, add_headers(Authorization = paste("Bearer", OSF_TOKEN)))
  stop_for_status(res)
  all[[length(all) + 1]] <- fromJSON(
    content(res, as = "text", encoding = "UTF-8"),
    flatten = TRUE
  )
}

# Combine pages and keep only actual files
rows <- do.call(rbind, lapply(all, function(p) p$data))
files <- subset(rows, attributes.kind == "file")

message("Found ", nrow(files), " matching files.")

# Download
if (!dir_exists("osf_downloads")) {
  dir_create("osf_downloads")
}

for (i in seq_len(nrow(files))) {
  name <- files$attributes.name[i]
  path <- fs::path("osf_downloads", name)

  download_url <- files$links.download[i]

  r <- GET(
    download_url,
    add_headers(Authorization = paste("Bearer", OSF_TOKEN)),
    write_disk(path, overwrite = TRUE)
  )

  stop_for_status(r)
  message("Saved: ", path)
}

# Remove intermediate steps
rm(
  all,
  files,
  page,
  r,
  res,
  rows,
  BASE,
  i,
  name,
  NODE,
  path,
  OSF_TOKEN,
  download_url
)
