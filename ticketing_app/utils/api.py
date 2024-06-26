import requests
from tkinter import messagebox
from auth import token

BASE_URL = "http://localhost/api"

def make_request(method, endpoint, json=None):
    headers = {"Authorization": f"Bearer {token}"}
    try:
        if method == "GET":
            response = requests.get(f"{BASE_URL}/{endpoint}", headers=headers)
        elif method == "POST":
            response = requests.post(f"{BASE_URL}/{endpoint}", headers=headers, json=json)
        elif method == "PUT":
            response = requests.put(f"{BASE_URL}/{endpoint}", headers=headers, json=json)
        elif method == "DELETE":
            response = requests.delete(f"{BASE_URL}/{endpoint}", headers=headers)
        response.raise_for_status()
        return response.json()
    except requests.exceptions.RequestException as e:
        messagebox.showerror("Error", f"API request failed: {e}")
        return None