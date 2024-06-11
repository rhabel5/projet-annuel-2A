import tkinter as tk
from tkinter import messagebox, simpledialog
import requests

BASE_URL = "http://localhost/api"
token = None

def login():
    global token
    email = email_entry.get()
    password = password_entry.get()
    try:
        response = requests.post(f"{BASE_URL}/login", json={"email": email, "password": password})
        response.raise_for_status()
        data = response.json()
        token = data.get("token")
        redirect_url = data.get("redirect")
        messagebox.showinfo("Success", f"Login successful. Redirect to: {redirect_url}")
        show_ticket_management()
    except requests.exceptions.RequestException as e:
        messagebox.showerror("Error", f"Failed to login: {e}")

def fetch_tickets():
    try:
        headers = {"Authorization": f"Bearer {token}"}
        response = requests.get(f"{BASE_URL}/tickets", headers=headers)
        response.raise_for_status()
        return response.json()
    except requests.exceptions.RequestException as e:
        messagebox.showerror("Error", f"Failed to fetch tickets: {e}")
        return []

def show_tickets():
    tickets = fetch_tickets()
    tickets_listbox.delete(0, tk.END)
    for ticket in tickets:
        tickets_listbox.insert(tk.END, f"{ticket['id']} - {ticket['title']} - {ticket['status']}")

def view_ticket():
    try:
        selected_ticket = tickets_listbox.get(tickets_listbox.curselection())
        ticket_id = selected_ticket.split(" - ")[0]
        headers = {"Authorization": f"Bearer {token}"}
        response = requests.get(f"{BASE_URL}/tickets/{ticket_id}", headers=headers)
        response.raise_for_status()
        ticket = response.json()
        messagebox.showinfo("Ticket Details", f"Title: {ticket['title']}\nMessage: {ticket['message']}\nStatus: {ticket['status']}")
    except IndexError:
        messagebox.showerror("Error", "No ticket selected")
    except requests.exceptions.RequestException as e:
        messagebox.showerror("Error", f"Failed to fetch ticket details: {e}")

def change_ticket_status(status):
    try:
        selected_ticket = tickets_listbox.get(tickets_listbox.curselection())
        ticket_id = selected_ticket.split(" - ")[0]
        headers = {"Authorization": f"Bearer {token}"}
        response = requests.put(f"{BASE_URL}/tickets/{ticket_id}/status", json={"status": status}, headers=headers)
        response.raise_for_status()
        messagebox.showinfo("Success", "Ticket status updated successfully")
        show_tickets()
    except IndexError:
        messagebox.showerror("Error", "No ticket selected")
    except requests.exceptions.RequestException as e:
        messagebox.showerror("Error", f"Failed to update ticket status: {e}")

def respond_ticket():
    try:
        selected_ticket = tickets_listbox.get(tickets_listbox.curselection())
        ticket_id = selected_ticket.split(" - ")[0]
        response_message = simpledialog.askstring("Response", "Enter your response:")
        if response_message:
            headers = {"Authorization": f"Bearer {token}"}
            response = requests.post(f"{BASE_URL}/tickets/{ticket_id}/response", json={"message": response_message}, headers=headers)
            response.raise_for_status()
            messagebox.showinfo("Success", "Response sent successfully")
    except IndexError:
        messagebox.showerror("Error", "No ticket selected")
    except requests.exceptions.RequestException as e:
        messagebox.showerror("Error", f"Failed to send response: {e}")

def show_ticket_management():
    login_frame.pack_forget()
    ticket_frame.pack(expand=True, fill="both")

# GUI Setup
root = tk.Tk()
root.title("Ticket Management")
root.geometry("600x600")
root.config(bg="#f0f0f0")

# Login Frame
login_frame = tk.Frame(root, bg="#f0f0f0")
login_frame.pack(expand=True, fill="both")

tk.Label(login_frame, text="Email:", font=("Arial", 12), bg="#f0f0f0").pack(pady=5)
email_entry = tk.Entry(login_frame, font=("Arial", 12))
email_entry.pack(pady=5)

tk.Label(login_frame, text="Password:", font=("Arial", 12), bg="#f0f0f0").pack(pady=5)
password_entry = tk.Entry(login_frame, show="*", font=("Arial", 12))
password_entry.pack(pady=5)

tk.Button(login_frame, text="Login", command=login, font=("Arial", 12), bg="#4CAF50", fg="white").pack(pady=20)

# Ticket Management Frame
ticket_frame = tk.Frame(root, bg="#f0f0f0")

header_frame = tk.Frame(ticket_frame, bg="#4CAF50", pady=10)
header_frame.pack(fill="x")

header_label = tk.Label(header_frame, text="Ticket Management System", bg="#4CAF50", fg="white", font=("Arial", 16, "bold"))
header_label.pack()

content_frame = tk.Frame(ticket_frame, bg="#f0f0f0", pady=20, padx=20)
content_frame.pack(expand=True, fill="both")

tickets_listbox = tk.Listbox(content_frame, width=50, height=20, font=("Arial", 12))
tickets_listbox.pack(pady=10)

button_frame = tk.Frame(content_frame, bg="#f0f0f0")
button_frame.pack(pady=10)

show_button = tk.Button(button_frame, text="Show Tickets", command=show_tickets, font=("Arial", 12), bg="#2196F3", fg="white")
show_button.grid(row=0, column=0, padx=5, pady=5)

view_button = tk.Button(button_frame, text="View Ticket", command=view_ticket, font=("Arial", 12), bg="#2196F3", fg="white")
view_button.grid(row=0, column=1, padx=5, pady=5)

close_button = tk.Button(button_frame, text="Close Ticket", command=lambda: change_ticket_status('closed'), font=("Arial", 12), bg="#f44336", fg="white")
close_button.grid(row=0, column=2, padx=5, pady=5)

hold_button = tk.Button(button_frame, text="Hold Ticket", command=lambda: change_ticket_status('on hold'), font=("Arial", 12), bg="#FFC107", fg="white")
hold_button.grid(row=0, column=3, padx=5, pady=5)

respond_button = tk.Button(button_frame, text="Respond to Ticket", command=respond_ticket, font=("Arial", 12), bg="#4CAF50", fg="white")
respond_button.grid(row=0, column=4, padx=5, pady=5)

root.mainloop()