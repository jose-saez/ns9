curl -s "https://es.wikipedia.org/w/api.php?format=json&action=query&generator=random&grnnamespace=0&grnlimit=1&prop=extracts&explaintext=true"|jq '.["query"]["pages"][]["title", "extract"]'
