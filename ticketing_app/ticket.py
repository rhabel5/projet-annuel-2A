import requests
from tkinter import messagebox
from auth import token, user_id

BASE_URL = "http://localhost/api"

def fetch_tickets():
    try:
        headers = {"Authorization": f"Bearer {token}"}
        response = requests.get(f"{BASE_URL}/tickets", headers=headers)
        response.raise_for_status()
        return response.json()
    except requests.exceptions.RequestException as e:
        messagebox.showerror("Error", f"Failed to fetch tickets: {e}")
        return []

def view_ticket(ticket_id):
    try:
        headers = {"Authorization": f"Bearer {token}"}
        response = requests.get(f"{BASE_URL}/tickets/{ticket_id}", headers=headers)
        response.raise_for_status()
        return response.json()
    except requests.exceptions.RequestException as e:
        messagebox.showerror("Error", f"Failed to fetch ticket details: {e}")
        return None

def create_ticket(title, message, priority, tags=None):
    try:
        headers = {"Authorization": f"Bearer {token}"}
        payload = {
            "title": title,
            "message": message,
            "priority": priority,
        }
        if tags:
            payload["tags"] = tags

        response = requests.post(f"{BASE_URL}/tickets", json=payload, headers=headers)
        response.raise_for_status()
        print(response.text)
        return response.json()
    except requests.exceptions.RequestException as e:
        messagebox.showerror("Error", f"Failed to create ticket: {e}")
        return None

def update_ticket_status(ticket_id, status):
    try:
        headers = {"Authorization": f"Bearer {token}"}
        response = requests.put(f"{BASE_URL}/tickets/{ticket_id}/status", json={"status": status}, headers=headers)
        response.raise_for_status()
        return response.json()
    except requests.exceptions.RequestException as e:
        messagebox.showerror("Error", f"Failed to update ticket status: {e}")
        return None

def delete_ticket(ticket_id):
    try:
        headers = {"Authorization": f"Bearer {token}"}
        response = requests.delete(f"{BASE_URL}/tickets/{ticket_id}", headers=headers)
        response.raise_for_status()
        return response.json()
    except requests.exceptions.RequestException as e:
        messagebox.showerror("Error", f"Failed to delete ticket: {e}")
        return None

def respond_ticket(ticket_id, message):
    try:
        headers = {"Authorization": f"Bearer {token}"}
        response = requests.post(f"{BASE_URL}/tickets/{ticket_id}/response", json={"message": message}, headers=headers)
        response.raise_for_status()
        return response.json()
    except requests.exceptions.RequestException as e:
        messagebox.showerror("Error", f"Failed to send response: {e}")
        return None

def assign_ticket(ticket_id):
    try:
        headers = {"Authorization": f"Bearer {token}"}
        response = requests.put(f"{BASE_URL}/tickets/{ticket_id}/assign", headers=headers)
        response.raise_for_status()
        return response.json()
    except requests.exceptions.RequestException as e:
        messagebox.showerror("Error", f"Failed to assign ticket: {e}")
        return None