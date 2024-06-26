import requests
from tkinter import messagebox

BASE_URL = "http://localhost/api"
token = None
user_id = None

def login(email, password):
    global token, user_id
    try:
        response = requests.post(f"{BASE_URL}/login", json={"email": email, "password": password})
        response.raise_for_status()
        data = response.json()
        token = data.get("token")
        headers = {"Authorization": f"Bearer {token}"}
        user_response = requests.get(f"{BASE_URL}/user", headers=headers)
        user_response.raise_for_status()
        user_data = user_response.json()
        user_id = user_data["id"]
        if any(role['name'] == 'admin' for role in user_data["roles"]):
            return True, user_id
        else:
            messagebox.showerror("Error", "Vous n'avez pas les droits")
            return False, None
    except requests.exceptions.RequestException as e:
        messagebox.showerror("Error", f"Failed to login: {e}")
        return False, None

def logout():
    global token, user_id
    token = None
    user_id = None
    messagebox.showinfo("Success", "Logged out successfully")