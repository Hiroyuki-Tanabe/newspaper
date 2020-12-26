import requests
import json

def main():

    url = "https://slack.com/api/conversations.history"
    token = "xoxp-1000722060884-1003387710614-1599905019139-5f9fb3518f61faa7d18eb8610a30989a"
    channel_id = "C0100M822JY"

    payload = {
        "token": token,
        "channel": channel_id
    }
    response = requests.get(url, params=payload)
    json_data = response.json()
    messages = json_data["messages"]
    for i in messages[:10]:
        print(i["text"])

main()